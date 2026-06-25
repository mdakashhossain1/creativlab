@extends('admin.master_layout')
@section('title')<title>{{ __('Edit Email Template') }}</title>@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Edit Email Template') }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Edit Email Template') }}</p>
@endsection
@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row"><div class="col-12"><div class="crancy-body"><div class="crancy-dsinner">
            <div class="row"><div class="col-12 mg-top-30"><div class="crancy-product-card">
                <div class="crancy-customer-filter"><div class="crancy-customer-filter__single crancy-customer-filter__single--csearch"><div class="crancy-header__form crancy-header__form--customer">
                    <h4 class="crancy-product-card__title">{{ __('Dynamic Keyword') }}</h4>
                </div></div></div>
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer">
                        <thead class="crancy-table__head"><tr>
                            <th class="crancy-table__column-1 crancy-table__h1">{{ __('Keyword') }}</th>
                            <th class="crancy-table__column-2 crancy-table__h2">{{ __('Meaning') }}</th>
                        </tr></thead>
                        <tbody class="crancy-table__body">
                            @foreach([
                                ['{{title}}',       'Task / Meeting Title'],
                                ['{{meeting_time}}','Scheduled Meeting Time'],
                                ['{{description}}', 'Task Description'],
                            ] as [$kw, $meaning])
                            <tr><td class="crancy-table__column-2 crancy-table__data-2"><h4 class="crancy-table__product-title">{{ $kw }}</h4></td>
                            <td class="crancy-table__column-2 crancy-table__data-2"><h4 class="crancy-table__product-title">{{ __($meaning) }}</h4></td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div></div></div>
        </div></div></div>
    </div>
</section>
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row"><div class="col-12"><div class="crancy-body"><div class="crancy-dsinner">
            <form action="{{ route('admin.update-email-template', $template_item->id) }}" enctype="multipart/form-data" method="POST">
                @csrf @method('PUT')
                <div class="row"><div class="col-12"><div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Edit') }} {{ $template_item->name }}</h4>
                    <div class="row">
                        <div class="col-12"><div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('Subject') }}</label>
                            <input class="crancy__item-input" type="text" name="subject" value="{{ $template_item->subject }}">
                        </div></div>
                        <div class="col-12"><div class="crancy__item-form--group mg-top-form-20">
                            <label class="crancy__item-label">{{ __('Description') }}</label>
                            <input class="crancy__item-input crancy__item-textarea summernote" type="text" name="description" value="{{ $template_item->description }}">
                        </div></div>
                    </div>
                    <button class="crancy-btn mg-top-25" type="submit">{{ __('Update') }}</button>
                </div></div></div>
            </form>
        </div></div></div>
    </div>
</section>
@endsection
@push('style_section')
<style>.tox .tox-promotion,.tox-statusbar__branding{display:none!important;}</style>
@endpush
@push('js_section')
<script src="{{ asset('global/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>(function($){"use strict";$(document).ready(function(){tinymce.init({selector:'.summernote',plugins:'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',toolbar:'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat'});});})( jQuery);</script>
@endpush
