<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Slider;
use App\Rules\Captcha;
use App\Models\Frontend;
use Illuminate\Http\Request;
use App\Models\ManageSection;
use Modules\FAQ\App\Models\Faq;
use Modules\Blog\App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Modules\Listing\Entities\Listing;
use Modules\Page\App\Models\ContactUs;
use Illuminate\Support\Facades\Session;
use Modules\Category\Entities\Category;
use Modules\Page\App\Models\CustomPage;
use Modules\Partner\App\Models\Partner;
use Modules\Project\App\Models\Project;
use App\Models\PortfolioCategory;
use Modules\Blog\App\Models\BlogComment;
use Modules\Blog\App\Models\BlogCategory;
use Modules\Currency\App\Models\Currency;
use Modules\Language\App\Models\Language;
use Modules\Page\App\Models\PrivacyPolicy;
use Modules\Page\App\Models\TermAndCondition;
use Modules\SeoSetting\App\Models\SeoSetting;
use Modules\Testimonial\App\Models\Testimonial;
use Modules\GlobalSetting\App\Models\GlobalSetting;
use Modules\Subscription\Entities\SubscriptionPlan;


class HomeController extends Controller
{

    public function index(Request $request)
    {
        return $this->digitalMarketing();
    }

    public function digitalMarketing()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $hero_content = getContent('template_1_hero.content', true);
        $about_content = getContent('template_1_about_company.content', true);
        $fan_fact_content = getContent('template_1_fun_fact.content', true);
        $working_process = getContent('template_1_working_process.content', true);
        $testimonial_content = getContent('template_1_testimonial.content', true);
        $cta_content = getContent('template_1_cta.content', true);
        $section_visibility = ManageSection::where('page_name', 'home_one')->where('status', 1)->get();

        $partners = Partner::where('status', 'enable')->get();
        $services = Listing::where('status', 'enable')->latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(6)->get();
        $blogs = Blog::where('status', 1)->with('category')->latest()->take(3)->get();

