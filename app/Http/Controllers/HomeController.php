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
        $theme_setting = GlobalSetting::where('key', 'selected_theme')->first();
        $theme = $request->theme ?? ($theme_setting ? $theme_setting->value : 'theme_one');

        switch ($theme) {
            case 'theme_one':
            case 'all_theme': // Fallback if all_theme is selected
                return $this->businessConsulting();
            case 'theme_two':
                return $this->seoAgency();
            case 'theme_three':
                return $this->creativeAgency();
            case 'theme_four':
                return $this->aiSoftware();
            case 'theme_five':
                return $this->digitalMarketing();
            case 'theme_six':
                return $this->itBusiness();
            case 'theme_seven':
                return $this->saas();
            default:
                return $this->digitalMarketing();
        }
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

    public function seoAgency()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $theme_setting = GlobalSetting::where('key', 'selected_theme')->first();
        $hero_content = getContent('theme_two_hero.content', true);
        $theme_two_tools = getContent('theme_two_tools.content', true);
        $about_companies = getContent('about_company.content', true);
        $explore_services = getContent('explore_services.content', true);
        $case_studies = getContent('case_studies.content', true);
        $our_testimonials = getContent('our_testimonials.content', true);
        $faqs_sections = getContent('faqs.content', true);
        $contact_us = getContent('contact_us.content', true);

        $testimonials = Testimonial::where('status', 'active')->latest()->get();
        $faqs = Faq::latest()->take(4)->get();
        $service_explores = Listing::latest()->take(4)->get();
        $partners = Partner::where('status', 'enable')->get();
        $projects = Project::where('status', 'enable')->take(4)->get();
        $section_visibility_2 = ManageSection::where('page_name', 'home_two')->where('status', 1)->get();

        return view('seo-agency.index', compact(
            'seo_setting', 'hero_content', 'theme_two_tools', 'about_companies',
            'explore_services', 'case_studies', 'testimonials', 'faqs',
            'service_explores', 'our_testimonials', 'faqs_sections',
            'contact_us', 'partners', 'projects', 'theme_setting',
            'section_visibility_2'
        ));
    }

    public function creativeAgency()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $theme_setting = GlobalSetting::where('key', 'selected_theme')->first();
        $hero_content_3 = getContent('themplate_3_hero_section.content', true);
        $partners = Partner::all();
        $about_content_3 = getContent('template_3_about_company.content', true);
        $services = Listing::where('status', 'enable')->latest()->take(6)->get();
        $caseStudies = Project::with('category')->where('status', 'enable')->latest()->take(4)->get();
        $teams = Team::latest()->take(4)->get();
        $team_count = Team::count();
        $currentLang = session()->get('front_lang');
        $pricing_content = getContent('template_3_pricing_section.content', true);
        $testimonials = Testimonial::latest()->take(6)->get();
        $blogs = Blog::where('status', 1)->with('category')->latest()->take(3)->get();
        $cta_content_3 = getContent('template_3_cta_section.content', true);
        $testimonial_content_3 = getContent('template_3_testimonial_section.content', true);
        $section_visibility_3 = ManageSection::where('page_name', 'home_three')->where('status', 1)->get();
        $subscription_plans = SubscriptionPlan::orderBy('serial', 'asc')->get();

        $socails_media = $currentLang === 'en'
            ? ($cta_content_3->data_values['social_media'] ?? [])
            : getTranslatedValue($cta_content_3, 'social_media', $currentLang);

        $packageInformation = $currentLang === 'en'
            ? ($pricing_content->data_values['package_information'] ?? [])
            : getTranslatedValue($pricing_content, 'package_information', $currentLang);

        return view('creative-agency.index', compact(
            'seo_setting', 'hero_content_3', 'partners', 'about_content_3',
            'services', 'caseStudies', 'teams', 'pricing_content',
            'subscription_plans', 'testimonials', 'blogs', 'cta_content_3',
            'socails_media', 'team_count', 'testimonial_content_3',
            'theme_setting', 'section_visibility_3', 'packageInformation'
        ));
    }

    public function aiSoftware()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $hero_content = getContent('theme_four_hero.content', true);
        $ur_cool_features = getContent('ur_cool_features.content', true);
        $what_we_do = getContent('what_we_do.content', true);
        $theme_four_faqs = getContent('theme_four_faqs.content', true);
        $theme_four_moving_image = getContent('theme_4_moving_image.content', true);
        $currentLang = session()->get('front_lang');
        $pricingContent = getContent('theme_4_pricing_section.content', true);
        $theme_four_testimonials = getContent('theme_4_testimonials.content', true);
        $cta_content = getContent('home_4_cta_section.content', true);
        $section_visibility_4 = ManageSection::where('page_name', 'home_four')->where('status', 1)->get();
        $subscription_plans = SubscriptionPlan::orderBy('serial', 'asc')->get();

        $packageInformation = $currentLang === 'en'
            ? ($pricingContent->data_values['package_information'] ?? [])
            : getTranslatedValue($pricingContent, 'package_information', $currentLang);

        $partners = Partner::where('status', 'enable')->get();
        $faqs = Faq::latest()->take(4)->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();

        return view('ai-software.index', compact(
            'seo_setting', 'hero_content', 'ur_cool_features', 'what_we_do',
            'theme_four_faqs', 'theme_four_moving_image', 'partners', 'faqs',
            'testimonials', 'pricingContent', 'subscription_plans',
            'theme_four_testimonials', 'cta_content', 'section_visibility_4',
            'packageInformation'
        ));
    }

    public function businessConsulting()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $services_items = Listing::where('status', 'enable')->latest()->skip(1)->take(3)->get();
        $about_content_5 = getContent('template_5_about_us_section.content', true);
        $we_provide_content = getContent('template_5_we_provide_section.content', true);
        $counter_content_5 = getContent('theme_5_counter_section.content', true);
        $testimonial_content_5 = getContent('theme_5_testimonial_section.content', true);
        $cta_content_home_5 = getContent('theme_5_cta_section.content', true);
        $hero_image = getContent('home_5_hero_section.content', true);
        $projects = Project::where('status', 'enable')->take(6)->get();
        $section_visibility_5 = ManageSection::where('page_name', 'home_five')->where('status', 1)->get();

        $teams = Team::latest()->take(4)->get();
        $team_count = Team::count();
        $currentLang = session()->get('front_lang');
        $pricing_content = getContent('template_3_pricing_section.content', true);
        $blogs = Blog::where('status', 1)->with('category')->latest()->take(3)->get();
        $testimonials = Testimonial::latest()->take(6)->get();
        $partners = Partner::all();
        $testimonial_content = getContent('theme_seven_testimonial.content', true);

        return view('business-consulting.index', compact(
            'seo_setting', 'services_items', 'about_content_5', 'we_provide_content',
            'teams', 'team_count', 'projects', 'counter_content_5',
            'testimonial_content', 'testimonial_content_5', 'testimonials',
            'blogs', 'partners', 'cta_content_home_5', 'hero_image',
            'section_visibility_5'
        ));
    }

    public function itBusiness()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $hero_content = getContent('theme_seven_hero.content', true);
        $partner_content = getContent('theme_seven_partner.content', true);
        $about_company_content = getContent('theme_seven_about_company.content', true);
        $explore_services_content = getContent('theme_seven_explore_services.content', true);
        $working_process_content = getContent('theme_seven_working_process.content', true);
        $case_story_content = getContent('theme_seven_case_story.content', true);
        $business_benefits_content = getContent('theme_seven_business_benefits.content', true);
        $testimonial_content = getContent('theme_seven_testimonial.content', true);
        $faqs_content = getContent('theme_seven_faqs.content', true);
        $get_consultations_content = getContent('theme_seven_get_consultations.content', true);

        $partners = Partner::where('status', 'enable')->get();
        $service_explores = Listing::latest()->take(4)->get();
        $projects = Project::where('status', 'enable')->latest()->take(3)->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $faqs = Faq::latest()->take(4)->get();
        $section_visibility_6 = ManageSection::where('page_name', 'home_six')->where('status', 1)->get();

        return view('it-business.index', compact(
            'seo_setting', 'hero_content', 'partner_content', 'about_company_content',
            'explore_services_content', 'working_process_content', 'case_story_content',
            'business_benefits_content', 'testimonial_content', 'faqs_content',
            'get_consultations_content', 'partners', 'service_explores',
            'projects', 'testimonials', 'faqs', 'section_visibility_6'
        ));
    }

    public function saas()
    {
        $seo_setting = SeoSetting::where('id', 1)->first();
        $hero_content = getContent('theme_eight_hero.content', true);
        $partner_content = getContent('theme_eight_partner.content', true);
        $why_use_us_content = getContent('theme_eight_why_use_us.content', true);
        $core_features_content = getContent('theme_eight_core_features.content', true);
        $core_features_two_content = getContent('theme_eight_core_features_two.content', true);
        $why_use_us_two_content = getContent('theme_eight_why_use_us_two.content', true);
        $customer_say_about_us_content = getContent('theme_eight_customer_say_about_us.content', true);
        $automating_design_system_content = getContent('theme_eight_automating_design_system.content', true);
        $faqs_content = getContent('theme_eight_faqs.content', true);
        $testimonials_content = getContent('theme_eight_testimonials.content', true);

        $partners = Partner::where('status', 'enable')->get();
        $service_explores = Listing::latest()->take(8)->get();
        $faqs = Faq::latest()->take(4)->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $section_visibility_7 = ManageSection::where('page_name', 'home_seven')->where('status', 1)->get();

        return view('saas.index', compact(
            'seo_setting', 'hero_content', 'partner_content', 'why_use_us_content',
            'core_features_content', 'core_features_two_content', 'why_use_us_two_content',
            'customer_say_about_us_content', 'faqs_content', 'automating_design_system_content',
            'testimonials_content', 'section_visibility_7', 'service_explores',
            'partners', 'faqs', 'testimonials'
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
        $testimonial_content_5 = getContent('theme_5_testimonial_section.content', true);
        $partners = Partner::where('status', 'enable')->get();
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        $teams = Team::latest()->take(4)->get();
        $teams_count = Team::count();
        $pageTitle = trans('About Us');
        $testimonial_content = getContent('theme_seven_testimonial.content', true);

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
            'testimonial_content_5' => $testimonial_content_5,
            'testimonial_content' => $testimonial_content


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
        $cta_content = getContent('template_1_cta.content', true);

        $faqs = Faq::latest()->get();
        $pageTitle = 'FAQs';
        $seo_setting = SeoSetting::where('id', 5)->first();

        return view('faq', [
            'faqs' => $faqs,
            'pageTitle' => $pageTitle,
            'seo_setting' => $seo_setting,
            'faqs_page_content' => $faqs_page_content,
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
        $project = Project::where(['status' => 'enable', 'slug' => $slug])->firstOrFail();

        return view('project_detail', [
            'project' => $project,
        ]);
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
        $projects = Project::latest()->paginate(6);



        return view('frontend.templates.portfolio', compact('projects', 'cta_content'));
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

    public function download_file($file)
    {
        $filepath = public_path() . "/uploads/custom-images/" . $file;
        return response()->download($filepath);
    }

}
