@props(['name'])
<section id="h1-breadcrumb" class="bg-main-gray border-b border-[#e7e8e9]">
    <div class=" w-full h-fit overflow-hidden relative pb-12 md:pb-16 pt-[120px] xl:pt-[180px] md:pt-[130px]">
        <div class="theme-container mx-auto h-fit w-fit relative z-20">
            <div class="text-center w-fit mx-auto relative z-10">
                <h1 class="text-main-black text-34 sm:text-48 font-semibold font-inter">
                    {{ $name }}
                </h1>
                <div class="flex gap-5 items-center justify-center mt-4">
                    <a href="{{ route('home') }}"
                        class="home-two-nav-item leading-5 relative text-paragraph hover:text-purple before:border-purple w-fit">
                        {{ __('Home') }}
                    </a>
                    <svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 6L1 11" stroke="#6D6D6D" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <a href=""
                        class="home-two-nav-item leading-5 relative text-paragraph hover:text-purple before:border-purple w-fit">
                        {{ $name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