        return view('digital-marketing.index', compact(
            'seo_setting', 'hero_content', 'about_content', 'partners',
            'fan_fact_content', 'services', 'working_process',
            'testimonial_content', 'testimonials', 'blogs',
            'cta_content', 'section_visibility'
        ));
    }

    public function creativeContent()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $partners = Partner::where('status', 'enable')->get();
        $section_visibility = ManageSection::where('page_name', 'home_two')->where('status', 1)->orderBy('serial_number')->get();

        $cc_hero            = getContent('creative_content_hero.content', true);
        $cc_features        = getContent('creative_content_features.content', true);
        $cc_solutions       = getContent('creative_content_solutions.content', true);
        $cc_recent_creations = getContent('creative_content_recent_creations.content', true);
        $cc_process         = getContent('creative_content_process.content', true);
        $cc_how_we_create   = getContent('creative_content_how_we_create.content', true);
        $cc_stats           = getContent('creative_content_stats.content', true);
        $cc_services        = getContent('creative_content_services.content', true);
        $cc_portfolio       = getContent('creative_content_portfolio.content', true);
        $cc_cta             = getContent('creative_content_cta.content', true);

        return view('creative-content.index', compact(
            'seo_setting', 'partners', 'section_visibility',
            'cc_hero', 'cc_features', 'cc_solutions', 'cc_recent_creations',
            'cc_process', 'cc_how_we_create', 'cc_stats', 'cc_services',
            'cc_portfolio', 'cc_cta'
        ));
    }

    public function webDevelopment()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $partners = Partner::where('status', 'enable')->get();
        $section_visibility = ManageSection::where('page_name', 'home_three')->where('status', 1)->orderBy('serial_number')->get();

        $wd_hero            = getContent('web_dev_hero.content', true);
        $wd_features        = getContent('web_dev_features.content', true);
        $wd_solutions       = getContent('web_dev_solutions.content', true);
        $wd_recent_projects = getContent('web_dev_recent_projects.content', true);
        $wd_process         = getContent('web_dev_process.content', true);
        $wd_stats           = getContent('web_dev_stats.content', true);
        $wd_cta             = getContent('web_dev_cta.content', true);

        return view('web-development.index', compact(
            'seo_setting', 'partners', 'section_visibility',
            'wd_hero', 'wd_features', 'wd_solutions', 'wd_recent_projects',
            'wd_process', 'wd_stats', 'wd_cta'
        ));
    }

    public function seoOptimization()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $partners = Partner::where('status', 'enable')->get();
        $section_visibility = ManageSection::where('page_name', 'home_four')->where('status', 1)->orderBy('serial_number')->get();

        $seo_hero     = getContent('seo_hero.content', true);
        $seo_features = getContent('seo_features.content', true);
        $seo_solutions = getContent('seo_solutions.content', true);
        $seo_results  = getContent('seo_results.content', true);
        $seo_process  = getContent('seo_process.content', true);
        $seo_stats    = getContent('seo_stats.content', true);
        $seo_cta      = getContent('seo_cta.content', true);

        return view('seo-optimization.index', compact(
            'seo_setting', 'partners', 'section_visibility',
            'seo_hero', 'seo_features', 'seo_solutions', 'seo_results',
            'seo_process', 'seo_stats', 'seo_cta'
        ));
    }

    public function adFilms()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $section_visibility = ManageSection::where('page_name', 'home_five')->where('status', 1)->orderBy('serial_number')->get();

        $af_hero      = getContent('ad_films_hero.content', true);
        $af_features  = getContent('ad_films_features.content', true);
        $af_solutions = getContent('ad_films_solutions.content', true);
        $af_projects  = getContent('ad_films_projects.content', true);
        $af_process   = getContent('ad_films_process.content', true);
        $af_stats     = getContent('ad_films_stats.content', true);
        $af_cta       = getContent('ad_films_cta.content', true);

        return view('ad-films.index', compact(
            'seo_setting', 'section_visibility',
            'af_hero', 'af_features', 'af_solutions', 'af_projects',
            'af_process', 'af_stats', 'af_cta'
        ));
    }

    public function whatsappApi()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $section_visibility = ManageSection::where('page_name', 'home_six')->where('status', 1)->orderBy('serial_number')->get();

        $wa_hero      = getContent('whatsapp_hero.content', true);
        $wa_services  = getContent('whatsapp_services.content', true);
        $wa_why_work  = getContent('whatsapp_why_work.content', true);
        $wa_process   = getContent('whatsapp_process.content', true);
        $wa_cta       = getContent('whatsapp_cta.content', true);

        return view('whatsapp-api.index', compact(
            'seo_setting', 'section_visibility',
            'wa_hero', 'wa_services', 'wa_why_work', 'wa_process', 'wa_cta'
        ));
    }


    public function about_us()
    {
        $about_company_section = getContent('about_company_section.content', true);
        $about_us_our_benefit = getContent('about_us_our_benefit.content', true);
        $about_us_team_member = getContent('about_us_team_member.content', true);
        $about_us_global_clients = getContent('about_us_global_clients.content', true);
        $about_us_testimonials = getContent('about_us_testimonials.content', true);
        $cta_content = getContent('template_1_cta.content', true);
        $partners = Partner::where('status', 'enable')->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $teams = Team::latest()->take(4)->get();
        $teams_count = Team::count();
        $pageTitle = trans('About Us');

        $seo_setting = SeoSetting::where('id', 3)->first();

        return view('about_us', [
            'seo_setting' => $seo_setting,
            'pageTitle' => $pageTitle,
            'partners' => $partners,
            'teams' => $teams,
            'testimonials' => $testimonials,
            'about_us_our_benefit' => $about_us_our_benefit,
            'about_us_team_member' => $about_us_team_member,
            'about_us_global_clients' => $about_us_global_clients,
            'about_us_testimonials' => $about_us_testimonials,
            'cta_content' => $cta_content,
            'teams_count' => $teams_count,
            'about_company_section' => $about_company_section,
            'popup_video_id' => getTranslatedValue($about_us_our_benefit, 'popup_video_id'),
        ]);
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::with('author', 'category', 'comments')->where('status', 1);

        $general_setting = GlobalSetting::where('key', 'error_image')->get();
        $cta_content = getContent('template_1_cta.content', true);

        // Search by title
        if ($request->search) {
            $blogs = $blogs->whereHas('translate', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->category) {
            $blogs = $blogs->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->tag) {
            $blogs = $blogs->where(function ($query) use ($request) {
                $query->whereJsonContains('tags', ['value' => $request->tag])
                    ->orWhereJsonContains('tags', $request->tag);
            });
        }

        // Get categories with active blog count
        $categories = BlogCategory::withCount([
            'blogs' => function ($query) {
                $query->where('status', 1);
            }
        ])->latest()->take(6)->get();

        $perPage = $request->type === 'grid' ? 9 : 5;
        $blogs = $blogs->paginate($perPage);

        $currentBlogId = $request->id ?? null;
        $recent_blogs = Blog::where('status', 1)
            ->when($currentBlogId, function ($query) use ($currentBlogId) {
                return $query->where('id', '!=', $currentBlogId);
            })
            ->latest()
            ->take(3)
            ->get();
        $seo_setting = SeoSetting::where('id', 2)->first();
        $blog_adds = getContent('blog_details_add.content', true);

        // Get all blog tags
        $allTags = Blog::where('status', 1)
            ->whereNotNull('tags')
            ->pluck('tags')
            ->map(function ($tags) {
                return collect(json_decode($tags))
                    ->pluck('value');
            })
            ->flatten()
            ->unique()
            ->values();

        return view('blogs', [
            'blogs' => $blogs,
            'seo_setting' => $seo_setting,
            'categories' => $categories,
            'recent_blogs' => $recent_blogs,
            'allTags' => $allTags,
            'general_setting' => $general_setting,
            'cta_content' => $cta_content,
            'blog_adds' => $blog_adds
        ]);
    }

    public function blog($slug)
    {
        $blog = Blog::with('author')->where('status', 1)->where('slug', $slug)->firstOrFail();
        $cta_content = getContent('template_1_cta.content', true);
        $blog_adds = getContent('blog_details_add.content', true);

        $categories = BlogCategory::withCount('blogs')->take(6)->get();

        $currentBlogId = $request->id ?? null;
        $recent_blogs = Blog::where('status', 1)
            ->when($currentBlogId, function ($query) use ($currentBlogId) {
                return $query->where('id', '!=', $currentBlogId);
            })
            ->latest()
            ->take(4)
            ->get();

        $previous = Blog::where('id', '<', $blog->id)
            ->where('status', 1)
            ->latest()
            ->first();

        $next = Blog::where('id', '>', $blog->id)
            ->where('status', 1)
            ->where('blog_category_id', $blog->blog_category_id) // Same category only
            ->first();


        // Get all blog tags
        $allTags = Blog::where('status', 1)
            ->whereNotNull('tags')
            ->pluck('tags')
            ->map(function ($tags) {
                return collect(json_decode($tags))
                    ->pluck('value');
            })
            ->flatten()
            ->unique()
            ->values();

        return view('blog_detail', [
            'blog' => $blog,
            'categories' => $categories,
            'recent_blogs' => $recent_blogs,
            'previous' => $previous,
            'next' => $next,
            'allTags' => $allTags,
            'cta_content' => $cta_content,
            'blog_adds' => $blog_adds
        ]);
    }

    public function pricing()
    {
        $pageTitle = 'Pricing Plan';
        $subscriptions = SubscriptionPlan::orderBy('serial', 'asc')->get();
        $faqs = Faq::latest()->take(5)->get();
        $cta_content = getContent('template_1_cta.content', true);

        return view('frontend.pricing', compact('pageTitle', 'faqs', 'subscriptions', 'cta_content'));
    }

    public function store_blog_comment(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
            'g-recaptcha-response' => new Captcha()
        ], [
            'name.required' => trans('Name is required'),
            'email.required' => trans('Email is required'),
            'comment.required' => trans('Comment is required'),
        ]);

        $blog_comment = new Blogcomment();
        $blog_comment->blog_id = $id;
        $blog_comment->name = $request->name;
        $blog_comment->email = $request->email;
        $blog_comment->comment = $request->comment;
        $blog_comment->status = 0;
        $blog_comment->save();

        $notify_message = trans('Comment submitted successfully');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);
    }

    public function contact_us()
    {
        $cta_content = getContent('template_1_cta.content', true);

        $contact_us = ContactUs::first();

        $seo_setting = SeoSetting::where('id', 4)->first();
        $pageTitle = trans('Contact Us');
        return view('contact_us', [
            'contact_us' => $contact_us,
            'seo_setting' => $seo_setting,
            'pageTitle' => $pageTitle,
            'cta_content' => $cta_content,
        ]);
    }

    public function faq()
    {
        $faqs_page_content = getContent('faqs_page.content', true);
        $faqs_get_consultations = getContent('faqs_get_consultations.content', true);
        $cta_content = getContent('template_1_cta.content', true);

        $faqs = Faq::latest()->get();
        $partners = Partner::where('status', 'enable')->get();
        $pageTitle = 'FAQs';
        $seo_setting = SeoSetting::where('id', 5)->first();

        return view('faq', [
            'faqs' => $faqs,
            'partners' => $partners,
            'pageTitle' => $pageTitle,
            'seo_setting' => $seo_setting,
            'faqs_page_content' => $faqs_page_content,
            'faqs_get_consultations' => $faqs_get_consultations,
            'cta_content' => $cta_content,
        ]);
    }

    public function teams()
    {
        $teams = Team::latest()->get();
        $pageTitle = 'Our Teams';
        $cta_content = getContent('template_1_cta.content', true);
        $team_hero = getContent('team_hero_section.content', true);

        $team_hero_image = $team_hero->data_values['images'] != '' ? $team_hero->data_values['images'] : [];

        $seo_setting = SeoSetting::where('id', 11)->first();

        return view('teams', [
            'teams' => $teams,
            'seo_setting' => $seo_setting,
            'pageTitle' => $pageTitle,
            'cta_content' => $cta_content,
            'team_hero' => $team_hero,
            'team_hero_image' => $team_hero_image
        ]);
    }

    public function testimonials()
    {
        $pageTitle = 'Testimonials';
        $testimonials = Testimonial::with('translate')->active()->latest()->get();

        return view('frontend.testimonials', compact('testimonials', 'pageTitle'));
    }



    public function privacy_policy()
    {
        $privacy_policy = PrivacyPolicy::first();
        $cta_content = getContent('template_1_cta.content', true);

        $seo_setting = SeoSetting::where('id', 9)->first();

        return view('privacy_policy', ['privacy_policy' => $privacy_policy, 'seo_setting' => $seo_setting, 'cta_content' => $cta_content]);
    }

    public function terms_conditions()
    {
        $terms_conditions = TermAndCondition::first();
        $cta_content = getContent('template_1_cta.content', true);

        $seo_setting = SeoSetting::where('id', 6)->first();

        return view('terms_conditions', ['terms_conditions' => $terms_conditions, 'seo_setting' => $seo_setting, 'cta_content' => $cta_content]);
    }

    public function custom_page($slug)
    {
        $custom_page = CustomPage::where('slug', $slug)->firstOrFail();
        $cta_content = getContent('template_1_cta.content', true);

        return view('custom_page', ['custom_page' => $custom_page, 'cta_content' => $cta_content]);
    }

    public function services(Request $request)
    {
        $digital_transforming_brands = getContent('about_us_digital_transforming_brands.content', true);
        $service_explore_services = getContent('service_explore_services.content', true);
        $service_faqs = getContent('service_faqs.content', true);
        $cta_content = getContent('template_1_cta.content', true);

        $service_explores = Listing::latest()->take(8)->get();
        $seo_setting = SeoSetting::where('id', 10)->first();
        $pageTitle = trans('Services');
        $faqs = Faq::latest()->take(4)->get();

        return view('services', [
            'service_explores' => $service_explores,
            'seo_setting' => $seo_setting,
            'pageTitle' => $pageTitle,
            'faqs' => $faqs,


            'digital_transforming_brands' => $digital_transforming_brands,
            'service_explore_services' => $service_explore_services,
            'service_faqs' => $service_faqs,
            'cta_content' => $cta_content,
        ]);
    }

    public function service(Request $request, $slug)
    {
        $cta_content = getContent('template_1_cta.content', true);
        $blog_adds = getContent('blog_details_add.content', true);

        $service = Listing::where(['status' => 'enable', 'slug' => $slug])->firstOrFail();
        $categories = Category::with('translate')
            ->whereIn('id', Listing::where('status', 'enable')->pluck('category_id'))
            ->where('status', 'enable')
            ->get();
        $popular_services = Listing::where('status', 'enable')
            ->where('id', '!=', $service->id)
            ->latest()
            ->take(6)
            ->get();
        // Get related services from same category
        $showServices = Listing::where('id', '!=', $service->id)
            ->where('status', 'enable')
            ->latest()
            ->take(3)
            ->get();
        $seo_setting = SeoSetting::where('id', 10)->first();
        $pageTitle = trans('Service Details');
        return view('service_detail', [
            'pageTitle' => $pageTitle,
            'seo_setting' => $seo_setting,
            'service' => $service,
            'showServices' => $showServices,
            'categories' => $categories,
            'cta_content' => $cta_content,
            'blog_adds' => $blog_adds,
            'popular_services' => $popular_services,
        ]);
    }

    public function project(Request $request, $slug)
    {
        $project = Project::with(['portfolioCategory', 'portfolioItems.portfolioCategory'])
            ->where(['status' => 'enable', 'slug' => $slug])
            ->firstOrFail();

        $previousProject = Project::where('id', '<', $project->id)
            ->where('status', 'enable')->orderBy('id', 'desc')->first();
        $nextProject = Project::where('id', '>', $project->id)
            ->where('status', 'enable')->orderBy('id', 'asc')->first();

        $cta_content = getContent('template_1_cta.content', true);

        return view('frontend.templates.project_detail', compact('project', 'previousProject', 'nextProject', 'cta_content'));
    }

    public function language_switcher(Request $request)
    {
        $request_lang = Language::where('lang_code', $request->lang_code)->first();
        if ($request_lang) {
            Session::put('front_lang', $request->lang_code);
            Session::put('front_lang_name', $request_lang->lang_name);
            Session::put('lang_dir', $request_lang->lang_direction);

            app()->setLocale($request->lang_code);

            $notify_message = trans('Language switched successfully');
            if (env('APP_MODE') == 'DEMO') {
                $notify_message = array('message' => $notify_message, 'alert-type' => 'success', 'demo_mode' => 'Demo mode does not translate all languages');
            } else {
                $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
            }

            return redirect()->back()->with($notify_message);
        } else {
            return redirect()->back()->with(['message' => trans('Language not found'), 'alert-type' => 'error']);
        }
    }

    public function currency_switcher(Request $request)
    {
        $request_currency = Currency::where('currency_code', $request->currency_code)->first();

        Session::put('currency_name', $request_currency->currency_name);
        Session::put('currency_code', $request_currency->currency_code);
        Session::put('currency_icon', $request_currency->currency_icon);
        Session::put('currency_rate', $request_currency->currency_rate);
        Session::put('currency_position', $request_currency->currency_position);

        $notify_message = trans('Currency switched successful');
        $notify_message = array('message' => $notify_message, 'alert-type' => 'success');
        return redirect()->back()->with($notify_message);

    }

    public function download_submission_file($file)
    {
        $filepath = public_path() . "/uploads/custom-images/" . $file;
        return response()->download($filepath);
    }

    public function portfolio(Request $request)
    {
        $cta_content = getContent('template_1_cta.content', true);
        $portfolioCategories = PortfolioCategory::with('items')->get();

        return view('frontend.templates.portfolio', compact('portfolioCategories', 'cta_content'));
    }

    public function portfolioShow($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $previousProject = Project::where('id', '<', $project->id)->with('category')->orderBy('id', 'desc')->first();
        $nextProject = Project::where('id', '>', $project->id)->with('category')->orderBy('id', 'asc')->first();
        $cta_content = getContent('template_1_cta.content', true);
        $author = Auth::guard('admin')->user();

        return view('project_detail', ['project' => $project, 'previousProject' => $previousProject, 'nextProject' => $nextProject, 'cta_content' => $cta_content, 'author' => $author]);
    }

    public function projects(Request $request)
    {
        $projects = Project::with(['portfolioCategory'])
            ->where('status', 'enable')
            ->latest()
            ->get();

        $categories = $projects->pluck('portfolioCategory')->filter()->unique('id')->values();

        return view('frontend.templates.projects', compact('projects', 'categories'));
    }

    public function download_file($file)
    {
        $filepath = public_path() . "/uploads/custom-images/" . $file;
        return response()->download($filepath);
    }

}
