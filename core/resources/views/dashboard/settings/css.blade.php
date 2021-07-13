
<div class="tab-pane {{  ( Session::get('active_tab') == 'cssTab') ? 'active' : '' }}"
     id="tab-7">
    <div class="p-a-md"><h5><i class="material-icons">&#xe86f;</i>
            &nbsp; {!!  __('backend.customCSS') !!}</h5></div>
    <div class="p-a-md col-md-12">
        <div class="form-group">
            {!! Form::textarea('css_code',$Setting->css, array('placeholder' => "",'class' => 'form-control','rows'=>'17')) !!}
        </div>
    </div>
</div>
