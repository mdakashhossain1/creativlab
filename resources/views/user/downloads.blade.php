@extends('inner_layout')

@section('title')
<title>{{ __('My Downloads') }}</title>
@endsection

@section('frontend_content')
<main>
    <x-breadcrumb name="{{ __('My Downloads') }}" />

    <section class="dashboard py-20">
        <div class="theme-container mx-auto">
            <div class="flex flex-col xl:flex-row gap-30">
                @include('user.sidebar')

                <div class="dashboard-main w-full flex-1">
                    <div class="p-6 rounded-[10px] bg-white" data-aos="fade-up">

                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-20 font-semibold text-main-black">{{ __('My Downloads') }}</h4>
                        </div>

                        @if($downloads->isEmpty())
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <div class="mb-4 text-gray-300">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 3V15M12 15L8 11M12 15L16 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 17V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <p class="text-paragraph text-16">{{ __('You have no digital product purchases yet.') }}</p>
                                <a href="{{ route('product.shop') }}" class="mt-4 inline-block px-6 py-2.5 bg-purple text-white rounded-lg text-14 font-medium hover:opacity-90 transition-all">
                                    {{ __('Browse Products') }}
                                </a>
                            </div>
                        @else
                            <div class="order-table border border-[#E0E1E1] rounded-lg overflow-hidden w-full overflow-x-auto">
                                <table class="min-w-full divide-y divide-[#E0E1E1]">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="p-4 px-6 bg-gray-50 text-start">
                                                <h6 class="text-14 font-semibold text-nowrap">{{ __('Product') }}</h6>
                                            </th>
                                            <th scope="col" class="p-4 px-6 bg-gray-50 text-start">
                                                <h6 class="text-14 font-semibold text-nowrap">{{ __('Order #') }}</h6>
                                            </th>
                                            <th scope="col" class="p-4 px-6 bg-gray-50 text-start">
                                                <h6 class="text-14 font-semibold text-nowrap">{{ __('Date') }}</h6>
                                            </th>
                                            <th scope="col" class="p-4 px-6 bg-gray-50 text-start">
                                                <h6 class="text-14 font-semibold text-nowrap">{{ __('Amount Paid') }}</h6>
                                            </th>
                                            <th scope="col" class="p-4 px-6 bg-gray-50 text-start">
                                                <h6 class="text-14 font-semibold text-nowrap">{{ __('Download') }}</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#E0E1E1]">
                                        @foreach($downloads as $item)
                                            <tr class="bg-white hover:bg-gray-50 transition-all">
                                                <td class="px-6 py-4 text-start">
                                                    <div class="flex items-center gap-3">
                                                        <div class="size-12 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                                            <img src="{{ asset($item->singleProduct->thumbnail_image ?? '') }}"
                                                                 alt="{{ $item->singleProduct->translate->name ?? '' }}"
                                                                 class="w-full h-full object-cover">
                                                        </div>
                                                        <div>
                                                            <p class="text-14 font-medium text-main-black">
                                                                {{ $item->singleProduct->translate->name ?? $item->singleProduct->slug ?? __('Product') }}
                                                            </p>
                                                            <p class="text-12 text-paragraph mt-0.5">{{ __('Qty') }}: {{ $item->quantity }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-start">
                                                    <p class="text-14 text-paragraph font-mono">{{ $item->order->order_id }}</p>
                                                </td>
                                                <td class="px-6 py-4 text-start">
                                                    <p class="text-14 text-paragraph text-nowrap">{{ $item->order->created_at->format('d M Y') }}</p>
                                                </td>
                                                <td class="px-6 py-4 text-start">
                                                    <p class="text-14 font-semibold text-main-black">{{ currency($item->price) }}</p>
                                                </td>
                                                <td class="px-6 py-4 text-start">
                                                    <a href="{{ route('user.download.serve', $item->download_token) }}"
                                                       class="inline-flex items-center gap-2 px-4 py-2 bg-purple text-white rounded-lg text-13 font-medium hover:opacity-90 transition-all">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 3V15M12 15L8 11M12 15L16 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M3 17V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                        {{ __('Download') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($downloads->hasPages())
                                <div class="pagination flex justify-center items-center gap-30 mt-6">
                                    <a href="{{ $downloads->appends(['per_page' => request('per_page')])->previousPageUrl() }}"
                                       class="flex justify-center items-center size-9 rounded-full bg-white border border-[#E6E6E6] group hover:border-black transition-all duration-300">
                                        <span class="text-[#7C7C7C] group-hover:text-black">
                                            <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.04557 5.72656L5.60807 10.3516C5.76432 10.5078 6.01432 10.5078 6.13932 10.3516L6.76432 9.72656C6.92057 9.57031 6.92057 9.35156 6.76432 9.19531L3.07682 5.44531L6.76432 1.72656C6.92057 1.57031 6.92057 1.32031 6.76432 1.19531L6.13932 0.570312C6.01432 0.414062 5.76432 0.414062 5.60807 0.570312L1.04557 5.19531C0.889323 5.35156 0.889323 5.57031 1.04557 5.72656Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <ul class="flex items-center gap-5">
                                        @for($i = 1; $i <= $downloads->lastPage(); $i++)
                                            <li>
                                                <a href="{{ $downloads->appends(['per_page' => request('per_page')])->url($i) }}"
                                                   class="text-paragraph hover:text-purple font-semibold {{ $i == $downloads->currentPage() ? 'text-purple' : '' }}">
                                                    {{ $i }}
                                                </a>
                                            </li>
                                        @endfor
                                    </ul>
                                    <a href="{{ $downloads->appends(['per_page' => request('per_page')])->nextPageUrl() }}"
                                       class="flex justify-center items-center size-9 rounded-full bg-white border border-[#E6E6E6] group hover:border-black transition-all duration-300">
                                        <span class="text-[#7C7C7C] group-hover:text-black">
                                            <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.73275 5.72656L2.17025 10.3516C2.014 10.5078 1.764 10.5078 1.639 10.3516L1.014 9.72656C0.857747 9.57031 0.857747 9.35156 1.014 9.19531L4.7015 5.44531L1.014 1.72656C0.857747 1.57031 0.857747 1.32031 1.014 1.19531L1.639 0.570312C1.764 0.414062 2.014 0.414062 2.17025 0.570312L6.73275 5.19531C6.889 5.35156 6.889 5.57031 6.73275 5.72656Z" fill="currentColor"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
