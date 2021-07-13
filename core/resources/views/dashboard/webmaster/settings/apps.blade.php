<div class="tab-pane {{  ( Session::get('active_tab') == 'appsSettingsTab') ? 'active' : '' }}"
     id="tab-1">
    <div class="p-a-md"><h5>{!!  __('backend.appsSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">

        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('analytics_status','1',$WebmasterSetting->analytics_status, array('id' => 'analytics_status')) !!}
                <i class="dark-white"></i><label
                    for="analytics_status">{{ __('backend.visitorsAnalytics') }}</label>
            </label>
        </div>

        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('inbox_status','1',$WebmasterSetting->inbox_status, array('id' => 'inbox_status')) !!}
                <i class="dark-white"></i><label
                    for="inbox_status">{{ __('backend.siteInbox') }}</label>
            </label>
        </div>

        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('calendar_status','1',$WebmasterSetting->calendar_status, array('id' => 'calendar_status')) !!}
                <i class="dark-white"></i><label
                    for="calendar_status">{{ __('backend.calendar') }}</label>
            </label>
        </div>

        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('banners_status','1',$WebmasterSetting->banners_status, array('id' => 'banners_status')) !!}
                <i class="dark-white"></i><label
                    for="banners_status">{{ __('backend.adsBanners') }}</label>
            </label>
        </div>


        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('newsletter_status','1',$WebmasterSetting->newsletter_status, array('id' => 'newsletter_status')) !!}
                <i class="dark-white"></i><label
                    for="newsletter_status">{{ __('backend.newsletter') }}</label>
            </label>
        </div>

        <div class="checkbox">
            <label class="ui-check">
                {!! Form::checkbox('settings_status','1',$WebmasterSetting->settings_status, array('id' => 'settings_status')) !!}
                <i class="dark-white"></i><label
                    for="settings_status">{{ __('backend.generalSettings') }}</label>
            </label>
        </div>
    </div>
</div>
