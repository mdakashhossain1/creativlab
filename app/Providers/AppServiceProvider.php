<?php

namespace App\Providers;

use View;
use Exception;
use Throwable;
use App\Models\Wishlist;
use Modules\Menu\Entities\Menu;
use Illuminate\Support\Facades\Log;
use Modules\Page\App\Models\Footer;
use Illuminate\Support\Facades\Auth;
use Modules\Ecommerce\Entities\Cart;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Page\App\Models\CustomPage;
use Modules\Blog\App\Models\BlogCategory;
use Modules\Currency\App\Models\Currency;
use Modules\Language\App\Models\Language;
use Modules\GlobalSetting\App\Models\GlobalSetting;
use Modules\SupportTicket\App\Models\SupportTicket;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            $prodPublicPath = base_path('../public_html');
            if (is_dir($prodPublicPath)) {
                return $prodPublicPath;
            }
            return base_path('public');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        try {
            $setting_data = GlobalSetting::get();
            $setting = array();
            foreach ($setting_data as $data_item) {
                $setting[$data_item->key] = $data_item->value;
            }
            $setting = (object) $setting;

            config(['app.timezone' => $setting->timezone]);
            date_default_timezone_set($setting->timezone);
        } catch (Exception $ex) {
            Log::error('AppServiceProvider : ' . $ex->getMessage());

            Artisan::call('optimize:clear');
        }

        View::composer('*', function ($view) {
            try {
                $setting_data = GlobalSetting::get();
                $setting_arr = array();
                foreach ($setting_data as $data_item) {
                    $setting_arr[$data_item->key] = $data_item->value;
                }
                $general_setting = (object) $setting_arr;

                $language_list = Language::where('status', 1)->get();
                $currency_list = Currency::where('status', 'active')->get();
                $custom_pages = CustomPage::where('status', 1)->get();
                $footer_categories = Category::where('status', 'enable')->latest()->take(7)->get();
                $footer_blog_categories = BlogCategory::where('status', 1)->latest()->take(7)->get();
                $footer = Footer::first();
                $cta_content = getContent('template_1_cta.content', true);

                $menu = Menu::where('is_active', 1)->where('location', 'header')->orderBy('sort_order', 'asc')->first();
                $menu_items = $menu ? $menu->allMenuItems()->where('is_active', 1)->get() : collect();

                $footer_menu = Menu::where('is_active', 1)->where('location', 'footer')->orderBy('sort_order', 'asc')->first();
                $footer_menus = $footer_menu ? $footer_menu->allMenuItems()->where('is_active', 1)->get() : collect();

                // User-specific — cannot be cached globally
                if (Auth::guard('web')->check()) {
                    $userId = Auth::guard('web')->id();
                    $cart_count = Cart::where('user_id', $userId)->count();
                    $wishlist_count = Wishlist::where('user_id', $userId)->count();
                } else {
                    $cart_count = Cart::where('session_id', session()->getId())->count();
                    $wishlist_count = 0;
                    $userId = auth()->id();
                }

                // Total unseen support messages for admin
                $total_unseen_support_messages_for_admin = SupportTicket::getTotalUnseenMessagesForAdmin();
                // Total unseen support messages for user
                $total_unseen_support_messages_for_user = SupportTicket::getTotalUnseenMessagesForUser($userId);

                $view->with('general_setting', $general_setting);
                $view->with('language_list', $language_list);
                $view->with('currency_list', $currency_list);
                $view->with('footer', $footer);
                $view->with('custom_pages', $custom_pages);
                $view->with('footer_categories', $footer_categories);
                $view->with('footer_blog_categories', $footer_blog_categories);
                $view->with('menu', $menu);
                $view->with('menu_items', $menu_items);
                $view->with('footer_menu', $footer_menu);
                $view->with('footer_menus', $footer_menus);
                $view->with('cart_count', $cart_count);
                $view->with('wishlist_count', $wishlist_count);
                $view->with('total_unseen_support_messages_for_admin', $total_unseen_support_messages_for_admin);
                $view->with('total_unseen_support_messages_for_user', $total_unseen_support_messages_for_user);
                $view->with('cta_content', $cta_content);
            } catch (Exception $ex) {
                Log::error('AppServiceProvider view composer : ' . $ex->getMessage());
            }
        });
    }
}
