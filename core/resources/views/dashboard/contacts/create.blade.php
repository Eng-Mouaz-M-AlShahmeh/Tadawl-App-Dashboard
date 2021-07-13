
<!-- column -->
<div class="col-sm-6 col-md-7">
    <div class="row-col">
        <div class="p-a-sm">
            <h6 class="m-b-0 m-t-sm"><i class="material-icons">
                    &#xe02e;</i> {{ __('backend.newContacts') }}
            </h6>
        </div>
        <div class="row-row">
            <div class="row-body">
                <div class="row-inner">
                    <div class="padding p-y-sm ">
                        {{Form::open(['route'=>['contactsStore'],'method'=>'POST', 'files' => true ])}}
                        <div class="row-col h-auto m-b-1">
                            <div class="col-sm-3">
                                <div class="avatar w-64 inline">
                                    <img id="photo_preview"
                                         src="{{ asset('uploads/contacts/profile.jpg') }}"
                                         style="opacity: 0.2">
                                </div>
                                <div class="form-file inline">
                                    <input id="photo_file" type="file" name="file" accept="image/*">
                                    <button class="btn white btn-sm">
                                        <small>
                                            <small>{{ __('backend.selectFile') }} ..</small>
                                        </small>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-9 v-m h2 _300">
                                <div class="p-l-xs">
                                    {!! Form::text('first_name','', array('placeholder' =>__('backend.firstName'),'class' => 'form-control w-sm inline','id'=>'first_name','required'=>'')) !!}
                                    {!! Form::text('last_name','', array('placeholder' =>__('backend.lastName'),'class' => 'form-control w-sm inline','id'=>'last_name','required'=>'')) !!}

                                    @if(count($ContactsGroups) >0)
                                        <select name="group_id"
                                                class="form-control c-select w-sm inline"
                                                style="vertical-align: bottom;">
                                            <option value="">- - {!!  __('backend.group') !!} - -
                                            </option>
                                            @foreach ($ContactsGroups as $Group)
                                                <option value="{{ $Group->id  }}" {{ ($Group->id == $group_id) ? "selected='selected'":""  }}>{{ $Group->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- fields -->
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{{ __('backend.contactPhone') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('phone','', array('placeholder' =>'','class' => 'form-control','id'=>'phone')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{{ __('backend.contactEmail') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::email('email','', array('placeholder' =>'','class' => 'form-control','id'=>'email','required'=>'')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{{ __('backend.companyName') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('company','', array('placeholder' =>'','class' => 'form-control','id'=>'company')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{!!  __('backend.country') !!}</label>
                                <div class="col-sm-9">
                                    <select name="country_id" id="country_id"
                                            class="form-control select2 select2-hidden-accessible" ui-jp="select2"
                                            ui-options="{theme: 'bootstrap'}">
                                        <option value="">- - {!!  __('backend.country') !!} - -
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
                                            <option value="{{ $country->id  }}">{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{{ __('backend.city') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('city','', array('placeholder' =>'','class' => 'form-control','id'=>'city')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">{{ __('backend.notes') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('notes','', array('placeholder' => '','class' => 'form-control','rows'=>'2')) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="material-icons">
                                            &#xe31b;</i> {!! __('backend.add') !!}</button>
                                </div>
                            </div>

                        </div>
                        <!-- / fields -->
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /column -->
