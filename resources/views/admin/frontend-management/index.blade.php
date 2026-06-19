@extends('admin.master_layout')
@section('title')
    <title>{{ __('Frontend Management') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Frontend Management') }}</h3>
    <p class="crancy-header__text">{{ __('Frontend Management') }} >> {{ __('All Sections') }}</p>
@endsection

@section('body-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <div class="crancy-dsinner">
                            <div class="crancy-table crancy-table--v3 mg-top-30">

                                @foreach ($groupedSections as $groupName => $sections)
                                    <div style="border: 2px solid #dee2e6; border-radius: 8px; overflow: hidden; margin-bottom: 32px;">
                                        <div style="background: #2c3e50; border-bottom: 2px solid #dee2e6; padding: 12px 20px;">
                                            <h5 class="mb-0 fw-bold" style="color: #fff; font-size: 15px; letter-spacing: 0.5px;">
                                                <i class="fas fa-layer-group me-2" style="opacity:0.8;"></i>
                                                {{ $groupName }}
                                                <span style="font-size:12px; font-weight:400; opacity:0.7; margin-left:8px;">({{ count($sections) }} section{{ count($sections) > 1 ? 's' : '' }})</span>
                                            </h5>
                                        </div>
                                        <div style="padding: 16px; background: #f8f9fa;">
                                            <div class="row">
                                                @foreach ($sections as $key => $section)
                                                    <div class="col-md-4 col-sm-6 mb-3">
                                                        <div class="card h-100 shadow-sm" style="border: 1px solid #dee2e6; border-radius: 6px;">
                                                            <div class="card-body d-flex justify-content-between align-items-center" style="padding: 12px 16px;">
                                                                <span class="card-title mb-0" style="font-size: 13px; font-weight: 600; color: #333; line-height: 1.3;">{{ $section['name'] }}</span>
                                                                <a href="{{ route('admin.front-end.section', ['id' => $key, 'lang_code' => admin_lang()]) }}"
                                                                    class="btn btn-sm btn-primary ms-2" style="flex-shrink:0;" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div style="background: #2c3e50; height: 3px;"></div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
