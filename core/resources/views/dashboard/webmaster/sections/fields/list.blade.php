@if(count($WebmasterSections->allCustomFields)>0)
    <div class="row p-a">
        <a class="btn btn-fw primary"
           href="{{route("webmasterFieldsCreate",[$WebmasterSections->id])}}">
            <i class="material-icons">&#xe02e;</i>
            &nbsp; {{ __('backend.customFieldsNewField') }}
        </a>
    </div>
@endif
@if(count($WebmasterSections->allCustomFields) == 0)
    <div class="row">
        <div class="col-sm-12">
            <div class=" p-y-2 p-x text-center light b-a h6 m-a-0">
                <div class="text-muted m-b"><i class="fa fa-laptop fa-4x"></i></div>
                {{ __('backend.noData') }}
                <br>
                <br>
                <a class="btn btn-fw primary"
                   href="{{route("webmasterFieldsCreate",[$WebmasterSections->id])}}">
                    <i class="material-icons">&#xe02e;</i>
                    &nbsp; {{ __('backend.customFieldsNewField') }}
                </a>

            </div>
        </div>
    </div>
@endif
@if(count($WebmasterSections->allCustomFields)>0)
    {{Form::open(['route'=>['webmasterFieldsUpdateAll',$WebmasterSections->id],'method'=>'post'])}}
    <div>
        <table class="table table-bordered">
            <thead class="dker">
            <tr>
                <th class="width20 dker">
                    <label class="ui-check m-a-0">
                        <input id="checkAll4" type="checkbox"><i></i>
                    </label>
                </th>
                <th>{{ __('backend.customFieldsTitle') }}</th>
                <th>{{ __('backend.customFieldsType') }}</th>
                <th class="text-center"
                    style="width:120px;">{{ __('backend.customFieldsRequired') }}</th>
                <th class="text-center"
                    style="width:100px;">{{ __('backend.language') }}</th>
                <th class="text-center"
                    style="width:120px;">{{ __('backend.status') }}</th>
                <th class="text-center"
                    style="width:200px;">{{ __('backend.options') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $title_var = "title_" . @Helper::currentLanguage()->code;
            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            ?>
            @foreach($WebmasterSections->allCustomFields as $customField)
                <?php
                if ($customField->$title_var != "") {
                    $field_title = $customField->$title_var;
                } else {
                    $field_title = $customField->$title_var2;
                }

                $type_var = "customFieldsType" . $customField->type;
                ?>
                <tr>
                    <td class="{!! $customField->css_class !!} dker"><label class="ui-check m-a-0">
                            <input type="checkbox" name="ids[]"
                                   value="{{ $customField->id }}"><i
                                class="dark-white"></i>
                            {!! Form::hidden('row_ids[]',$customField->id, array('class' => 'form-control row_no')) !!}
                        </label>
                    </td>

                    <td class="h6 {!! $customField->css_class !!}">
                        {!! Form::text('row_no_'.$customField->id,$customField->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                        {!! $field_title  !!}</td>
                    <td class="{!! $customField->css_class !!}">

                        @if($customField->in_statics)
                            <i class="material-icons pull-right m-x-xs" data-toggle="tooltip"
                               data-original-title="<i class='material-icons'>&#xe5ca;</i> {{ __('backend.showStatics') }}">&#xe24b;</i>
                        @endif
                        @if($customField->in_page)
                            <i class="material-icons pull-right m-x-xs" data-toggle="tooltip"
                               data-original-title="<i class='material-icons'>&#xe5ca;</i> {{ __('backend.showFieldInPage') }}">&#xe86d;</i>
                        @endif
                        @if($customField->in_listing)
                            <i class="material-icons pull-right m-x-xs" data-toggle="tooltip"
                               data-original-title="<i class='material-icons'>&#xe5ca;</i> {{ __('backend.showFieldInListing') }}">&#xe23e;</i>
                        @endif
                        @if($customField->in_search)
                            <i class="material-icons pull-right m-x-xs" data-toggle="tooltip"
                               data-original-title="<i class='material-icons'>&#xe5ca;</i> {{ __('backend.showFieldInSearch') }}">&#xe8d9;</i>
                        @endif
                        @if($customField->in_table)
                            <i class="material-icons pull-right m-x-xs" data-toggle="tooltip"
                               data-original-title="<i class='material-icons'>&#xe5ca;</i> {{ __('backend.showFieldInTable') }}">&#xe3ec;</i>
                        @endif
                        <small>
                            {{ __('backend.'.$type_var) }}
                        </small>
                    </td>
                    <td class="text-center {!! $customField->css_class !!}">
                        <small>
                            {{ ($customField->required==1) ? __('backend.customFieldsRequired')."(*)":__('backend.customFieldsOptional') }}
                        </small>
                    </td>

                    <td class="text-center {!! $customField->css_class !!}">
                        <small>
                            {{ $customField->lang_code }}
                        </small>
                    </td>
                    <td class="text-center {!! $customField->css_class !!}">
                        <i class="fa {{ ($customField->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                    </td>
                    <td class="text-center {!! $customField->css_class !!}">
                        <a class="btn btn-sm success"
                           href="{{ route("webmasterFieldsEdit",["webmasterId"=>$WebmasterSections->id,"field_id"=>$customField->id]) }}">
                            <small><i class="material-icons">
                                    &#xe3c9;</i> {{ __('backend.edit') }}</small>
                        </a>
                        @if(@Auth::user()->permissionsGroup->delete_status)
                            <button class="btn btn-sm warning" data-toggle="modal"
                                    data-target="#mf-{{ $customField->id }}"
                                    ui-toggle-class="bounce"
                                    ui-target="#animate">
                                <small><i class="material-icons">
                                        &#xe872;</i> {{ __('backend.delete') }}
                                </small>
                            </button>
                        @endif

                    </td>
                </tr>
                <!-- .modal -->
                <div id="mf-{{ $customField->id }}" class="modal fade" data-backdrop="true">
                    <div class="modal-dialog" id="animate">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                            </div>
                            <div class="modal-body text-center p-lg">
                                <p>
                                    {{ __('backend.confirmationDeleteMsg') }}
                                    <br>
                                    <strong>[ {!! $field_title !!} ]</strong>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn dark-white p-x-md"
                                        data-dismiss="modal">{{ __('backend.no') }}</button>
                                <a href="{{ route("webmasterFieldsDestroy",["webmasterId"=>$WebmasterSections->id,"field_id"=>$customField->id]) }}"
                                   class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                            </div>
                        </div><!-- /.modal-content -->
                    </div>
                </div>
                <!-- / .modal -->
            @endforeach

            </tbody>
        </table>

    </div>
    <div class="row">
        <div class="col-sm-3 hidden-xs">
            <!-- .modal -->
            <div id="mf-all" class="modal fade" data-backdrop="true">
                <div class="modal-dialog" id="animate">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                        </div>
                        <div class="modal-body text-center p-lg">
                            <p>
                                {{ __('backend.confirmationDeleteMsg') }}
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark-white p-x-md"
                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                            <button type="submit"
                                    class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
            </div>
            <!-- / .modal -->

            <select name="action" id="action4"
                    class="form-control c-select w-sm inline v-middle" required>
                <option value="">{{ __('backend.bulkAction') }}</option>
                <option value="order">{{ __('backend.saveOrder') }}</option>
                <option value="activate">{{ __('backend.activeSelected') }}</option>
                <option value="block">{{ __('backend.blockSelected') }}</option>
                @if(@Auth::user()->permissionsGroup->delete_status)
                    <option value="delete">{{ __('backend.deleteSelected') }}</option>
                @endif
            </select>
            <button type="submit" id="submit_all4"
                    class="btn white">{{ __('backend.apply') }}</button>
            <button id="submit_show_msg4" class="btn white" data-toggle="modal"
                    style="display: none"
                    data-target="#mf-all" ui-toggle-class="bounce"
                    ui-target="#animate">{{ __('backend.apply') }}
            </button>
        </div>
    </div>
    {{Form::close()}}
@endif
