{{-- Additional Files--}}
@if($WebmasterSection->extra_attach_file_status)
    <div class="tab-pane  {{ $tab_6 }}" id="tab_files">

        <div class="box-body">
            @if (Session::has('fileST'))
                @if (Session::get('fileST') == "create")
                    <div>
                        {{Form::open(['route'=>['topicsFilesStore',$WebmasterSection->id,$Topics->id],'method'=>'POST', 'files' => true ])}}

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
                            <label for="files_file"
                                   class="col-sm-2 form-control-label">{!!  __('backend.topicAttach') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::file('file', array('class' => 'form-control','id'=>'attach_file','required'=>'')) !!}
                            </div>
                        </div>
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="offset-sm-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  __('backend.attachTypes') !!}
                                </small>
                            </div>
                        </div>


                        <div class="form-group row m-t-md">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i
                                        class="material-icons">
                                        &#xe31b;</i> {!! __('backend.add') !!}</button>
                                <a href="{{ route('topicsFiles',[$WebmasterSection->id,$Topics->id]) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                @endif
                @if (Session::get('fileST') == "edit")
                    <div>
                        {{Form::open(['route'=>['topicsFilesUpdate',$WebmasterSection->id,$Topics->id,Session::get('AttachFile')->id],'method'=>'POST', 'files' => true ])}}

                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('title_'.@$ActiveLanguage->code,Session::get('AttachFile')->{'title_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group row">
                            <label for="files_file"
                                   class="col-sm-2 form-control-label">{!!  __('backend.topicAttach') !!}</label>
                            <div class="col-sm-10">
                                <div class="col-sm-4 box p-a-xs">
                                    <a target="_blank"
                                       href="{{ asset('uploads/topics/'.Session::get('AttachFile')->file) }}"> {!! Helper::GetIcon(asset('uploads/topics/'),Session::get('AttachFile')->file) !!} {{ Session::get('AttachFile')->file }} </a>
                                </div>
                                {!! Form::file('file', array('class' => 'form-control','id'=>'files_file')) !!}
                            </div>
                        </div>
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="offset-sm-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  __('backend.attachTypes') !!}
                                </small>
                            </div>
                        </div>

                        <div class="form-group row m-t-md">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i
                                        class="material-icons">
                                        &#xe31b;</i> {!! __('backend.update') !!}</button>
                                <a href="{{ route('topicsFiles',[$WebmasterSection->id,$Topics->id]) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                @endif
            @else

                @if(count($Topics->attachFiles)>0)
                    <div class="row m-b">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary"
                               href="{{route("topicsFilesCreate",[$WebmasterSection->id,$Topics->id])}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ __('backend.topicAttach') }}
                            </a>
                        </div>
                    </div>
                @endif
                @if(count($Topics->attachFiles) == 0)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class=" p-y-2 p-x text-center light b-a h6 m-a-0">
                                <div class="text-muted m-b"><i class="fa fa-laptop fa-4x"></i></div>
                                {{ __('backend.noData') }}
                                <br>
                                <br>
                                <a class="btn btn-fw primary"
                                   href="{{route("topicsFilesCreate",[$WebmasterSection->id,$Topics->id])}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ __('backend.topicAttach') }}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif
                @if(count($Topics->attachFiles)>0)
                    {{Form::open(['route'=>['topicsFilesUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                    <table class="table table-bordered">
                        <thead class="dker">
                        <tr>
                            <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll4" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ __('backend.topicAttach') }}</th>
                            <th>{{ __('backend.topicName') }}</th>
                            <th class="text-center"
                                style="width:200px;">{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . @Helper::currentLanguage()->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                        ?>
                        @foreach($Topics->attachFiles as $file)
                            <?php
                            if ($file->$title_var != "") {
                                $file_title = $file->$title_var;
                            } else {
                                $file_title = $file->$title_var2;
                            }
                            ?>
                            <tr>
                                <td class="dker"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]"
                                               value="{{ $file->id }}"><i
                                            class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$file->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td>
                                    {!! Form::text('row_no_'.$file->id,$file->row_no, array('class' => 'pull-left form-control row_no')) !!}
                                    <a href="{{ asset('uploads/topics/'.$file->file) }}"
                                       target="_blank">
                                        {!! Helper::GetIcon(asset('uploads/topics/'),$file->file) !!}
                                        {{$file->file}}</a>
                                </td>
                                <td>
                                    <small>
                                        {!! $file_title !!}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm success"
                                       href="{{ route("topicsFilesEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"file_id"=>$file->id]) }}">
                                        <small><i class="material-icons">
                                                &#xe3c9;</i> {{ __('backend.edit') }}</small>
                                    </a>
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                data-target="#mf-{{ $file->id }}"
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
                            <div id="mf-{{ $file->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {!! $file_title !!} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <a href="{{ route("topicsFilesDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"file_id"=>$file->id]) }}"
                                               class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                        @endforeach

                        </tbody>
                    </table>
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
            @endif
        </div>
    </div>
@endif
{{-- End of Additional Files--}}
