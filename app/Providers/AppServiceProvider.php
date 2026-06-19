<?php

namespace App\Providers;

use View;
use Cache;
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
use Illuminate\Database\Connectors\PostgresConnector;
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
        // Neon PostgreSQL: inject endpoint option into DSN for old libpq without SNI support
        $this->app->bind('db.connector.pgsql', function () {
            return new class extends PostgresConnector {
                protected function getDsn(array $config): string
                {
                    $dsn = parent::getDsn($config);
                    if (!empty($config['neon_endpoint'])) {
                        $dsn .= ';options=endpoint=' . $config['neon_endpoint'];
                    }
                    return $dsn;
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        try {
            $setting = Cache::rememberForever('setting', function () {
                $setting_data = GlobalSetting::get();

                $setting = array();

                foreach ($setting_data as $data_item) {
                    $setting[$data_item->key] = $data_item->value;
                }

                $setting = (object) $setting;

                return $setting;
            });


            $timezone_setting = Cache::get('setting');

            config(['app.timezone' => $timezone_setting->timezone]);
            date_default_timezone_set($timezone_setting->timezone);

            View::composer('*', function ($view) {

                $general_setting = Cache::get('setting');

                // Cache static/rarely-changing data for 30 minutes to avoid repeated Neon round-trips
                $language_list = Cache::remember('view_language_list', 1800, fn() =>
                    Language::where('status', 1)->get()
                );
                $currency_list = Cache::remember('view_currency_list', 1800, fn() =>
                    Currency::where('status', 'active')->get()
                );
                $custom_pages = Cache::remember('view_custom_pages', 1800, fn() =>
                    CustomPage::where('status', 1)->get()
                );
                $footer_categories = Cache::remember('view_footer_categories', 1800, fn() =>
                    Category::where('status', 'enable')->latest()->take(7)->get()
                );
                $footer_blog_categories = Cache::remember('view_footer_blog_categories', 1800, fn() =>
                    BlogCategory::where('status', 1)->latest()->take(7)->get()
                );
                $footer = Cache::remember('view_footer', 1800, fn() =>
                    Footer::first()
                );
                $cta_content = Cache::remember('view_cta_content', 1800, fn() =>
                    getContent('template_1_cta.content', true)
                );

                // Cache menus (header + footer) with their items
                $menu = Cache::remember('view_header_menu', 1800, fn() =>
                    Menu::where('is_active', 1)->where('location', 'header')->orderBy('sort_order', 'asc')->first()
                );
                $menu_items = Cache::remember('view_header_menu_items', 1800, function () use ($menu) {
                    return $menu ? $menu->allMenuItems()->where('is_active', 1)->get() : collect();
                });

                $footer_menu = Cache::remember('view_footer_menu', 1800, fn() =>
                    Menu::where('is_active', 1)->where('location', 'footer')->orderBy('sort_order', 'asc')->first()
                );
                $footer_menus = Cache::remember('view_footer_menu_items', 1800, function () use ($footer_menu) {
                    return $footer_menu ? $footer_menu->allMenuItems()->where('is_active', 1)->get() : collect();
                });

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

                
            });
        } catch (Exception $ex) {
            Log::info('AppServiceProvider : ' . $ex->getMessage());

            Artisan::call('optimize:clear');
        }
    }
}
