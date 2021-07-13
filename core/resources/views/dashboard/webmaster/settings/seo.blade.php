
<div class="tab-pane {{  ( Session::get('active_tab') == 'SEOSettingTab') ? 'active' : '' }}"
     id="tab-3">
    <div class="p-a-md"><h5>{!!  __('backend.seoTabTitle') !!}</h5></div>

    <div class="p-a-md col-md-12">

        <div class="form-group">
            <label>{{ __('backend.seoTab') }} : </label>
            <div class="radio">
                <div>
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('seo_status','1',$WebmasterSetting->seo_status ? true : false , array('id' => 'seo_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.active') }}
                    </label>
                </div>
                <div style="margin-top: 5px;">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('seo_status','0',$WebmasterSetting->seo_status ? false : true , array('id' => 'seo_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.notActive') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('backend.friendlyURLinks') }} : </label>
            <div class="radio">
                <div>
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('links_status','0',$WebmasterSetting->links_status ? false : true , array('id' => 'links_status1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.friendlyURLinks1') }}
                    </label>
                </div>
                <div style="margin-top: 5px;">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('links_status','1',$WebmasterSetting->links_status ? true : false , array('id' => 'links_status2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.friendlyURLinks2') }}
                    </label>
                </div>
            </div>
        </div>
        <br>
        <div class="p-a b-a white dk">
            <h6>{{ __('backend.seoFixUrls') }}</h6>
            <div class="text-muted">{!! __('backend.seoFixUrlsService') !!}</div>
            <a href="{{ route("webmasterSEORepair") }}"
               onclick="return confirm('{{ __("backend.seoFixUrlsConfirm") }}')"
               class="btn white btn-sm m-t-xs">{{ __('backend.seoFixUrlsStart') }}</a>
        </div>
    </div>
</div>
