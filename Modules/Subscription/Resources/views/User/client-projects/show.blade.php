@extends('inner_layout')

@section('title')
    <title>{{ $project->name }} — {{ __('Project Details') }}</title>
@endsection

@section('frontend_content')
    <main>
        <x-breadcrumb name="{{ __('Project Details') }}" />

        <section class="dashboard py-20">
            <div class="theme-container mx-auto">
                <div class="flex flex-col xl:flex-row gap-30">
                    @include('user.sidebar')

                    <div class="dashboard-main w-full flex-1 max-w-[982px]">
                        <div class="p-6 rounded-[10px] bg-white" data-aos="fade-up">

                            {{-- Project Header --}}
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-6 pb-6 border-b border-[#E6E0FF]">
                                <div>
                                    <h4 class="text-22 font-semibold text-black">{{ $project->name }}</h4>
                                    <p class="text-paragraph mt-1">{{ $project->title }}</p>
                                    @if ($project->description)
                                        <p class="text-sm text-paragraph mt-2">{{ $project->description }}</p>
                                    @endif
                                </div>
                                <div class="flex flex-wrap gap-2 sm:flex-col sm:items-end">
                                    @if ($project->payment_type === 'split')
                                        <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700">{{ __('Split Payment') }}</span>
                                    @else
                                        <span class="text-xs px-3 py-1 rounded-full bg-purple-100 text-purple-700">{{ __('Monthly Payment') }}</span>
                                    @endif
                                    @if ($project->status === 'active')
                                        <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">{{ __('Active') }}</span>
                                    @elseif ($project->status === 'paused')
                                        <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">{{ __('Paused') }}</span>
                                    @else
                                        <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600">{{ __('Completed') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Project Meta --}}
                            <div class="grid sm:grid-cols-3 gap-4 mb-6 pb-6 border-b border-[#E6E0FF]">
                                <div>
                                    <p class="text-xs text-paragraph uppercase tracking-wide mb-1">{{ __('Total Price') }}</p>
                                    <p class="text-16 font-semibold text-black">{{ currency($project->total_price) }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-paragraph uppercase tracking-wide mb-1">{{ __('Start Date') }}</p>
                                    <p class="text-16 font-medium text-black">{{ $project->start_date?->format('d M Y') ?? '—' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-paragraph uppercase tracking-wide mb-1">{{ __('End Date') }}</p>
                                    <p class="text-16 font-medium text-black">{{ $project->end_date?->format('d M Y') ?? '—' }}</p>
                                </div>
                                @if ($project->gst_enabled)
                                    <div>
                                        <p class="text-xs text-paragraph uppercase tracking-wide mb-1">{{ __('GST') }}</p>
                                        <p class="text-16 font-medium text-black">{{ $project->gst_percent }}%</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Installments Table --}}
                            <h5 class="text-18 font-semibold text-black mb-4">{{ __('Installments') }}</h5>
                            <div class="order-table border border-[#E0E1E1] rounded-lg overflow-hidden w-full overflow-x-auto">
                                <table class="min-w-full divide-y divide-[#E0E1E1]">
                                    <thead>
                                        <tr>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">#</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Base Amount') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('GST') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Total') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Due Date') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Status') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Invoice') }}</h6></th>
                                            <th class="p-4 px-5 bg-gray-50 text-start"><h6 class="text-14 font-medium text-nowrap">{{ __('Action') }}</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#E0E1E1]">
                                        @foreach ($project->installments as $installment)
                                            <tr class="bg-white transition-all">
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 font-medium">{{ $installment->installment_number }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 text-nowrap">{{ currency($installment->base_amount) }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 text-nowrap">{{ currency($installment->gst_amount) }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 font-semibold text-nowrap">{{ currency($installment->total_amount) }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 text-nowrap text-paragraph">{{ $installment->due_date?->format('d M Y') ?? '—' }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    @if ($installment->status === 'paid')
                                                        <span class="text-14 text-nowrap status status-success">{{ __('Paid') }}</span>
                                                    @elseif ($installment->status === 'overdue')
                                                        <span class="text-14 text-nowrap status status-danger">{{ __('Overdue') }}</span>
                                                    @else
                                                        <span class="text-14 text-nowrap status status-pending">{{ __('Pending') }}</span>
                                                    @endif
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    <p class="text-14 text-nowrap text-paragraph">{{ $installment->invoice_number ?? '—' }}</p>
                                                </td>
                                                <td class="px-5 py-3.5 text-start">
                                                    @if ($installment->status === 'pending' && $project->status === 'active')
                                                        <a href="{{ route('user.client-projects.pay', $installment->id) }}"
                                                           class="inline-flex items-center gap-1 px-4 py-2 rounded-lg bg-purple text-white text-sm font-medium hover:bg-opacity-90 transition-all">
                                                            {{ __('Pay Now') }}
                                                        </a>
                                                    @else
                                                        <span class="text-paragraph text-sm">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-5">
                                <a href="{{ route('user.client-projects.index') }}"
                                   class="inline-flex items-center gap-2 text-sm text-purple hover:underline">
                                    ← {{ __('Back to Projects') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
