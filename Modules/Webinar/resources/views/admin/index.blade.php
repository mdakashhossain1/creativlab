@extends('admin.master_layout')

@section('title')
<title>Webinar Pages</title>
@endsection

@section('body-header')
<h4 class="crancy-header__title">Webinar Pages</h4>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Webinars</li>
    </ol>
</nav>
@endsection

@section('body-content')
<div class="crancy-body">
    <div class="crancy-ds">
        <div class="crancy-ds__main crancy-ds__main--v3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="crancy-table crancy-table--v3 mg-top-30">
                            <div class="crancy-table__heading">
                                <h4 class="crancy-table__title">All Webinar Pages</h4>
                                <a href="{{ route('admin.webinar.create') }}" class="crancy-btn crancy-btn__header">
                                    <i class="fas fa-plus"></i> Create Webinar
                                </a>
                            </div>
                            <div class="crancy-table__inner">
                                <table id="dataTable" class="table crancy-table__main">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Registrations</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($webinars as $i => $webinar)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><strong>{{ $webinar->title }}</strong></td>
                                            <td><small class="text-muted">{{ $webinar->slug }}</small></td>
                                            <td>{{ $webinar->webinar_date ? $webinar->webinar_date->format('d M Y, H:i') : '—' }}</td>
                                            <td>
                                                @if($webinar->payment_enabled)
                                                    {{ $webinar->currency_symbol }}{{ number_format($webinar->price, 2) }}
                                                @else
                                                    <span class="badge bg-success">Free</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $webinar->registrations()->count() }}</span>
                                            </td>
                                            <td>
                                                @if($webinar->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="crancy-btn dropdown-toggle" type="button"
                                                        id="dropdownWebinar{{ $webinar->id }}"
                                                        data-bs-toggle="dropdown"
                                                        data-bs-flip="false"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownWebinar{{ $webinar->id }}">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.builder', $webinar->id) }}">
                                                                <i class="fas fa-paint-brush"></i> {{ __('Page Builder') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('webinar.show', $webinar->slug) }}" target="_blank">
                                                                <i class="fas fa-eye"></i> {{ __('Preview') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.registrations', $webinar->id) }}">
                                                                <i class="fas fa-users"></i> {{ __('Registrations') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.webinar.edit', $webinar->id) }}">
                                                                <i class="fas fa-cog"></i> {{ __('Settings') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('admin.webinar.destroy', $webinar->id) }}" method="POST"
                                                                  onsubmit="return confirm('Delete this webinar?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
