<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Frontend;

class FrontendLandingPagesSeeder extends Seeder
{
    public function run(): void
    {
        $sections = $this->getSections();

        foreach ($sections as $dataKey => $values) {
            // Separate image entries from text values for data_translations
            $textValues = array_filter($values, fn($k) => $k !== 'images', ARRAY_FILTER_USE_KEY);

            $record = Frontend::updateOrCreate(
                ['data_keys' => $dataKey],
                ['data_values' => $values]
            );

            // Always store data_translations with the 'en' entry — same pattern the admin store() uses
            $currentTranslations = json_decode($record->getRawOriginal('data_translations') ?? '[]', true) ?? [];

            $enExists = false;
            foreach ($currentTranslations as &$t) {
                if (($t['language_code'] ?? '') === 'en') {
                    $t['values'] = $textValues;
                    $enExists = true;
                    break;
                }
            }
            unset($t);

            if (!$enExists) {
                $currentTranslations[] = ['language_code' => 'en', 'values' => $textValues];
            }

            $record->data_translations = json_encode($currentTranslations);
            $record->saveQuietly();
        }
    }

    private function getSections(): array
    {
        return [

            // ─── SEO OPTIMIZATION ────────────────────────────────────────────

            'seo_hero.content' => [
                'badge_text'      => 'SEO Optimization Agency',
                'heading'         => 'We Drive <span>SEO</span> That Ranks &amp; Generates Leads',
                'description'     => 'We optimize websites with proven SEO strategies that improve rankings, drive organic traffic, and grow your business.',
                'cta_button_1'    => 'Start Your Journey',
                'cta_button_1_url'=> '',
                'cta_button_2'    => 'View Case Studies',
                'cta_button_2_url'=> '',
                'pill_1'          => 'Keyword Research',
                'pill_2'          => 'On-Page SEO',
                'pill_3'          => 'Link Building',
                'pill_4'          => 'Local SEO',
                'pill_5'          => 'Content SEO',
                'pill_6'          => 'Fast & Secure',
            ],

            'seo_features.content' => [
                'badge_text'      => 'SEO Solutions',
                'heading'         => 'Boost Rankings.<br>Increase Traffic.<br><span class="text-purple">Grow Your Business.</span>',
                'description'     => 'Our data-driven SEO strategies help your website rank higher, attract qualified visitors, and deliver the right audience consistently.',
                'feature_1'       => 'Highest search rankings',
                'feature_2'       => 'Quality organic traffic',
                'feature_3'       => 'Better user experience',
                'feature_4'       => 'Long-term sustainable growth',
                'cta_button'      => 'Get Free SEO Audit',
                'cta_button_url'  => '',
            ],

            'seo_solutions.content' => [
                'section_label'    => 'WHAT WE OFFER',
                'section_title'    => 'Complete <span class="text-purple">SEO Optimization</span> Solutions',
                'solution_1_title' => 'Keyword Research',
                'solution_1_desc'  => 'We find high-potential keywords that drive relevant traffic.',
                'solution_2_title' => 'On-Page SEO',
                'solution_2_desc'  => 'Optimize content, meta tags, headings & website structure.',
                'solution_3_title' => 'Technical SEO',
                'solution_3_desc'  => 'Improve site speed, crawlability, indexing & overall performance.',
                'solution_4_title' => 'Content Optimization',
                'solution_4_desc'  => 'Create SEO-friendly content that ranks and engages your audience.',
                'solution_5_title' => 'Link Building',
                'solution_5_desc'  => 'Build high-quality backlinks to increase authority and ranking.',
                'solution_6_title' => 'Local SEO',
                'solution_6_desc'  => 'Optimise your presence to rank higher in local search results.',
                'solution_7_title' => 'SEO Audit',
                'solution_7_desc'  => 'Detailed website audit to find issues and growth opportunities.',
                'solution_8_title' => 'Analytics & Reporting',
                'solution_8_desc'  => 'Track performance and get monthly SEO reports with insights.',
            ],

            'seo_results.content' => [
                'section_label'        => 'OUR SUCCESS STORIES',
                'section_title'        => 'SEO Results <span class="text-purple">That Speak</span>',
                'result_1_title'       => 'FinEdge Finance',
                'result_1_tag'         => 'Finance',
                'result_1_stat1_value' => '+152%',
                'result_1_stat1_label' => 'Organic Traffic',
                'result_1_stat2_value' => '+85%',
                'result_1_stat2_label' => 'Growth',
                'result_2_title'       => 'Urbanic Interiors',
                'result_2_tag'         => 'Interior',
                'result_2_stat1_value' => '+210%',
                'result_2_stat1_label' => 'Organic Traffic',
                'result_2_stat2_value' => '+120%',
                'result_2_stat2_label' => 'Growth',
                'result_3_title'       => 'FitLife Gym',
                'result_3_tag'         => 'Health & Fitness',
                'result_3_stat1_value' => '+190%',
                'result_3_stat1_label' => 'Organic Traffic',
                'result_3_stat2_value' => '+90%',
                'result_3_stat2_label' => 'Growth',
                'result_4_title'       => 'EduSmart Academy',
                'result_4_tag'         => 'Education',
                'result_4_stat1_value' => '+165%',
                'result_4_stat1_label' => 'Organic Traffic',
                'result_4_stat2_value' => '+75%',
                'result_4_stat2_label' => 'Growth',
                'result_5_title'       => 'TasteBite Restaurant',
                'result_5_tag'         => 'Restaurant',
                'result_5_stat1_value' => '+200%',
                'result_5_stat1_label' => 'Organic Traffic',
                'result_5_stat2_value' => '+110%',
                'result_5_stat2_label' => 'Growth',
                'result_6_title'       => 'NovaShop Retail',
                'result_6_tag'         => 'E-commerce',
                'result_6_stat1_value' => '+245%',
                'result_6_stat1_label' => 'Organic Traffic',
                'result_6_stat2_value' => '+130%',
                'result_6_stat2_label' => 'Growth',
                'result_7_title'       => 'GreenLeaf Wellness',
                'result_7_tag'         => 'Wellness',
                'result_7_stat1_value' => '+178%',
                'result_7_stat1_label' => 'Organic Traffic',
                'result_7_stat2_value' => '+95%',
                'result_7_stat2_label' => 'Growth',
                'result_8_title'       => 'TravelMate Tours',
                'result_8_tag'         => 'Travel',
                'result_8_stat1_value' => '+225%',
                'result_8_stat1_label' => 'Organic Traffic',
                'result_8_stat2_value' => '+105%',
                'result_8_stat2_label' => 'Growth',
            ],

            'seo_process.content' => [
                'section_label' => 'OUR PROCESS',
                'section_title' => 'Our Proven <span class="text-purple">SEO Process</span>',
                'step_1_title'  => 'Research & Analysis',
                'step_1_desc'   => 'We analyze your website, competitors and keywords to find the best opportunities.',
                'step_2_title'  => 'Strategy Planning',
                'step_2_desc'   => 'We create a custom SEO strategy tailored specifically for your business goals.',
                'step_3_title'  => 'Optimization & Implementation',
                'step_3_desc'   => 'We optimise your website and implement proven SEO techniques.',
                'step_4_title'  => 'Tracking & Growth',
                'step_4_desc'   => 'We monitor results and continuously improve your rankings and traffic.',
            ],

            'seo_stats.content' => [
                'stat_1_value' => '250+',
                'stat_1_label' => 'Websites Optimized',
                'stat_2_value' => '1M+',
                'stat_2_label' => 'Organic Traffic Generated',
                'stat_3_value' => '95%',
                'stat_3_label' => 'Client Retention',
                'stat_4_value' => '#1',
                'stat_4_label' => 'Rankings Achieved',
            ],

            'seo_cta.content' => [
                'section_label' => 'GET STARTED TODAY',
                'heading'       => 'Ready to Rank Higher &amp;<br><span class="text-purple">Grow Your Business?</span>',
                'description'   => "Let's build an SEO strategy that brings more traffic, leads and long-term growth.",
                'button_1_text' => 'Get Free SEO Audit',
                'button_1_url'  => '',
                'button_2_text' => 'View Services',
                'button_2_url'  => '',
            ],

            // ─── AD FILMS ───────────────────────────────────────────────────

            'ad_films_hero.content' => [
                'badge_text'       => 'Ad Films Production House',
                'heading'          => 'We Create <span>Ad Films</span> That <span>Inspire</span> &amp; Drive Action',
                'description'      => 'Powerful storytelling. Cinematic visuals. Strategic messaging. We create ad films that connect, influence and convert.',
                'cta_button_1'     => 'Start Your Project',
                'cta_button_1_url' => '',
                'cta_button_2'     => 'Our Services',
                'cta_button_2_url' => '',
                'pill_1'           => 'Creative Concept',
                'pill_2'           => 'Cinematic Production',
                'pill_3'           => 'Brand Storytelling',
                'pill_4'           => 'High-Quality Output',
                'pill_5'           => 'Product Shoot',
                'pill_6'           => 'Emotional Connect',
            ],

            'ad_films_features.content' => [
                'badge_text'      => 'Ad Film Production',
                'heading'         => 'Telling Your Brand<br>Story Through<br><span class="text-purple">Powerful Visuals</span>',
                'description'     => 'We combine creativity, strategy, and high-end production to craft ad films that leave a lasting impression and drive real business results.',
                'feature_1'       => 'Compelling storytelling',
                'feature_2'       => 'Cinematic quality',
                'feature_3'       => 'Strong brand impact',
                'feature_4'       => 'Better audience engagement',
                'cta_button'      => 'Learn More',
                'cta_button_url'  => '',
            ],

            'ad_films_solutions.content' => [
                'section_label'    => 'WHAT WE OFFER',
                'section_title'    => 'Complete <span class="text-purple">Ad Film Production</span> Solutions',
                'solution_1_title' => 'Concept & Scripting',
                'solution_1_desc'  => 'Creative ideas and engaging scripts that bring your brand story to life.',
                'solution_2_title' => 'Pre-Production',
                'solution_2_desc'  => 'Planning, storyboarding, location and scheduling.',
                'solution_3_title' => 'Production',
                'solution_3_desc'  => 'High-quality shooting with professional crew, camera and equipment.',
                'solution_4_title' => 'Product Shoots',
                'solution_4_desc'  => 'Cinematic product videos that highlight features and build desire.',
                'solution_5_title' => 'Editing & Post-Production',
                'solution_5_desc'  => 'Smooth editing, color grading, VFX and sound design for impact.',
                'solution_6_title' => 'Voice Over & Sound',
                'solution_6_desc'  => 'Professional voice overs and background score that elevate the story.',
                'solution_7_title' => 'Brand Films',
                'solution_7_desc'  => 'Build brand identity and emotional connect through powerful visuals.',
                'solution_8_title' => 'Social Media Ad Films',
                'solution_8_desc'  => 'Short, engaging ad films that perform best for reels, ads & digital platforms.',
            ],

            'ad_films_projects.content' => [
                'section_label'    => 'OUR WORK',
                'section_title'    => 'Recent <span class="text-purple">Ad Film</span> Projects',
                'project_1_title'  => 'Glowverse Skincare',
                'project_1_tag'    => 'Brand Film',
                'project_2_title'  => 'UrbanBite Bites',
                'project_2_tag'    => 'Product Ad Film',
                'project_3_title'  => 'TasteBud Restaurant',
                'project_3_tag'    => 'Promotional Film',
                'project_4_title'  => 'BuildCraft Cement',
                'project_4_tag'    => 'Commercial Film',
                'project_5_title'  => 'EduSmart Learning',
                'project_5_tag'    => 'Brand Film',
                'project_6_title'  => 'NovaTech Gadgets',
                'project_6_tag'    => 'Product Ad Film',
                'project_7_title'  => 'GreenLeaf Organics',
                'project_7_tag'    => 'Brand Film',
                'project_8_title'  => 'FitZone Gym',
                'project_8_tag'    => 'Promotional Film',
            ],

            'ad_films_process.content' => [
                'section_label' => 'OUR PROCESS',
                'section_title' => 'How We Create <span class="text-purple">Impactful Ad Films</span>',
                'step_1_title'  => 'Discover & Plan',
                'step_1_desc'   => 'We understand your brand, audience & goals to plan the perfect concept.',
                'step_2_title'  => 'Script & Concept',
                'step_2_desc'   => 'We craft a creative script and visual concept that tells your story.',
                'step_3_title'  => 'Shoot & Produce',
                'step_3_desc'   => 'Professional shooting with cinematic techniques and creative direction.',
                'step_4_title'  => 'Edit & Deliver',
                'step_4_desc'   => 'We edit, enhance and deliver a film that creates impact and converts.',
            ],

            'ad_films_stats.content' => [
                'stat_1_value' => '300+',
                'stat_1_label' => 'Ad Films Created',
                'stat_2_value' => '150+',
                'stat_2_label' => 'Brands Served',
                'stat_3_value' => '50M+',
                'stat_3_label' => 'Views Generated',
                'stat_4_value' => '95%',
                'stat_4_label' => 'Client Satisfaction',
            ],

            'ad_films_cta.content' => [
                'section_label' => 'GET STARTED TODAY',
                'heading'       => 'Ready to Create an<br><span class="text-purple">Ad Film</span> That Drives Results?',
                'description'   => "Let's create a powerful story that connects with your audience and takes your brand to the next level.",
                'button_1_text' => 'Get Free Consultation',
                'button_1_url'  => '',
                'button_2_text' => 'View Showreel',
                'button_2_url'  => '',
            ],

            // ─── WHATSAPP API ───────────────────────────────────────────────

            'whatsapp_hero.content' => [
                'badge_text'            => 'Official WhatsApp Business API',
                'heading'               => 'Official <span>WhatsApp API</span> Solutions For <span>Businesses</span>',
                'description'           => 'Automate conversations, engage customers, and grow your business with powerful WhatsApp automation solutions.',
                'cta_button_1'          => 'Get Started',
                'cta_button_1_url'      => '',
                'cta_button_2'          => 'Book Meeting',
                'cta_button_2_url'      => '',
                'pill_1'                => 'Bulk Msg',
                'pill_2'                => 'AI Chat BOT',
                'pill_3'                => 'AI Automation',
                'partner_badge_label_1' => 'Official Partner of',
                'partner_badge_label_2' => 'Powered By',
            ],

            'whatsapp_services.content' => [
                'section_label'    => 'OUR SERVICES',
                'section_title'    => '<span class="text-purple">WhatsApp API</span> Services',
                'service_1_title'  => 'Bulk Messaging',
                'service_1_desc'   => 'Send promotional messages, offers, updates and notifications to thousands of customers instantly.',
                'service_2_title'  => 'AI Chatbot',
                'service_2_desc'   => 'Build smart chatbot flows to automate conversations and provide instant customer support.',
                'service_3_title'  => 'Campaign Automation',
                'service_3_desc'   => 'Create, schedule and automate WhatsApp marketing campaigns to engage and re-engage your customers.',
                'service_4_title'  => 'Lead Generation',
                'service_4_desc'   => 'Capture high-quality leads directly from WhatsApp and manage them in one place.',
                'service_5_title'  => 'CRM Integration',
                'service_5_desc'   => 'Integrate WhatsApp with your CRM and automate workflows to boost productivity.',
                'service_6_title'  => 'Customer Support',
                'service_6_desc'   => 'Deliver fast and personalized customer support with a shared team inbox and smart automation.',
            ],

            'whatsapp_why_work.content' => [
                'section_title'  => 'Why Work With CreativLab?',
                'point_1_title'  => 'Complete Setup Assistance',
                'point_1_desc'   => 'We help businesses with API setup, verification, integration, and complete onboarding support.',
                'point_2_title'  => 'Automation Strategy',
                'point_2_desc'   => 'Custom WhatsApp automation strategies tailored to your business goals and customer journey.',
                'point_3_title'  => 'Personalized Workflows',
                'point_3_desc'   => 'Smart chatbot flows and campaigns built specifically for your business needs.',
                'point_4_title'  => 'Ongoing Campaign Support',
                'point_4_desc'   => 'We help optimise campaigns, improve engagement, and scale customer communication effectively.',
            ],

            'whatsapp_process.content' => [
                'section_label' => 'Our work process',
                'section_title' => 'Simple Steps, <span class="text-purple">Powerful Result</span>',
                'step_1_title'  => 'Understanding',
                'step_1_desc'   => 'We understand your business, audience, and communication goals to create the right automation strategy.',
                'step_2_title'  => 'Setup & Automation',
                'step_2_desc'   => 'We set up the WhatsApp API, chatbot flows, campaigns, and automation systems for your business.',
                'step_3_title'  => 'Campaign & Engagement',
                'step_3_desc'   => 'We help you run campaigns, automate customer interactions, and improve engagement efficiently.',
                'step_4_title'  => 'Optimize & Grow',
                'step_4_desc'   => 'We analyze performance, optimize workflows, and scale your WhatsApp communication system for better results.',
            ],

            'whatsapp_cta.content' => [
                'heading'          => 'Ready to <span style="color:#7DFFB0;">Automate</span><br>Customer Communication?',
                'description'      => 'Let us help you build a smart WhatsApp Automation system that improves engagement, support & sales',
                'badge_1'          => 'More Engagement',
                'badge_2'          => 'Higher Conversion',
                'card_title'       => 'Book your free consultation',
                'card_desc'        => "Let's Discuss how we can help your Business grow with WhatsApp",
                'card_button'      => 'Book free consultation',
                'card_button_url'  => '',
            ],

            // ─── CREATIVE CONTENT ───────────────────────────────────────────

            'creative_content_hero.content' => [
                'badge_text'       => 'Creative Content Agency',
                'heading'          => 'We Create <span>Content</span> That <span>Connects</span> &amp; Converts',
                'description'      => 'Compelling content strategies that engage your audience, build your brand, and drive measurable results.',
                'cta_button_1'     => 'Start Your Project',
                'cta_button_1_url' => '',
                'cta_button_2'     => 'View Our Work',
                'cta_button_2_url' => '',
                'trust_text'       => 'Trusted by 200+ brands',
                'trust_subtext'    => 'across industries',
                'stat_1_label'     => 'Content Pieces',
                'stat_1_value'     => '5000+',
                'stat_2_label'     => 'Happy Clients',
                'stat_2_value'     => '200+',
                'stat_3_label'     => 'Engagement Rate',
                'stat_3_value'     => '3x',
                'stat_4_label'     => 'Brands Served',
                'stat_4_value'     => '50+',
            ],

            'creative_content_features.content' => [
                'badge_text'       => 'Content Solutions',
                'heading'          => 'Content That Builds<br>Brands &amp; Drives<br><span class="text-purple">Real Results</span>',
                'description'      => 'We craft content strategies that attract, engage and convert your ideal audience across every platform.',
                'feature_1_title'  => 'SEO-Optimized Content',
                'feature_1_desc'   => 'Content crafted to rank on search engines and drive organic traffic.',
                'feature_2_title'  => 'Engaging Storytelling',
                'feature_2_desc'   => 'Stories that connect with your audience and build brand trust.',
                'feature_3_title'  => 'Multi-Platform Strategy',
                'feature_3_desc'   => 'Content tailored for social, web, email and beyond.',
                'feature_4_title'  => 'Data-Driven Approach',
                'feature_4_desc'   => 'Every piece of content backed by research and performance data.',
                'cta_link_text'    => 'Explore Content Services',
                'cta_link_url'     => '',
            ],

            'creative_content_solutions.content' => [
                'section_label'    => 'WHAT WE OFFER',
                'section_title'    => 'Complete <span class="text-purple">Content Creation</span> Solutions',
                'solution_1_title' => 'Blog Writing',
                'solution_1_desc'  => 'SEO-optimized blog posts that drive organic traffic and build authority.',
                'solution_2_title' => 'Social Media Content',
                'solution_2_desc'  => 'Engaging posts, reels and stories that grow your social presence.',
                'solution_3_title' => 'Video Scripts',
                'solution_3_desc'  => 'Compelling scripts for YouTube, reels, ads and brand videos.',
                'solution_4_title' => 'Website Copywriting',
                'solution_4_desc'  => 'Persuasive web copy that converts visitors into customers.',
                'solution_5_title' => 'Email Campaigns',
                'solution_5_desc'  => 'Targeted email content that nurtures leads and boosts conversions.',
                'solution_6_title' => 'Infographics',
                'solution_6_desc'  => 'Visual content that simplifies complex information and drives shares.',
                'solution_7_title' => 'Product Descriptions',
                'solution_7_desc'  => 'Compelling product copy that highlights benefits and drives sales.',
                'solution_8_title' => 'Content Strategy',
                'solution_8_desc'  => 'Full content planning and calendar management for consistent growth.',
            ],

            'creative_content_recent_creations.content' => [
                'section_label' => 'RECENT WORK',
                'section_title' => 'Our Latest <span class="text-purple">Creative Content</span>',
            ],

            'creative_content_process.content' => [
                'section_label' => 'OUR PROCESS',
                'section_title' => 'Our <span class="text-purple">Content Creation</span> Process',
                'step_1_title'  => 'Research & Strategy',
                'step_1_desc'   => 'We research your audience, competitors and goals to build the right content strategy.',
                'step_2_title'  => 'Content Planning',
                'step_2_desc'   => 'We plan a content calendar aligned with your marketing objectives.',
                'step_3_title'  => 'Creation & Design',
                'step_3_desc'   => 'Our team creates high-quality content tailored to your brand voice.',
                'step_4_title'  => 'Publish & Optimize',
                'step_4_desc'   => 'We publish, track performance and continuously optimize for better results.',
            ],

            'creative_content_how_we_create.content' => [
                'section_label' => 'HOW WE WORK',
                'section_title' => 'How We Create <span class="text-purple">Impactful Content</span>',
                'step_1_title'  => 'Brand Discovery',
                'step_1_desc'   => 'We dive deep into your brand identity, values and target audience.',
                'step_2_title'  => 'Idea Generation',
                'step_2_desc'   => 'Creative brainstorming sessions to develop fresh, relevant content ideas.',
                'step_3_title'  => 'Content Production',
                'step_3_desc'   => 'Skilled writers, designers and strategists bring your content to life.',
                'step_4_title'  => 'Review & Deliver',
                'step_4_desc'   => 'Thorough quality check and timely delivery of polished content.',
            ],

            'creative_content_stats.content' => [
                'stat_1_value' => '5000+',
                'stat_1_label' => 'Content Pieces Created',
                'stat_2_value' => '200+',
                'stat_2_label' => 'Happy Clients',
                'stat_3_value' => '3x',
                'stat_3_label' => 'Average Engagement Increase',
                'stat_4_value' => '98%',
                'stat_4_label' => 'Client Satisfaction',
            ],

            'creative_content_services.content' => [
                'section_label'    => 'OUR SERVICES',
                'section_title'    => 'Content Services <span class="text-purple">That Deliver</span>',
                'section_desc'     => 'From strategy to execution, we provide end-to-end content solutions for your business.',
                'service_1_title'  => 'Content Strategy',
                'service_1_desc'   => 'Comprehensive content planning aligned with your business goals.',
                'service_2_title'  => 'Blog & Article Writing',
                'service_2_desc'   => 'SEO-optimized long-form content that builds authority and traffic.',
                'service_3_title'  => 'Social Media Management',
                'service_3_desc'   => 'Consistent, engaging social content that grows your following.',
                'service_4_title'  => 'Video Production',
                'service_4_desc'   => 'Professional videos that tell your brand story effectively.',
                'service_5_title'  => 'Email Marketing',
                'service_5_desc'   => 'High-converting email campaigns that nurture and retain customers.',
                'service_6_title'  => 'Graphic Design',
                'service_6_desc'   => 'Eye-catching visuals that strengthen your brand identity.',
                'service_7_title'  => 'Podcast Production',
                'service_7_desc'   => 'Professional podcast content that builds thought leadership.',
                'service_8_title'  => 'Content Analytics',
                'service_8_desc'   => 'Data-driven insights to optimize your content performance.',
            ],

            'creative_content_portfolio.content' => [
                'section_label'   => 'OUR PORTFOLIO',
                'section_title'   => 'Content That <span class="text-purple">Speaks Results</span>',
                'item_1_title'    => 'Brand Campaign',
                'item_1_tag'      => 'Social Media',
                'item_2_title'    => 'Product Launch',
                'item_2_tag'      => 'Content Strategy',
                'item_3_title'    => 'Blog Series',
                'item_3_tag'      => 'SEO Content',
                'item_4_title'    => 'Video Series',
                'item_4_tag'      => 'Video Content',
                'item_5_title'    => 'Email Campaign',
                'item_5_tag'      => 'Email Marketing',
                'item_6_title'    => 'Infographic Pack',
                'item_6_tag'      => 'Visual Content',
                'item_7_title'    => 'Website Copy',
                'item_7_tag'      => 'Copywriting',
                'item_8_title'    => 'Social Calendar',
                'item_8_tag'      => 'Social Media',
            ],

            'creative_content_cta.content' => [
                'section_label' => 'GET STARTED TODAY',
                'heading'       => 'Ready to Create Content<br>That <span class="text-purple">Drives Real Results?</span>',
                'description'   => "Let's build a content strategy that attracts your audience, builds your brand, and grows your business.",
                'button_1_text' => 'Start Your Project',
                'button_1_url'  => '',
                'button_2_text' => 'View Our Work',
                'button_2_url'  => '',
                'card_1_label'  => 'Content Pieces',
                'card_1_value'  => '5000+',
                'card_2_label'  => 'Happy Clients',
                'card_2_value'  => '200+',
            ],

            // ─── WEB DEVELOPMENT ────────────────────────────────────────────

            'web_dev_hero.content' => [
                'badge_text'       => 'Web Development Agency',
                'heading'          => 'We Build <span>Websites</span> That <span>Perform</span> &amp; Convert',
                'description'      => 'Custom web development solutions that are fast, secure, and designed to grow your business online.',
                'cta_button_1'     => 'Start Your Project',
                'cta_button_1_url' => '',
                'cta_button_2'     => 'View Our Work',
                'cta_button_2_url' => '',
                'pill_1'           => 'React & Next.js',
                'pill_2'           => 'Laravel & PHP',
                'pill_3'           => 'E-Commerce',
                'pill_4'           => 'UI/UX Design',
                'pill_5'           => 'API Development',
                'pill_6'           => 'Performance Optimized',
            ],

            'web_dev_features.content' => [
                'badge_text'      => 'Web Solutions',
                'heading'         => 'Modern Web<br>Development That<br><span class="text-purple">Drives Growth</span>',
                'description'     => 'We build fast, scalable and beautiful websites that help your business stand out and generate real results.',
                'feature_1_title' => 'Custom Web Design',
                'feature_1_desc'  => 'Unique, pixel-perfect designs tailored to your brand identity.',
                'feature_2_title' => 'Fast & Secure',
                'feature_2_desc'  => 'Optimized for speed and built with security best practices.',
                'feature_3_title' => 'Mobile-First Approach',
                'feature_3_desc'  => 'Responsive designs that look perfect on all devices.',
                'feature_4_title' => 'SEO-Ready Build',
                'feature_4_desc'  => 'Built with SEO best practices to help you rank higher.',
                'cta_link_text'   => 'Explore Web Services',
                'cta_link_url'    => '',
            ],

            'web_dev_solutions.content' => [
                'section_label'    => 'WHAT WE BUILD',
                'section_title'    => 'Complete <span class="text-purple">Web Development</span> Solutions',
                'solution_1_title' => 'Business Websites',
                'solution_1_desc'  => 'Professional websites that build trust and generate leads for your business.',
                'solution_2_title' => 'E-Commerce Stores',
                'solution_2_desc'  => 'Powerful online stores with seamless shopping experiences.',
                'solution_3_title' => 'Landing Pages',
                'solution_3_desc'  => 'High-converting landing pages designed to capture leads and drive sales.',
                'solution_4_title' => 'Web Applications',
                'solution_4_desc'  => 'Custom web apps built for performance, scalability and user experience.',
                'solution_5_title' => 'WordPress Development',
                'solution_5_desc'  => 'Flexible, easy-to-manage WordPress websites tailored to your needs.',
                'solution_6_title' => 'API Development',
                'solution_6_desc'  => 'Robust REST APIs that power your web and mobile applications.',
                'solution_7_title' => 'UI/UX Design',
                'solution_7_desc'  => 'Intuitive, beautiful interfaces that delight users and improve conversions.',
                'solution_8_title' => 'Website Maintenance',
                'solution_8_desc'  => 'Ongoing support, updates and optimization to keep your site running perfectly.',
            ],

            'web_dev_recent_projects.content' => [
                'section_label'     => 'OUR WORK',
                'section_title'     => 'Recent <span class="text-purple">Web Development</span> Projects',
                'project_1_title'   => 'FinTech Dashboard',
                'project_1_tag_1'   => 'Web App',
                'project_1_tag_2'   => 'React',
                'project_2_title'   => 'E-Commerce Store',
                'project_2_tag_1'   => 'E-Commerce',
                'project_2_tag_2'   => 'Laravel',
                'project_3_title'   => 'Healthcare Portal',
                'project_3_tag_1'   => 'Web App',
                'project_3_tag_2'   => 'Next.js',
                'project_4_title'   => 'Restaurant Website',
                'project_4_tag_1'   => 'Business Website',
                'project_4_tag_2'   => 'WordPress',
                'project_5_title'   => 'Real Estate Platform',
                'project_5_tag_1'   => 'Web App',
                'project_5_tag_2'   => 'Laravel',
                'project_6_title'   => 'EdTech Platform',
                'project_6_tag_1'   => 'Web App',
                'project_6_tag_2'   => 'React',
                'project_7_title'   => 'Fashion Store',
                'project_7_tag_1'   => 'E-Commerce',
                'project_7_tag_2'   => 'Shopify',
                'project_8_title'   => 'Corporate Website',
                'project_8_tag_1'   => 'Business Website',
                'project_8_tag_2'   => 'WordPress',
            ],

            'web_dev_process.content' => [
                'section_label' => 'OUR PROCESS',
                'section_title' => 'Our <span class="text-purple">Web Development</span> Process',
                'step_1_title'  => 'Discovery & Planning',
                'step_1_desc'   => 'We understand your goals, audience and requirements to plan the perfect solution.',
                'step_2_title'  => 'Design & Prototype',
                'step_2_desc'   => 'We create beautiful wireframes and designs that match your brand and vision.',
                'step_3_title'  => 'Development & Testing',
                'step_3_desc'   => 'Our developers build your project with clean code and rigorous testing.',
                'step_4_title'  => 'Launch & Support',
                'step_4_desc'   => 'We deploy your project and provide ongoing support to ensure everything runs perfectly.',
            ],

            'web_dev_stats.content' => [
                'stat_1_value' => '300+',
                'stat_1_label' => 'Websites Built',
                'stat_2_value' => '150+',
                'stat_2_label' => 'Happy Clients',
                'stat_3_value' => '99%',
                'stat_3_label' => 'Uptime Guaranteed',
                'stat_4_value' => '5★',
                'stat_4_label' => 'Average Client Rating',
            ],

            'web_dev_cta.content' => [
                'section_label' => 'GET STARTED TODAY',
                'heading'       => 'Ready to Build a Website<br><span class="text-purple">That Grows Your Business?</span>',
                'description'   => "Let's create a fast, beautiful and high-performing website that turns visitors into customers.",
                'button_1_text' => 'Start Your Project',
                'button_1_url'  => '',
                'button_2_text' => 'View Our Work',
                'button_2_url'  => '',
                'card_1_label'  => 'Projects Completed',
                'card_1_value'  => '300+',
                'card_2_label'  => 'Happy Clients',
                'card_2_value'  => '150+',
            ],

        ];
    }
}
