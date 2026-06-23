<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $sections = [
        'home_two' => [
            ['section_name' => 'Hero Section',             'component_name' => '_hero_section',             'serial_number' => 1,  'status' => 1],
            ['section_name' => 'Partner Section',          'component_name' => '_partner_section',          'serial_number' => 2,  'status' => 1],
            ['section_name' => 'Features Section',         'component_name' => '_features_section',         'serial_number' => 3,  'status' => 1],
            ['section_name' => 'Content Solutions Section','component_name' => '_content_solutions_section','serial_number' => 4,  'status' => 1],
            ['section_name' => 'Recent Creations Section', 'component_name' => '_recent_creations_section', 'serial_number' => 5,  'status' => 1],
            ['section_name' => 'Process Section',          'component_name' => '_process_section',          'serial_number' => 6,  'status' => 1],
            ['section_name' => 'How We Create Section',    'component_name' => '_how_we_create_section',    'serial_number' => 7,  'status' => 0],
            ['section_name' => 'Creative Stats Section',   'component_name' => '_creative_stats_section',   'serial_number' => 8,  'status' => 1],
            ['section_name' => 'Services Section',         'component_name' => '_services_section',         'serial_number' => 9,  'status' => 1],
            ['section_name' => 'Stats Section',            'component_name' => '_stats_section',            'serial_number' => 10, 'status' => 1],
            ['section_name' => 'Portfolio Section',        'component_name' => '_portfolio_section',        'serial_number' => 11, 'status' => 1],
            ['section_name' => 'CTA Banner Section',       'component_name' => '_cta_banner_section',       'serial_number' => 12, 'status' => 1],
        ],
        'home_three' => [
            ['section_name' => 'Hero Section',          'component_name' => '_hero_section',          'serial_number' => 1, 'status' => 1],
            ['section_name' => 'Partner Section',       'component_name' => '_partner_section',       'serial_number' => 2, 'status' => 1],
            ['section_name' => 'Features Section',      'component_name' => '_features_section',      'serial_number' => 3, 'status' => 1],
            ['section_name' => 'Solutions Section',     'component_name' => '_solutions_section',     'serial_number' => 4, 'status' => 1],
            ['section_name' => 'Recent Projects Section','component_name' => '_recent_projects_section','serial_number' => 5, 'status' => 1],
            ['section_name' => 'Process Section',       'component_name' => '_process_section',       'serial_number' => 6, 'status' => 1],
            ['section_name' => 'Stats Section',         'component_name' => '_stats_section',         'serial_number' => 7, 'status' => 1],
            ['section_name' => 'CTA Banner Section',    'component_name' => '_cta_banner_section',    'serial_number' => 8, 'status' => 1],
        ],
        'home_four' => [
            ['section_name' => 'Hero Section',       'component_name' => '_hero_section',       'serial_number' => 1, 'status' => 1],
            ['section_name' => 'Partner Section',    'component_name' => '_partner_section',    'serial_number' => 2, 'status' => 1],
            ['section_name' => 'Features Section',   'component_name' => '_features_section',   'serial_number' => 3, 'status' => 1],
            ['section_name' => 'Solutions Section',  'component_name' => '_solutions_section',  'serial_number' => 4, 'status' => 1],
            ['section_name' => 'Results Section',    'component_name' => '_results_section',    'serial_number' => 5, 'status' => 1],
            ['section_name' => 'Process Section',    'component_name' => '_process_section',    'serial_number' => 6, 'status' => 1],
            ['section_name' => 'Stats Section',      'component_name' => '_stats_section',      'serial_number' => 7, 'status' => 1],
            ['section_name' => 'CTA Banner Section', 'component_name' => '_cta_banner_section', 'serial_number' => 8, 'status' => 1],
        ],
        'home_five' => [
            ['section_name' => 'Hero Section',       'component_name' => '_hero_section',       'serial_number' => 1, 'status' => 1],
            ['section_name' => 'Features Section',   'component_name' => '_features_section',   'serial_number' => 2, 'status' => 1],
            ['section_name' => 'Solutions Section',  'component_name' => '_solutions_section',  'serial_number' => 3, 'status' => 1],
            ['section_name' => 'Projects Section',   'component_name' => '_projects_section',   'serial_number' => 4, 'status' => 1],
            ['section_name' => 'Process Section',    'component_name' => '_process_section',    'serial_number' => 5, 'status' => 1],
            ['section_name' => 'Stats Section',      'component_name' => '_stats_section',      'serial_number' => 6, 'status' => 1],
            ['section_name' => 'CTA Banner Section', 'component_name' => '_cta_banner_section', 'serial_number' => 7, 'status' => 1],
        ],
        'home_six' => [
            ['section_name' => 'Hero Section',       'component_name' => '_hero_section',       'serial_number' => 1, 'status' => 1],
            ['section_name' => 'Services Section',   'component_name' => '_services_section',   'serial_number' => 2, 'status' => 1],
            ['section_name' => 'Why Work Section',   'component_name' => '_why_work_section',   'serial_number' => 3, 'status' => 1],
            ['section_name' => 'Process Section',    'component_name' => '_process_section',    'serial_number' => 4, 'status' => 1],
            ['section_name' => 'CTA Banner Section', 'component_name' => '_cta_banner_section', 'serial_number' => 5, 'status' => 1],
        ],
    ];

    public function up(): void
    {
        $now = now();

        foreach ($this->sections as $pageName => $rows) {
            if (DB::table('manage_sections')->where('page_name', $pageName)->exists()) {
                continue;
            }

            $insert = array_map(fn($row) => array_merge($row, [
                'page_name'  => $pageName,
                'created_at' => $now,
                'updated_at' => $now,
            ]), $rows);

            DB::table('manage_sections')->insert($insert);
        }
    }

    public function down(): void
    {
        DB::table('manage_sections')
            ->whereIn('page_name', array_keys($this->sections))
            ->delete();
    }
};
