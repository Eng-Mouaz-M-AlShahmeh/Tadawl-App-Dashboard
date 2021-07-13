<div class="tab-pane {{  ( Session::get('active_tab') == 'analyticsTab') ? 'active' : '' }}"
     id="tab-11">
    <div class="p-a-md"><h5>{!!  __('backend.analyticsSettings') !!}</h5></div>

    <div class="p-a-md col-md-12">

        <div class="form-group">
            <label>{{ __('backend.analyticsService') }} : </label>
            <div class="radio">
                <div>
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('geoip_status','0',(env("GEOIP_STATUS") ==0) , array('id' => 'sms_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.notActive') }}
                    </label>
                </div>
                <div style="margin-top: 5px;">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('geoip_status','1',(env("GEOIP_STATUS") ==1), array('id' => 'sms_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.active') }}
                    </label>
                </div>
            </div>
        </div>
        <div id="geoip_service_info" class="{{ (env("GEOIP_STATUS") ==1)?"":"displayNone" }}">
            <div class="form-group">
                <label>{!!  __('backend.analyticsService') !!}</label>
                <select name="geoip_service" class="form-control c-select">
                    <option value="ipapi" {{ (env("GEOIP_SERVICE")== "ipapi") ? "selected='selected'":""  }}>
                        {!!  __('backend.usingService') !!} : ip-api.com ( Default )
                    </option>
                    <option
                        value="ipgeolocation" {{ (env("GEOIP_SERVICE")== "ipgeolocation") ? "selected='selected'":""  }}>
                        {!!  __('backend.usingService') !!} : ipgeolocation.io
                    </option>
                    <option value="ipfinder" {{ (env("GEOIP_SERVICE")== "ipfinder") ? "selected='selected'":""  }}>
                        {!!  __('backend.usingService') !!} : ipfinder.io
                    </option>
                    <option value="ipdata" {{ (env("GEOIP_SERVICE")== "ipdata") ? "selected='selected'":""  }}>
                        {!!  __('backend.usingService') !!} : ipdata.co
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>{!!  __('backend.analyticsApiKey') !!}</label>
                {!! Form::text('geoip_service_key',env("GEOIP_SERVICE_KEY"), array('placeholder' => '','class' => 'form-control', 'dir'=>trans('backLang.ltr'))) !!}
            </div>
            <div class="form-group">
                <label>{!!  __('backend.analyticsApiMsg') !!} :</label>
                <div>
                    <a href="https://ip-api.com/" class="btn btn-xs info" target="_blank"><i class="fa fa-globe"></i>
                        ip-api.com</a>
                    <a href="https://ipgeolocation.io/" class="btn btn-xs info" target="_blank"><i
                            class="fa fa-globe"></i>
                        ipgeolocation.io</a>
                    <a href="http://ipfinder.io/" class="btn btn-xs info" target="_blank"><i class="fa fa-globe"></i>
                        ipfinder.io</a>
                    <a href="https://ipdata.co/" class="btn btn-xs info" target="_blank"><i class="fa fa-globe"></i>
                        ipdata.co</a>
                </div>
            </div>
        </div>
    </div>
</div>
