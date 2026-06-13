  @if ($general_setting->preloader_status == 'enable')
    <div id="preloader">
      <div id="container-preloader" class="container-preloader">
        <div class="animation-preloader">
          <div class="spinner"></div>
          <div class="txt-loading">
            <span preloader-text="C" class="characters">{{ __("C") }}</span>

            <span preloader-text="R" class="characters">{{ __('R') }}</span>

            <span preloader-text="E" class="characters">{{ __('E') }}</span>

            <span preloader-text="A" class="characters">{{ __('A') }}</span>

            <span preloader-text="T" class="characters">{{ __('T') }}</span>

            <span preloader-text="V" class="characters">{{ __('V') }}</span>

            <span preloader-text="L" class="characters">{{ __('L') }}</span>

            <span preloader-text="A" class="characters">{{ __('A') }}</span>

            <span preloader-text="B" class="characters">{{ __('B') }}</span>
          </div>
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
      </div>
    </div>
    @endif
