@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Partner') }}</title>
@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Edit Partner') }}</h3>
    <p class="crancy-header__text">{{ __('Our Partner') }} >> {{ __('Edit Partner') }}</p>
@endsection


@section('body-content')
    <!-- crancy Dashboard -->
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-12">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                        <div class="crancy-dsinner">
                            <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-12 mg-top-30">
                                        <!-- Product Card -->
                                        <div class="crancy-product-card">
                                            <div class="create_new_btn_inline_box">
                                                <h4 class="crancy-product-card__title">{{ __('Update Partner') }}</h4>

                                                <a href="{{ route('admin.partner.index') }}" class="crancy-btn "><i
                                                        class="fa fa-list"></i> {{ __('Partner List') }}</a>
                                            </div>


                                            <div class="row mg-top-30">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="crancy__item-form--group w-100 h-100">
                                                                <label class="crancy__item-label">{{ __('Image') }} *
                                                                </label>
                                                                <div
                                                                    class="crancy-product-card__upload crancy-product-card__upload--border">
                                                                    <input type="file" data-target="view_img"
                                                                        class="btn-check" name="logo" id="input-img1"
                                                                        autocomplete="off" onchange="previewImage(event)">
                                                                    <label class="crancy-image-video-upload__label"
                                                                        for="input-img1">
                                                                        <img id="view_img"
                                                                            src="{{ asset($partner->logo) }}">
                                                                        <h4 class="crancy-image-video-upload__title">
                                                                            {{ __('Click here to') }} <span
                                                                                class="crancy-primary-color">{{ __('Choose File') }}</span>
                                                                            {{ __('and upload') }} </h4>
                                                                        <p style="font-size:12px;color:#888;margin-top:4px;">{{ __('Recommended size: 512 x 115px (SVG)') }}</p>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                                <div class="col-12">
                                                    <div class="crancy__item-form--group mg-top-form-20">
                                                        <label class="crancy__item-label">{{ __('Link') }} </label>
                                                        <input class="crancy__item-input" type="text" name="link"
                                                            id="link" value="{{ $partner->link }}">
                                                    </div>
                                                </div>

                                            </div>

                                            <button class="crancy-btn mg-top-25"
                                                type="submit">{{ __('Update') }}</button>

                                        </div>
                                        <!-- End Product Card -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Dashboard Inner -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End crancy Dashboard -->
@endsection

@push('js_section')
    <script>
        "use strict"

        function previewImage(event) {
            const file = event.target.files[0];
            const targetId = event.target.getAttribute('data-target');
            const output = document.getElementById(targetId);

            const reader = new FileReader();
            reader.onload = function(e) {
                output.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush
