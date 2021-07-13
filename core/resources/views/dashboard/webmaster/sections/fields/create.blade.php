@if (Session::get('fieldST') == "create")

    <div>
        {{Form::open(['route'=>['webmasterFieldsStore',$WebmasterSections->id],'method'=>'POST'])}}

        @foreach(Helper::languagesList() as $ActiveLanguage)
            @if($ActiveLanguage->box_status)
                <div class="form-group row">
                    <label
                        class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('title_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                    </div>
                </div>
            @endif
        @endforeach

        <div class="form-group row">
            <label for="type0"
                   class="col-sm-2 form-control-label">{!!  __('backend.customFieldsType') !!}</label>
            <div class="col-sm-3">
                <div class="radio">
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','0',true, array('id' => 'type0','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType0') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','1',false, array('id' => 'type1','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType1') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','2',false, array('id' => 'type2','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType2') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','3',false, array('id' => 'type3','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType3') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','4',false, array('id' => 'type4','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType4') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','5',false, array('id' => 'type5','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType5') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','6',false, array('id' => 'type6','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType6') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','7',false, array('id' => 'type7','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType7') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','8',false, array('id' => 'type8','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType8') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','9',false, array('id' => 'type9','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType9') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','10',false, array('id' => 'type10','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType10') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','11',false, array('id' => 'type11','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType11') }}
                        </label>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('type','12',false, array('id' => 'type12','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.customFieldsType12') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div id="options" style="display: none">
                    <div class="row">
                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="col-sm-1 col-xs-1 text-center"
                                     style="padding: 0;">
                                    <br>
                                    <?php
                                    $i2 = 0;
                                    ?>
                                    @for($i=1;$i<=12;$i++)
                                        <?php
                                        $i2++;
                                        $bg_volor = "#f0f0f0";
                                        if ($i2 == 2) {
                                            $i2 = 0;
                                            $bg_volor = "#f9f9f9";
                                        }
                                        ?>
                                        <div
                                            style="font-size: 1rem;line-height: 1.37;background: {{$bg_volor}}">
                                            <small>
                                                <small>{{$i}}</small>
                                            </small>
                                        </div>
                                    @endfor
                                </div>

                                <div class="col-sm-3 col-xs-5">
                                    <div>
                                        {!!  __('backend.customFieldsOptions') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                        :
                                    </div>
                                    {!! Form::textarea('details_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction,'rows'=>'12','style'=>'white-space: nowrap;')) !!}
                                </div>

                            @endif
                        @endforeach
                    </div>
                    <small>
                        <i class="material-icons">&#xe8fd;</i> {!!  __('backend.customFieldsOptionsHelp') !!}
                    </small>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="required1"
                   class="col-sm-2 form-control-label">{!!  __('backend.customFieldsRequired') !!}</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('required','0',true, array('id' => 'required2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.customFieldsOptional') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('required','1',false, array('id' => 'required1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.customFieldsRequired') }} (*)
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="in_table1"
                   class="col-sm-2 form-control-label">{!!  __('backend.showFieldInTable') !!}</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_table','1',true, array('id' => 'in_table1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.yes') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_table','0',false, array('id' => 'in_table2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.no') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="in_search1"
                   class="col-sm-2 form-control-label">{!!  __('backend.showFieldInSearch') !!}</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_search','1',true, array('id' => 'in_search1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.yes') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_search','0',false, array('id' => 'in_search2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.no') }}
                    </label>
                </div>
            </div>
        </div>
        @if($WebmasterSections->type != 4)
            <div class="form-group row">
                <label for="in_listing1"
                       class="col-sm-2 form-control-label">{!!  __('backend.showFieldInListing') !!}</label>
                <div class="col-sm-10">
                    <div class="radio">
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('in_listing','1',true, array('id' => 'in_listing1','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.yes') }}
                        </label>
                        &nbsp; &nbsp;
                        <label class="ui-check ui-check-md">
                            {!! Form::radio('in_listing','0',false, array('id' => 'in_listing2','class'=>'has-value')) !!}
                            <i class="dark-white"></i>
                            {{ __('backend.no') }}
                        </label>
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label for="in_page1"
                   class="col-sm-2 form-control-label">{!!  __('backend.showFieldInPage') !!}</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_page','1',true, array('id' => 'in_page1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.yes') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_page','0',false, array('id' => 'in_page2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.no') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row in_statics_div displayNone">
            <label for="in_statics1"
                   class="col-sm-2 form-control-label">{!!  __('backend.showStatics') !!}</label>
            <div class="col-sm-10">
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_statics','1',false, array('id' => 'in_statics2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.yes') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('in_statics','0',true, array('id' => 'in_statics1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.no') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row" id="default_val">
            <label for="default_value"
                   class="col-sm-2 form-control-label">{!!  __('backend.customFieldsDefault') !!}
            </label>
            <div class="col-sm-10">
                {!! Form::text('default_value','', array('placeholder' => '','class' => 'form-control','id'=>'default_value')) !!}
            </div>
        </div>

        <div class="form-group row">
            <label for="lang_code"
                   class="col-sm-2 form-control-label">{!!  __('backend.language') !!}
            </label>
            <div class="col-sm-10">
                <select name="lang_code" id="lang_code" class="form-control c-select">
                    <option value="all">{{ __('backend.customFieldsForAllLang') }}</option>
                    @foreach(Helper::languagesList() as $ActiveLanguage)
                        @if($ActiveLanguage->box_status)
                            <option
                                value="{{ $ActiveLanguage->code }}">{{ $ActiveLanguage->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="css_class"
                   class="col-sm-2 form-control-label"> CSS Class </label>
            <div class="col-sm-10">
                <div class="input-group">
                    {!! Form::text('css_class','', array('placeholder' => '','class' => 'form-control','id'=>'css_class')) !!}
                    <span class="input-group-btn">
            <button class="btn white" type="button" data-toggle="modal" data-target="#predefined_css_classes"
                    ui-toggle-class="bounce" ui-target="#animate">{!!  __('backend.predefinedCssClasses') !!}</button>
          </span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="css_class"
                   class="col-sm-2 form-control-label"> {!!  __('backend.viewPermission') !!}</label>
            <div class="col-sm-10">

                <select name="view_permission_groups[]"
                        class="form-control select2-multiple" multiple
                        ui-jp="select2"
                        ui-options="{theme: 'bootstrap'}">
                    <option value="0" selected="selected">{!!  __('backend.all') !!}</option>
                    @foreach($PermissionsList as $PermissionItem)
                        <option value="{{ $PermissionItem->id }}">{!!  $PermissionItem->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="css_class"
                   class="col-sm-2 form-control-label"> {!!  __('backend.addPermission') !!}</label>
            <div class="col-sm-10">

                <select name="add_permission_groups[]"
                        class="form-control select2-multiple" multiple
                        ui-jp="select2"
                        ui-options="{theme: 'bootstrap'}">
                    <option value="0" selected="selected">{!!  __('backend.all') !!}</option>
                    @foreach($PermissionsList as $PermissionItem)
                        <option value="{{ $PermissionItem->id }}">{!!  $PermissionItem->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="css_class"
                   class="col-sm-2 form-control-label"> {!!  __('backend.editPermission') !!}</label>
            <div class="col-sm-10">

                <select name="edit_permission_groups[]"
                        class="form-control select2-multiple" multiple
                        ui-jp="select2"
                        ui-options="{theme: 'bootstrap'}">
                    <option value="0" selected="selected">{!!  __('backend.all') !!}</option>
                    @foreach($PermissionsList as $PermissionItem)
                        <option value="{{ $PermissionItem->id }}">{!!  $PermissionItem->name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row m-t-md">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary m-t"><i
                        class="material-icons">
                        &#xe31b;</i> {!! __('backend.add') !!}</button>
                <a href="{{ route('webmasterFields',[$WebmasterSections->id]) }}"
                   class="btn btn-default m-t"><i class="material-icons">
                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
            </div>
        </div>

        {{Form::close()}}
    </div>

    @include('dashboard.webmaster.sections.fields.css_classes')
@endif
