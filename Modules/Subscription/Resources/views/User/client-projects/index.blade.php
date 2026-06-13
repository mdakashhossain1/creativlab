@extends('inner_layout')

@section('title')
    <title>{{ __('My Projects') }}</title>
@endsection

@section('frontend_content')
    <main>
        <x-breadcrumb name="{{ __('My Projects') }}" />

        <section class="dashboard py-20">
            <div class="theme-container mx-auto">
                <div class="flex flex-col xl:flex-row gap-30">
                    @include('user.sidebar')

                    <div class="dashboard-main w-full flex-1 max-w-[982px]">
                        <div class="p-6 rounded-[10px] bg-white" data-aos="fade-up">
                            <h4 class="text-22 font-semibold mb-6">{{ __('My Client Projects') }}</h4>

                            @if ($projects->isEmpty())
                                @include('user._no_order')
                            @else
                                <div class="grid sm:grid-cols-2 gap-6">
                                    @foreach ($projects as $project)
                                        <div class="border border-[#E6E0FF] rounded-xl p-5 flex flex-col gap-3">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h5 class="text-18 font-semibold text-black">{{ $project->name }}</h5>
                                                    <p class="text-sm text-paragraph mt-1">{{ $project->title }}</p>
                                                </div>
                                                <div class="flex flex-col items-end gap-1">
                                                    {{-- Payment type badge --}}
                                                    @if ($project->payment_type === 'split')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700">{{ __('Split') }}</span>
                                                    @else
                                                        <span class="text-xs px-3 py-1 rounded-full bg-purple-100 text-purple-700">{{ __('Monthly') }}</span>
                                                    @endif
                                                    {{-- Status badge --}}
                                                    @if ($project->status === 'active')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">{{ __('Active') }}</span>
                                                    @elseif ($project->status === 'paused')
                                                        <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">{{ __('Paused') }}</span>
                                                    @else
                                                        <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600">{{ __('Completed') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between text-sm text-paragraph">
                                                <span>{{ __('Total') }}: <strong class="text-black">{{ currency($project->total_price) }}</strong></span>
                                                @php $pendingCount = $project->pendingInstallments->count(); @endphp
                                                @if ($pendingCount > 0)
                                                    <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-600">
                                                        {{ $pendingCount }} {{ __('payment(s) due') }}
                                                    </span>
                                                @else
                                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600">
                                                        {{ __('All paid') }}
                                                    </span>
                                                @endif
                                            </div>

                                            @if ($project->start_date || $project->end_date)
                                                <p class="text-xs text-paragraph">
                                                    @if ($project->start_date)
                                                        {{ __('Start') }}: {{ $project->start_date->format('d M Y') }}
                                                    @endif
                                                    @if ($project->end_date)
                                                        &nbsp;|&nbsp; {{ __('End') }}: {{ $project->end_date->format('d M Y') }}
                                                    @endif
                                                </p>
                                            @endif

                                            <a href="{{ route('user.client-projects.show', $project->id) }}"
                                               class="mt-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-purple text-white text-sm font-medium hover:bg-opacity-90 transition-all">
                                                {{ __('View Details') }}
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
