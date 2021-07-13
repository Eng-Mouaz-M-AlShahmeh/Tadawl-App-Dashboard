<?php
$Adviser = Auth::user();
$title_var = "title_" . __('backend.boxCode');
$title_var2 = "title_" . __('backend.boxCodeOther');
?>


@foreach(Helper::languagesList() as $ActiveLanguage)
    @if($ActiveLanguage->box_status)
        <div class="form-group row">
            <label
                class="col-sm-3 form-control-label">{!!  __('backend.topicName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
            </label>
            <div class="col-sm-9">
                {!! Form::text('btn_title_'.@$ActiveLanguage->code,@$home_page_button['btn_title_'.@$ActiveLanguage->code], array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
            </div>
        </div>
    @endif
@endforeach
<div class="form-group row">
    <label class="col-sm-3 form-control-label">{!!  __('backend.link') !!}
    </label>
    <div class="col-sm-9">
        {!! Form::text('link',@$home_page_button['btn_link'], array('dir' => 'ltr','class' => 'form-control','required'=>'')) !!}
    </div>
</div>

<div class="form-group row">
    <label for="edit_target0"
           class="col-sm-3 form-control-label">{!!  __('backend.linkTarget') !!}</label>
    <div class="col-sm-9">
        <div class="radio m-t-sm">
            <label class="ui-check ui-check-md">
                {!! Form::radio('target','0',(@$home_page_button['btn_target'])?false:true, array('id' => 'edit_target0','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {!!  __('backend.linkTargetParent') !!}
            </label>
            &nbsp;
            <label class="ui-check ui-check-md">
                {!! Form::radio('target','1',(@$home_page_button['btn_target'])?true:false, array('id' => 'edit_target1','class'=>'has-value')) !!}
                <i class="dark-white"></i>
                {!!  __('backend.linkTargetBlank') !!}
            </label>

        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 form-control-label"> CSS Class
    </label>
    <div class="col-sm-9">
        {!! Form::text('btn_class',@$home_page_button['btn_class'], array('dir' => 'ltr','class' => 'form-control','required'=>'')) !!}
    </div>
</div>
<input type="hidden" name="id" value="{{ @$home_page_button['btn_id'] }}">
<input type="hidden" name="p_id" value="{{ $Permissions->id }}">
