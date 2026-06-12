@extends('inner_layout')

@section('title')
    <title>{{ config('app.name', __('Forgot Password')) }}</title>
@endsection
@section('frontend_content')
                <main>
                    <section id="h1-breadcrumb" class="bg-main-gray border-b border-[#e7e8e9]">
                        <div class=" w-full h-fit overflow-hidden relative  pb-16 md:pb-24">
                            <div class="theme-container mx-auto h-fit w-fit relative z-20">
                                <div class="mt-[120px] xl:mt-[272px] md:mt-[150px] text-center w-fit mx-auto relative z-10">

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- main container  start  -->
                    <section class="-mt-[100px] pb-16 sm:pb-[130px] relative z-10">
                        <div class="theme-container w-full mx-auto">
                            <div class="flex justify-center items-center">
                                <div
                                    class="max-w-[660px] w-full rounded-[10px] bg-white border border-grayscale-300 py-12 px-30">
                                    <div class="mb-10">
                                        <h4 class="text-34 font-semibold"> {{ __('Forgot Password') }}</h4>
                                    </div>
                                    <form method="POST" action="{{ route('user.send-forget-password') }}">
                                        @csrf
                                        <div class="grid sm:grid-cols-2 gap-5">
                                            <div class="form-box col-span-full">
                                                <label for="emailAddress"
                                                    class="text-base mb-2">{{ __('Email Address') }}</label>
                                                <input type="text" name="email" id="emailAddress" class="form-input"
                                                    placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
                                            </div>
                                            <div class="col-span-full">
                                                <button type="submit"
                                                    class="home-two-btn-bg py-3 w-full bg-main-black border-main-black !flex before:hidden after:hidden hover:text-white">
                                                    <span class="text-base text-white font-semibold">
                                                        {{ __('Forgot Password') }}
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="col-span-full">
                                                <h5 class="text-20 text-paragraph">
                                                    <a href="{{ route('user.login') }}"
                                                        class="text-main-black">{{ __('Back to login') }}</a>
                                                </h5>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- main container  end  -->

                </main>

@endsection
