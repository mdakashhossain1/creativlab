@extends('admin.master_layout')
@section('title')<title>{{ $viewMode === 'inbox' ? __('Inbox') : __('Mailbox') }}</title>@endsection

@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Mailbox') }}</h3>
    <p class="crancy-header__text">{{ __('Email') }} >> {{ $viewMode === 'inbox' ? __('Inbox') : __('Sent') }}</p>
@endsection

@push('style_section')
<style>
.mailbox-wrap { display:flex; gap:0; min-height:75vh; background:#fff; border-radius:12px; box-shadow:0 2px 20px rgba(0,0,0,.06); overflow:hidden; }

/* Sidebar */
.mailbox-sidebar { width:260px; flex-shrink:0; border-right:1px solid #eef0f7; display:flex; flex-direction:column; padding:20px 0; background:#fafbff; }
.mailbox-sidebar-inner { display:flex; flex-direction:column; height:100%; }
.mailbox-compose-btn { margin:0 16px 20px; }
.mailbox-compose-btn .crancy-btn { width:100%; justify-content:center; display:flex; align-items:center; gap:8px; padding:12px 20px; }
.mailbox-section-title { font-size:10px; font-weight:700; letter-spacing:1px; color:#a0a3bd; text-transform:uppercase; padding:8px 20px 6px; }
.mailbox-folder-item { display:flex; align-items:center; gap:10px; padding:10px 20px; color:#4a4f73; text-decoration:none; border-left:3px solid transparent; transition:all .2s; }
.mailbox-folder-item:hover, .mailbox-folder-item.active { background:#eff1fd; color:#4338ca; border-left-color:#4338ca; }
.mailbox-folder-item i { width:18px; text-align:center; font-size:14px; }
.mailbox-folder-item .ml-auto { margin-left:auto; }
.mailbox-folder-item .folder-count { background:#4338ca; color:#fff; border-radius:999px; min-width:20px; height:20px; padding:0 5px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; justify-content:center; line-height:1; flex-shrink:0; }
.mailbox-folder-item .folder-count.danger { background:#ef4444; }
.mailbox-folder-item .folder-count.warning { background:#f59e0b; color:#1a1d3b; }
.mailbox-divider { border:none; border-top:1px solid #eef0f7; margin:10px 0; }
.mailbox-account-item { display:flex; align-items:center; gap:10px; padding:9px 16px; cursor:pointer; text-decoration:none; color:#4a4f73; border-left:3px solid transparent; transition:all .2s; }
.mailbox-account-item:hover, .mailbox-account-item.active { background:#eff1fd; color:#4338ca; border-left-color:#4338ca; }
.mailbox-account-avatar { width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:13px; flex-shrink:0; }
.mailbox-account-info { flex:1; min-width:0; }
.mailbox-account-name { display:block; font-size:12px; font-weight:600; color:inherit; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.mailbox-account-email { display:block; font-size:11px; color:#a0a3bd; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.mailbox-account-item .folder-count { background:#4338ca; color:#fff; border-radius:999px; min-width:20px; height:20px; padding:0 5px; font-size:11px; font-weight:700; display:inline-flex; align-items:center; justify-content:center; flex-shrink:0; }

/* Main area */
.mailbox-main { flex:1; display:flex; flex-direction:column; min-width:0; }
.mailbox-toolbar { display:flex; align-items:center; gap:12px; padding:16px 20px; border-bottom:1px solid #eef0f7; flex-wrap:wrap; }
.mailbox-search { flex:1; min-width:200px; position:relative; }
.mailbox-search input { width:100%; padding:9px 14px 9px 36px; border:1px solid #e8eaf0; border-radius:8px; font-size:13px; background:#f8f9ff; outline:none; }
.mailbox-search input:focus { border-color:#4338ca; background:#fff; }
.mailbox-search i { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#a0a3bd; font-size:13px; }
.mailbox-filter-btns { display:flex; gap:6px; flex-wrap:wrap; }
.mailbox-filter-btn { padding:7px 14px; border-radius:6px; border:1px solid #e8eaf0; background:#fff; font-size:12px; color:#4a4f73; cursor:pointer; text-decoration:none; transition:all .15s; display:inline-flex; align-items:center; gap:5px; }
.mailbox-filter-btn:hover, .mailbox-filter-btn.active { background:#4338ca; border-color:#4338ca; color:#fff; }

/* Email list */
.mailbox-list { flex:1; overflow-y:auto; }
.mailbox-item { display:flex; align-items:center; gap:14px; padding:14px 20px; border-bottom:1px solid #f1f3f8; cursor:pointer; transition:background .15s; }
.mailbox-item:hover { background:#f7f8ff; }
.mailbox-item.active { background:#eff1fd; border-left:3px solid #4338ca; }
.mailbox-item.unread .mailbox-item-to,
.mailbox-item.unread .mailbox-item-subject { font-weight:700; color:#1a1d3b; }
.mailbox-item-avatar { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:14px; flex-shrink:0; }
.mailbox-item-body { flex:1; min-width:0; }
.mailbox-item-row1 { display:flex; align-items:center; justify-content:space-between; margin-bottom:3px; }
.mailbox-item-to { font-size:13px; font-weight:600; color:#1a1d3b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:200px; }
.mailbox-item-date { font-size:11px; color:#a0a3bd; white-space:nowrap; margin-left:8px; }
.mailbox-item-subject { font-size:12px; font-weight:500; color:#4a4f73; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.mailbox-item-preview { font-size:11px; color:#a0a3bd; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-top:2px; }
.mailbox-item-badge { flex-shrink:0; }

/* Detail panel */
.mailbox-detail-panel { display:none; width:420px; flex-shrink:0; border-left:1px solid #eef0f7; flex-direction:column; }
.mailbox-detail-panel.open { display:flex; }
.mailbox-detail-header { padding:16px 20px; border-bottom:1px solid #eef0f7; display:flex; align-items:center; justify-content:space-between; }
.mailbox-detail-subject { font-size:15px; font-weight:700; color:#1a1d3b; }
.mailbox-detail-meta { padding:14px 20px; border-bottom:1px solid #f1f3f8; font-size:12px; color:#6b7280; }
.mailbox-detail-meta span { color:#1a1d3b; font-weight:600; }
.mailbox-detail-body { flex:1; padding:20px; overflow-y:auto; font-size:13px; color:#4a4f73; line-height:1.7; }
.close-detail-btn { background:none; border:none; cursor:pointer; font-size:18px; color:#a0a3bd; }
.close-detail-btn:hover { color:#4338ca; }

/* Stats cards */
.mailbox-stats { display:flex; gap:12px; padding:16px 20px; border-bottom:1px solid #eef0f7; }
.mailbox-stat-card { flex:1; background:#f8f9ff; border-radius:8px; padding:12px 16px; text-align:center; }
.mailbox-stat-number { font-size:22px; font-weight:800; color:#1a1d3b; }
.mailbox-stat-label { font-size:11px; color:#a0a3bd; text-transform:uppercase; letter-spacing:.5px; }

.mailbox-empty { text-align:center; padding:60px 20px; color:#a0a3bd; }
.mailbox-empty i { font-size:48px; margin-bottom:12px; display:block; }

@media(max-width:991px) {
    .mailbox-sidebar { width:220px; }
    .mailbox-detail-panel { width:100%; }
}
@media(max-width:767px) {
    .mailbox-wrap { flex-direction:column; }
    .mailbox-sidebar { width:100%; border-right:none; border-bottom:1px solid #eef0f7; }
    .mailbox-detail-panel { width:100%; border-left:none; border-top:1px solid #eef0f7; }
}

.av-purple  { background:linear-gradient(135deg,#667eea,#764ba2); }
.av-blue    { background:linear-gradient(135deg,#4facfe,#00f2fe); }
.av-green   { background:linear-gradient(135deg,#43e97b,#38f9d7); }
.av-orange  { background:linear-gradient(135deg,#f6d365,#fda085); }
.av-red     { background:linear-gradient(135deg,#f093fb,#f5576c); }
.av-teal    { background:linear-gradient(135deg,#4481eb,#04befe); }
</style>
@endpush

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="crancy-body">
            <div class="crancy-dsinner mg-top-30">

                <div class="mailbox-wrap">

                    {{-- ===== LEFT SIDEBAR ===== --}}
                    <div class="mailbox-sidebar">
                        <div class="mailbox-sidebar-inner">

                            {{-- Compose Button --}}
                            <div class="mailbox-compose-btn">
                                <button class="crancy-btn" data-bs-toggle="modal" data-bs-target="#composeModal" style="width:100%;justify-content:center;display:flex;gap:8px;">
                                    <i class="fas fa-pencil-alt"></i> {{ __('Compose') }}
                                </button>
                            </div>

                            {{-- Mail Folders --}}
                            <p class="mailbox-section-title">{{ __('Folders') }}</p>

                            <a href="{{ route('admin.mailbox.inbox') }}" class="mailbox-folder-item {{ $viewMode === 'inbox' ? 'active' : '' }}">
                                <i class="fas fa-inbox"></i>
                                <span>{{ __('Inbox') }}</span>
                                @if($inboxUnread > 0)
                                    <span class="folder-count warning ml-auto">{{ $inboxUnread }}</span>
                                @endif
                            </a>

                            <a href="{{ route('admin.mailbox.index') }}" class="mailbox-folder-item {{ $viewMode === 'sent' && !request('status') && !request('account') ? 'active' : '' }}">
                                <i class="fas fa-paper-plane"></i>
                                <span>{{ __('Sent') }}</span>
                                @if($viewMode === 'sent')
                                    <span class="folder-count ml-auto">{{ $stats['total'] ?? 0 }}</span>
                                @endif
                            </a>

                            @if($viewMode === 'sent')
                            <a href="{{ route('admin.mailbox.index', ['status' => 'failed']) }}" class="mailbox-folder-item {{ request('status') === 'failed' ? 'active' : '' }}">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ __('Failed') }}</span>
                                @if(($stats['failed'] ?? 0) > 0)
                                    <span class="folder-count danger ml-auto">{{ $stats['failed'] }}</span>
                                @endif
                            </a>
                            @endif

                            <hr class="mailbox-divider">

                            {{-- Accounts --}}
                            <p class="mailbox-section-title">{{ __('Accounts') }}</p>

                            @php $colors = ['av-purple','av-blue','av-green','av-orange','av-red','av-teal']; @endphp
                            @forelse($accounts as $i => $account)
                                @php
                                    $acctRoute = $viewMode === 'inbox'
                                        ? route('admin.mailbox.inbox', ['account' => $account->id])
                                        : route('admin.mailbox.index', ['account' => $account->id]);
                                @endphp
                                <a href="{{ $acctRoute }}" class="mailbox-account-item {{ request('account') == $account->id ? 'active' : '' }}">
                                    <div class="mailbox-account-avatar {{ $colors[$i % count($colors)] }}">
                                        {{ strtoupper(substr($account->name, 0, 1)) }}
                                    </div>
                                    <div class="mailbox-account-info">
                                        <span class="mailbox-account-name">{{ $account->name }}</span>
                                        <span class="mailbox-account-email">{{ $account->email }}</span>
                                    </div>
                                    @if($account->logs_count > 0)
                                        <span class="folder-count ml-auto">{{ $account->logs_count }}</span>
                                    @endif
                                </a>
                            @empty
                                <p class="text-center text-muted small px-3">{{ __('No accounts added.') }}</p>
                            @endforelse

                            <div class="mt-auto px-4 pb-2 pt-4">
                                <a href="{{ route('admin.email-accounts.index') }}" class="crancy-btn" style="width:100%;justify-content:center;display:flex;gap:8px;font-size:12px;background:#6c757d;">
                                    <i class="fas fa-cog"></i> {{ __('Manage Accounts') }}
                                </a>
                            </div>

                        </div>
                    </div>

                    {{-- ===== MAIN AREA ===== --}}
                    <div class="mailbox-main">

                        {{-- Stats --}}
                        <div class="mailbox-stats">
                            @if($viewMode === 'sent')
                                <div class="mailbox-stat-card">
                                    <div class="mailbox-stat-number">{{ $stats['total'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Total') }}</div>
                                </div>
                                <div class="mailbox-stat-card" style="background:#f0fdf4;">
                                    <div class="mailbox-stat-number" style="color:#16a34a;">{{ $stats['sent'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Sent') }}</div>
                                </div>
                                <div class="mailbox-stat-card" style="background:#fff1f2;">
                                    <div class="mailbox-stat-number" style="color:#dc2626;">{{ $stats['failed'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Failed') }}</div>
                                </div>
                            @else
                                <div class="mailbox-stat-card">
                                    <div class="mailbox-stat-number">{{ $inboxStats['total'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Total') }}</div>
                                </div>
                                <div class="mailbox-stat-card" style="background:#fffbeb;">
                                    <div class="mailbox-stat-number" style="color:#d97706;">{{ $inboxStats['unread'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Unread') }}</div>
                                </div>
                                <div class="mailbox-stat-card" style="background:#f0fdf4;">
                                    <div class="mailbox-stat-number" style="color:#16a34a;">{{ $inboxStats['read'] }}</div>
                                    <div class="mailbox-stat-label">{{ __('Read') }}</div>
                                </div>
                            @endif
                        </div>

                        {{-- Toolbar --}}
                        <div class="mailbox-toolbar">
                            <div class="mailbox-search">
                                <i class="fas fa-search"></i>
                                <form method="GET" id="searchForm">
                                    @if(request('account'))<input type="hidden" name="account" value="{{ request('account') }}">@endif
                                    @if(request('status'))<input type="hidden" name="status" value="{{ request('status') }}">@endif
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="{{ __('Search emails...') }}"
                                        onchange="document.getElementById('searchForm').submit()">
                                </form>
                            </div>
                            <div class="mailbox-filter-btns">
                                @if($viewMode === 'sent')
                                    <a href="{{ route('admin.mailbox.index', array_merge(request()->except('status'), [])) }}"
                                       class="mailbox-filter-btn {{ !request('status') ? 'active' : '' }}">{{ __('All') }}</a>
                                    <a href="{{ route('admin.mailbox.index', array_merge(request()->query(), ['status' => 'sent'])) }}"
                                       class="mailbox-filter-btn {{ request('status') === 'sent' ? 'active' : '' }}">{{ __('Sent') }}</a>
                                    <a href="{{ route('admin.mailbox.index', array_merge(request()->query(), ['status' => 'failed'])) }}"
                                       class="mailbox-filter-btn {{ request('status') === 'failed' ? 'active' : '' }}">{{ __('Failed') }}</a>
                                @else
                                    <a href="{{ route('admin.mailbox.inbox', array_merge(request()->except('status'), [])) }}"
                                       class="mailbox-filter-btn {{ !request('status') ? 'active' : '' }}">{{ __('All') }}</a>
                                    <a href="{{ route('admin.mailbox.inbox', array_merge(request()->query(), ['status' => 'unread'])) }}"
                                       class="mailbox-filter-btn {{ request('status') === 'unread' ? 'active' : '' }}">{{ __('Unread') }}</a>
                                    <a href="{{ route('admin.mailbox.inbox', array_merge(request()->query(), ['status' => 'read'])) }}"
                                       class="mailbox-filter-btn {{ request('status') === 'read' ? 'active' : '' }}">{{ __('Read') }}</a>

                                    <form action="{{ route('admin.mailbox.fetch-inbox') }}" method="POST" class="d-inline">
                                        @csrf
                                        @if(request('account'))
                                            <input type="hidden" name="account_id" value="{{ request('account') }}">
                                        @endif
                                        <button type="submit" class="mailbox-filter-btn" style="border-color:#4338ca;color:#4338ca;"
                                            onclick="this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> {{ __('Fetching...') }}'">
                                            <i class="fas fa-sync-alt"></i> {{ __('Fetch Mail') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- Email List --}}
                        <div class="mailbox-list" id="mailList">
                            @if($viewMode === 'sent')
                                @forelse($logs as $log)
                                <div class="mailbox-item" id="mail-row-{{ $log->id }}" onclick="openMail({{ $log->id }}, 'sent')">
                                    <div class="mailbox-item-avatar {{ $colors[$loop->index % count($colors)] }}">
                                        {{ strtoupper(substr($log->to_email, 0, 1)) }}
                                    </div>
                                    <div class="mailbox-item-body">
                                        <div class="mailbox-item-row1">
                                            <span class="mailbox-item-to">{{ $log->to_email }}</span>
                                            <span class="mailbox-item-date">
                                                {{ $log->sent_at?->diffForHumans() ?? $log->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="mailbox-item-subject">{{ $log->subject }}</div>
                                        <div class="mailbox-item-preview">{{ Str::limit(strip_tags($log->body ?? ''), 70) }}</div>
                                    </div>
                                    <div class="mailbox-item-badge">
                                        @if($log->status === 'sent')
                                            <span class="badge bg-success text-white"><i class="fas fa-check"></i></span>
                                        @else
                                            <span class="badge bg-danger text-white"><i class="fas fa-times"></i></span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="mailbox-empty">
                                    <i class="fas fa-paper-plane"></i>
                                    <p>{{ __('No sent emails found.') }}</p>
                                </div>
                                @endforelse
                            @else
                                @forelse($receivedLogs as $log)
                                <div class="mailbox-item {{ !$log->is_read ? 'unread' : '' }}" id="mail-row-{{ $log->id }}" onclick="openMail({{ $log->id }}, 'inbox')">
                                    <div class="mailbox-item-avatar {{ $colors[$loop->index % count($colors)] }}">
                                        {{ strtoupper(substr($log->from_email ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="mailbox-item-body">
                                        <div class="mailbox-item-row1">
                                            <span class="mailbox-item-to">
                                                {{ $log->from_name ?: $log->from_email }}
                                                @if(!$log->is_read)
                                                    <span class="badge bg-warning text-dark ms-1" style="font-size:9px;">{{ __('New') }}</span>
                                                @endif
                                            </span>
                                            <span class="mailbox-item-date">
                                                {{ $log->received_at?->diffForHumans() ?? $log->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <div class="mailbox-item-subject">{{ $log->subject }}</div>
                                        <div class="mailbox-item-preview">{{ Str::limit(strip_tags($log->body_preview ?? ''), 70) }}</div>
                                    </div>
                                    <div class="mailbox-item-badge">
                                        @if($log->is_read)
                                            <span class="badge bg-secondary text-white"><i class="fas fa-envelope-open"></i></span>
                                        @else
                                            <span class="badge bg-warning text-dark"><i class="fas fa-envelope"></i></span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="mailbox-empty">
                                    <i class="fas fa-inbox"></i>
                                    <p>{{ __('No emails in inbox.') }}</p>
                                    <small>{{ __('Click "Fetch Mail" to sync from your IMAP server.') }}</small>
                                </div>
                                @endforelse
                            @endif
                        </div>

                        {{-- Pagination --}}
                        @php $paginatable = $viewMode === 'sent' ? $logs : ($receivedLogs ?? collect()); @endphp
                        @if($paginatable->hasPages())
                        <div class="p-3 border-top">
                            {{ $paginatable->links() }}
                        </div>
                        @endif

                    </div>

                    {{-- ===== DETAIL PANEL ===== --}}
                    <div class="mailbox-detail-panel" id="detailPanel">
                        <div class="mailbox-detail-header">
                            <span class="mailbox-detail-subject" id="detailSubject">{{ __('Select an email') }}</span>
                            <button class="close-detail-btn" onclick="closeDetail()" title="{{ __('Close') }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="mailbox-detail-meta" id="detailMeta"></div>
                        <div class="mailbox-detail-body" id="detailBody" style="display:flex;flex-direction:column;">
                            <div id="detailBodyText"><p class="text-muted">{{ __('Click an email to read it.') }}</p></div>
                            <iframe id="detailBodyFrame" sandbox="allow-popups allow-popups-to-escape-sandbox" style="display:none;width:100%;flex:1;min-height:350px;border:none;" scrolling="auto"></iframe>
                        </div>
                        <div class="p-3 border-top">
                            <form id="deleteMailForm" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="crancy-btn delete_danger_btn" style="font-size:12px;">
                                    <i class="fas fa-trash me-1"></i>{{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>{{-- end mailbox-wrap --}}

            </div>
        </div>
    </div>
</section>

{{-- ===== COMPOSE MODAL ===== --}}
<div class="modal fade" id="composeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;">
                <h5 class="modal-title"><i class="fas fa-pencil-alt me-2"></i>{{ __('New Message') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.mailbox.compose') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">

                        <div class="col-12">
                            <label class="crancy-option__label">{{ __('From (Account)') }} <span class="text-danger">*</span></label>
                            <select name="account_id" class="crancy-option__input" required>
                                <option value="">{{ __('Select account...') }}</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" {{ $account->is_default ? 'selected' : '' }}>
                                        {{ $account->name }} &lt;{{ $account->email }}&gt;
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-8">
                            <label class="crancy-option__label">{{ __('To') }} <span class="text-danger">*</span></label>
                            <input type="email" name="to" class="crancy-option__input" placeholder="recipient@email.com" required>
                        </div>

                        <div class="col-md-4">
                            <label class="crancy-option__label">{{ __('CC') }}</label>
                            <input type="email" name="cc" class="crancy-option__input" placeholder="cc@email.com">
                        </div>

                        <div class="col-12">
                            <label class="crancy-option__label">{{ __('Subject') }} <span class="text-danger">*</span></label>
                            <input type="text" name="subject" class="crancy-option__input" placeholder="{{ __('Email subject...') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="crancy-option__label">{{ __('Message') }} <span class="text-danger">*</span></label>
                            <textarea name="body" class="crancy-option__input" rows="10"
                                placeholder="{{ __('Write your message here...') }}" required
                                style="resize:vertical;font-family:inherit;"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="crancy-btn" style="background:#6c757d;" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="crancy-btn">
                        <i class="fas fa-paper-plane me-1"></i> {{ __('Send Email') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js_section')
<script>
"use strict";

var currentMailId   = null;
var currentViewMode = '{{ $viewMode }}';

function openMail(id, mode) {
    document.querySelectorAll('.mailbox-item').forEach(function(el) { el.classList.remove('active'); });
    var row = document.getElementById('mail-row-' + id);
    if (row) row.classList.add('active');
    currentMailId = id;

    var panel = document.getElementById('detailPanel');
    panel.classList.add('open');
    document.getElementById('detailSubject').textContent = '{{ __("Loading...") }}';
    document.getElementById('detailMeta').innerHTML   = '';
    document.getElementById('detailBody').innerHTML   = '<p class="text-muted">{{ __("Loading...") }}</p>';

    var url = mode === 'inbox'
        ? '{{ url("admin/mailbox/received") }}/' + id
        : '{{ url("admin/mailbox/sent") }}/' + id;

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        document.getElementById('detailSubject').textContent = data.subject || '(No Subject)';

        var meta = '';
        if (mode === 'inbox') {
            meta += '<div class="mb-1"><span>{{ __("From:") }}</span> ' + escHtml((data.from_name ? data.from_name + ' <' + data.from + '>' : data.from) || '—') + '</div>';
            meta += '<div class="mb-1"><span>{{ __("To:") }}</span> '   + escHtml(data.to || '—') + '</div>';
            meta += '<div class="mb-1"><span>{{ __("Date:") }}</span> ' + (data.received_at || '—') + '</div>';
            if (data.account) meta += '<div class="mb-1"><span>{{ __("Account:") }}</span> ' + escHtml(data.account) + '</div>';

            // Remove unread badge from the list row
            if (row) {
                row.classList.remove('unread');
                var badge = row.querySelector('.badge.bg-warning');
                if (badge) { badge.className = 'badge bg-secondary text-white'; badge.innerHTML = '<i class="fas fa-envelope-open"></i>'; }
                var newBadge = row.querySelector('.badge.bg-warning.text-dark.ms-1');
                if (newBadge) newBadge.remove();
            }
        } else {
            var statusBadge = data.status === 'sent'
                ? '<span class="badge bg-success text-white">{{ __("Sent") }}</span>'
                : '<span class="badge bg-danger text-white">{{ __("Failed") }}</span>';
            meta += '<div class="mb-1"><span>{{ __("From:") }}</span> '    + escHtml(data.from || '—') + '</div>';
            meta += '<div class="mb-1"><span>{{ __("To:") }}</span> '       + escHtml(data.to || '—') + '</div>';
            if (data.cc) meta += '<div class="mb-1"><span>{{ __("CC:") }}</span> ' + escHtml(data.cc) + '</div>';
            if (data.account) meta += '<div class="mb-1"><span>{{ __("Account:") }}</span> ' + escHtml(data.account) + '</div>';
            meta += '<div class="mb-1"><span>{{ __("Date:") }}</span> '    + (data.sent_at || '—') + '</div>';
            meta += '<div>' + statusBadge + '</div>';
        }
        document.getElementById('detailMeta').innerHTML = meta;

        var bodyText  = document.getElementById('detailBodyText');
        var bodyFrame = document.getElementById('detailBodyFrame');
        if (data.body) {
            bodyText.style.display  = 'none';
            bodyFrame.srcdoc        = data.body;
            bodyFrame.style.display = 'block';
        } else {
            bodyFrame.style.display = 'none';
            bodyText.innerHTML      = '<p class="text-muted">{{ __("(No body)") }}</p>';
            bodyText.style.display  = 'block';
        }

        var deleteBase = mode === 'inbox'
            ? '{{ url("admin/mailbox/received") }}'
            : '{{ url("admin/mailbox/sent") }}';
        document.getElementById('deleteMailForm').action = deleteBase + '/' + id;
    })
    .catch(function() {
        document.getElementById('detailBodyFrame').style.display = 'none';
        var bt = document.getElementById('detailBodyText');
        bt.innerHTML      = '<p class="text-danger">{{ __("Failed to load email.") }}</p>';
        bt.style.display  = 'block';
    });
}

function closeDetail() {
    document.getElementById('detailPanel').classList.remove('open');
    document.querySelectorAll('.mailbox-item').forEach(function(el) { el.classList.remove('active'); });
    currentMailId = null;
}

function escHtml(str) {
    if (!str) return '';
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
@endpush
