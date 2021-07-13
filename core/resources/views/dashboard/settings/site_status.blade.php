
<div class="tab-pane {{  ( Session::get('active_tab') == 'statusTab') ? 'active' : '' }}"
     id="tab-4">
    <div class="p-a-md"><h5><i class="material-icons">&#xe8c6;</i>
            &nbsp; {!!  __('backend.siteStatusSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">
        <div class="form-group">
            <label>{{ __('backend.siteStatusSettings') }} : </label>
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('site_status','1',$Setting->site_status ? true : false , array('id' => 'site_status1','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.active') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('site_status','0',$Setting->site_status ? false : true , array('id' => 'site_status2','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.notActive') }}
                </label>
            </div>
        </div>

        <div class="form-group"
             id="close_msg_div" {!!   ($Setting->site_status) ? "style='display:none'":"" !!}>
            <label>{!!  __('backend.siteStatusSettingsMsg') !!} </label>
            {!! Form::textarea('close_msg',$Setting->close_msg, array('placeholder' => __('backend.siteStatusSettingsMsg'),'class' => 'form-control','rows'=>'4')) !!}
        </div>
    </div>
</div>
