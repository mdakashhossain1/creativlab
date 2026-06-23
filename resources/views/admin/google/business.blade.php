@extends('admin.master_layout')
@section('title')
    <title>{{ __('Google Business Profile') }}</title>
@endsection
@section('body-header')
    <h3 class="crancy-header__title m-0">{{ __('Google Business Profile') }}</h3>
    <p class="crancy-header__text">{{ __('Dashboard') }} >> {{ __('Google Business') }}</p>
@endsection

@section('body-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">

            {{-- Connection Card --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                        <div style="display:flex; align-items:center; gap:14px;">
                            <div style="width:46px; height:46px; border-radius:50%; background:{{ $token ? '#22c55e' : '#ef4444' }};
                                        display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                    @if($token)
                                        <path d="M5 12l5 5L20 7" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    @else
                                        <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="2"/>
                                        <path d="M12 8v5" stroke="#fff" stroke-width="2.5" stroke-linecap="round"/>
                                        <circle cx="12" cy="16.5" r="1" fill="#fff"/>
                                    @endif
                                </svg>
                            </div>
                            <div>
                                <h4 class="crancy-product-card__title" style="margin:0 0 2px;">{{ __('Google Business Profile') }}</h4>
                                @if($token)
                                    <p style="margin:0; font-size:13px; color:#5d6a83;">
                                        {{ __('Connected as') }} <strong>{{ $token->google_name }}</strong>
                                        ({{ $token->google_email }})
                                        &middot; {{ __('Since') }} {{ $token->created_at->format('d M Y') }}
                                    </p>
                                @else
                                    <p style="margin:0; font-size:13px; color:#5d6a83;">{{ __('Not connected. Click to login with Google.') }}</p>
                                @endif
                            </div>
                        </div>
                        <div style="display:flex; gap:10px;">
                            @if($token)
                                <a href="{{ route('admin.google.connect') }}" class="crancy-btn" style="width:auto !important;">
                                    <i class="fas fa-sync-alt"></i> {{ __('Reconnect') }}
                                </a>
                                <form action="{{ route('admin.google.disconnect') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="crancy-btn" style="width:auto !important; background:#ef4444; border-color:#ef4444;"
                                        onclick="return confirm('Disconnect Google account?')">
                                        <i class="fas fa-unlink"></i> {{ __('Disconnect') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('admin.google.connect') }}"
                                   style="width:auto !important; display:inline-flex; align-items:center; gap:10px;
                                          background:#fff; border:1.5px solid #dadce0; border-radius:6px;
                                          padding:10px 20px; font-size:14px; font-weight:600; color:#3c4043;
                                          text-decoration:none; box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                    <svg width="18" height="18" viewBox="0 0 24 24">
                                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                    </svg>
                                    {{ __('Sign in with Google') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($token)

            {{-- Accounts --}}
            @if(!empty($accounts))
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Business Accounts') }}</h4>
                    <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <table class="crancy-table__main crancy-table__main-v3 dataTable no-footer w-100">
                            <thead class="crancy-table__head">
                                <tr>
                                    <th class="crancy-table__h2">{{ __('Account Name') }}</th>
                                    <th class="crancy-table__h2">{{ __('Type') }}</th>
                                    <th class="crancy-table__h2">{{ __('ID') }}</th>
                                </tr>
                            </thead>
                            <tbody class="crancy-table__body">
                                @foreach($accounts as $account)
                                <tr>
                                    <td class="crancy-table__data-2"><strong>{{ $account['accountName'] ?? '—' }}</strong></td>
                                    <td class="crancy-table__data-2">
                                        <span class="crancy-badge crancy-badge__active">{{ $account['type'] ?? 'PERSONAL' }}</span>
                                    </td>
                                    <td class="crancy-table__data-2"><small class="text-muted">{{ $account['name'] ?? '—' }}</small></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            {{-- Reviews --}}
            <div class="col-12 mg-top-30">
                <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">{{ __('Reviews') }}
                        @if(!empty($reviews))
                            <span class="crancy-badge crancy-badge__active" style="margin-left:8px;">{{ count($reviews) }}</span>
                        @endif
                    </h4>

                    @if(empty($reviews))
                        <p class="text-muted text-center py-4">{{ __('No reviews found, or the location could not be detected automatically. Make sure your Google account has access to a Business Profile location.') }}</p>
                    @else
                        <div style="display:flex; flex-direction:column; gap:16px; margin-top:10px;">
                            @foreach($reviews as $review)
                            @php
                                $stars = match($review['starRating'] ?? '') {
                                    'FIVE'  => 5, 'FOUR' => 4, 'THREE' => 3, 'TWO' => 2, default => 1
                                };
                                $reviewer = $review['reviewer']['displayName'] ?? 'Anonymous';
                                $avatar   = $review['reviewer']['profilePhotoUrl'] ?? null;
                                $comment  = $review['comment'] ?? '';
                                $time     = $review['createTime'] ?? null;
                                $reply    = $review['reviewReply']['comment'] ?? null;
                            @endphp
                            <div style="border:1px solid #e8eaf0; border-radius:10px; padding:16px 20px;">
                                <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px;">
                                    @if($avatar)
                                        <img src="{{ $avatar }}" alt="{{ $reviewer }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                    @else
                                        <div style="width:40px;height:40px;border-radius:50%;background:#794AFF22;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;color:#794AFF;">
                                            {{ strtoupper(substr($reviewer,0,1)) }}
                                        </div>
                                    @endif
                                    <div style="flex:1;">
                                        <strong style="font-size:14px;">{{ $reviewer }}</strong>
                                        <div style="display:flex; align-items:center; gap:6px; margin-top:2px;">
                                            <span style="color:#f59e0b; font-size:13px;">
                                                @for($i=1;$i<=5;$i++)
                                                    {{ $i <= $stars ? '★' : '☆' }}
                                                @endfor
                                            </span>
                                            @if($time)
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($time)->diffForHumans() }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($comment)
                                    <p style="margin:0 0 10px; font-size:14px; color:#3c4043;">{{ $comment }}</p>
                                @endif

                                @if($reply)
                                    <div style="background:#f4f6ff; border-left:3px solid #794AFF; border-radius:6px; padding:10px 14px; margin-top:8px;">
                                        <small style="font-weight:600; color:#794AFF;"><i class="fas fa-reply"></i> {{ __('Your reply') }}</small>
                                        <p style="margin:4px 0 0; font-size:13px;">{{ $reply }}</p>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @endif

        </div>
    </div>
</section>
@endsection
