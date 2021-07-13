<div id="switcher">
    <div class="switcher box-color dark-white text-color" id="sw-theme">
        <a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
            <i class="fa fa-gear"></i>
        </a>
        <div class="box-header">
            <h2>{{ __('backend.themeSwitcher') }}</h2>
        </div>
        <div class="box-divider"></div>
        <div class="box-body p-t-xs">
            <p class="hidden-md-down">
                <label class="md-check m-y-xs" data-target="folded">
                    <input type="checkbox">
                    <i class="green"></i>
                    <span class="hidden-folded">{{ __('backend.foldedAside') }}</span>
                </label>
                <label class="md-check m-y-xs" data-target="boxed">
                    <input type="checkbox">
                    <i class="green"></i>
                    <span class="hidden-folded">{{ __('backend.boxedLayout') }}</span>
                </label>
            </p>


            <p class="m-b-xs">{{ __('backend.themes') }}:</p>
            <div data-target="bg" class="text-u-c text-center _600 clearfix">
                <label class="p-a col-xs-6 light pointer m-a-0">
                    <input type="radio" name="theme" value="" hidden>
                    {{ __('backend.themes1') }}
                </label>
                <label class="p-a col-xs-6 grey pointer m-a-0">
                    <input type="radio" name="theme" value="grey" hidden>
                    {{ __('backend.themes2') }}
                </label>
                <label class="p-a col-xs-6 dark pointer m-a-0">
                    <input type="radio" name="theme" value="dark" hidden>
                    {{ __('backend.themes3') }}
                </label>
                <label class="p-a col-xs-6 black pointer m-a-0">
                    <input type="radio" name="theme" value="black" hidden>
                    {{ __('backend.themes4') }}
                </label>
            </div>
            <br>

            @if(count(Helper::languagesList()) >0)
                <p class="m-b-xs">{{ __('backend.languages') }}:</p>
                @foreach(Helper::languagesList() as $ActiveLanguage)
                    <div>
                        <a href="{{ route("localeChange",$ActiveLanguage->code) }}"
                           class="btn btn-xs light btn-block m-b-xs text-left p-x-1">
                            @if($ActiveLanguage->icon !="")
                                <img
                                    src="{{ asset('assets/dashboard/images/flags/'.$ActiveLanguage->icon.".svg") }}"
                                    alt="" class="w-20">
                            @endif
                            {{ $ActiveLanguage->title }}
                        </a>
                    </div>
                @endforeach
            @endif
            <div class="m-t-1">
                <a href="{{ route('cacheClear') }}" class="btn btn-sm dark btn-block"
                   onclick="return confirm('{{ __('backend.cashClearMsg') }}')"><small>{!!  __('backend.cashClear') !!}</small></a>

            </div>
        </div>
    </div>

</div>
