<div id="add_language" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="material-icons">&#xe145;</i> {{ __('backend.addNewLanguage') }}
                </h5>
            </div>
            {{Form::open(['route'=>['webmasterLanguageStore'],'method'=>'POST'])}}
            <div class="modal-body p-lg">
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-3 form-control-label">{{ __('backend.languageCode') }}</label>
                    <div class="col-sm-9">
                        {!! Form::text('code','', array('placeholder' => 'en','class' => 'form-control', 'required'=>'', 'minlength'=>'2', 'maxlength'=>'2', 'onkeyup'=>"this.value=this.value.replace(/[^a-z]/g,'');", 'style'=>'text-transform: lowercase')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-3 form-control-label">{{ __('backend.languageTitle') }}</label>
                    <div class="col-sm-9">
                        {!! Form::text('title','', array('placeholder' => 'English','class' => 'form-control', 'required'=>'')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-3 form-control-label">{{ __('backend.languageDirection') }}</label>
                    <div class="col-sm-9">
                        <select class="form-control c-select" name="direction" required>
                            <option value="ltr">Left To Right</option>
                            <option value="rtl">Right To Left</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-3 form-control-label">{{ __('backend.languageInputFields') }}</label>
                    <div class="col-sm-9">
                        <select class="form-control c-select" name="fields" required>
                            <option value="1">{{ __('backend.active') }}</option>
                            <option value="0">{{ __('backend.notActive') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-3 form-control-label">{{ __('backend.languageIcon') }}</label>
                    <div class="col-sm-9">
                        <select name="icon"
                                class="form-control select2 select2-hidden-accessible select2-allow-clear"
                                ui-jp="select2" ui-options="{theme: 'bootstrap'}">
                            <option value="">- - {!!  __('backend.none') !!} - -
                            </option>
                            <?php
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            ?>
                            @foreach ($Countries as $country)
                                <?php
                                if ($country->$title_var != "") {
                                    $title = $country->$title_var;
                                } else {
                                    $title = $country->$title_var2;
                                }
                                ?>
                                <option value="{{ $country->code  }}"
                                        data-data='{"image": "{{ asset('assets/dashboard/images/flags/'.mb_strtolower($country->code).'.svg') }}","code":"+{{ $country->tel }}","search-text":"{{ $country->{"title_" . __('backend.boxCode')} }}  +{{ $country->tel }}"}'>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md"
                        data-dismiss="modal">{!! __('backend.cancel') !!}</button>
                <button type="submit" class="btn primary p-x-md"><i
                        class="material-icons">
                        &#xe31b;</i> {!! __('backend.add') !!}</button>
            </div>
            {{Form::close()}}
        </div><!-- /.modal-content -->
    </div>
</div>

@foreach($Languages as $Language)
    @if(@Auth::user()->permissionsGroup->edit_status)
        <div id="edit_language_{{ $Language->id }}" class="modal fade" data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="material-icons">&#xe3c9;</i> {{ __('backend.updateLanguage') }}
                        </h5>
                    </div>
                    {{Form::open(['route'=>['webmasterLanguageUpdate'],'method'=>'POST'])}}
                    <div class="modal-body p-lg">
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.languageCode') }}</label>
                            <div class="col-sm-9">
                                {!! Form::text('code',$Language->code, array('placeholder' => 'en','class' => 'form-control', 'readonly'=>'', 'minlength'=>'2', 'maxlength'=>'2', 'onkeyup'=>"this.value=this.value.replace(/[^a-z]/g,'');", 'style'=>'text-transform: lowercase')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.languageTitle') }}</label>
                            <div class="col-sm-9">
                                {!! Form::text('title',$Language->title, array('placeholder' => 'English','class' => 'form-control', 'required'=>'')) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.languageDirection') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control c-select" name="direction" required>
                                    <option
                                        value="ltr" {{ ($Language->direction=="ltr")?"selected='selected'":"" }}>
                                        Left To Right
                                    </option>
                                    <option
                                        value="rtl" {{ ($Language->direction=="rtl")?"selected='selected'":"" }}>
                                        Right To Left
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.languageInputFields') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control c-select" name="fields" required>
                                    <option
                                        value="1" {{ ($Language->box_status=="1")?"selected='selected'":"" }}>{{ __('backend.active') }}</option>
                                    <option
                                        value="0" {{ ($Language->box_status=="0")?"selected='selected'":"" }}>{{ __('backend.notActive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.languageIcon') }}</label>
                            <div class="col-sm-9">
                                <select name="icon"
                                        class="form-control select2 select2-hidden-accessible select2-allow-clear"
                                        ui-jp="select2" ui-options="{theme: 'bootstrap'}">
                                    <option value="">- - {!!  __('backend.none') !!} - -
                                    </option>
                                    <?php
                                    $title_var = "title_" . @Helper::currentLanguage()->code;
                                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                    ?>
                                    @foreach ($Countries as $country)
                                        <?php
                                        if ($country->$title_var != "") {
                                            $title = $country->$title_var;
                                        } else {
                                            $title = $country->$title_var2;
                                        }
                                        ?>
                                        <option
                                            value="{{ $country->code  }}" {{ ($Language->icon==trim(strtolower($country->code)))?"selected='selected'":"" }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 form-control-label">{{ __('backend.status') }}</label>
                            <div class="col-sm-9">
                                <select class="form-control c-select" name="status" required>
                                    <option
                                        value="1" {{ ($Language->status=="1")?"selected='selected'":"" }}>{{ __('backend.active') }}</option>
                                    <option
                                        value="0" {{ ($Language->status=="0")?"selected='selected'":"" }}>{{ __('backend.notActive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="{{ $Language->id }}">
                        <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal">{!! __('backend.cancel') !!}</button>
                        <button type="submit" class="btn primary p-x-md"><i
                                class="material-icons">
                                &#xe31b;</i> {!! __('backend.save') !!}</button>
                    </div>
                    {{Form::close()}}
                </div><!-- /.modal-content -->
            </div>
        </div>
    @endif
    @if(@Auth::user()->permissionsGroup->delete_status)
        <div id="delete_language_{{ $Language->id }}" class="modal fade" data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            {{ __('backend.confirmationDeleteMsg') }}
                            <br>
                            <strong>[ {{ $Language->title }} ]</strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ __('backend.no') }}</button>
                        <a href="{{ route("webmasterLanguageDestroy",["id"=>$Language->id]) }}"
                           class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
    @endif
@endforeach
