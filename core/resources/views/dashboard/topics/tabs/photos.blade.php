@if($WebmasterSection->multi_images_status)
    <div class="tab-pane  {{ $tab_3 }}" id="tab_photos">

        <div class="box-body">

            <div>
                {{Form::open(['route'=>['topicsPhotosEdit',"webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id],'method'=>'POST','class'=>'dropzone white', 'files' => true])}}
                <div class="dz-message" ui-jp="dropzone"
                     ui-options="{ url: '{{ asset('assets/dashboard/js/dropzone') }}' }">
                    <h4 class="m-t-lg m-b-md">{{ __('backend.topicDropFiles') }}</h4>
                    <span class="text-muted block m-b-lg">( {{ __('backend.topicDropFiles2') }}
                                        )</span>
                </div>
                {{Form::close()}}
                <br>
            </div>
            @if(count($Topics->photos)>0)
                <div class="row">
                    {{Form::open(['route'=>['topicsPhotosUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                    @foreach($Topics->photos as $photo)
                        <div class="col-xs-6 col-sm-4 col-md-3">
                            <div class="box p-a-xs">
                                <div class="pull-right">
                                    {!! Form::text('row_no_'.$photo->id,$photo->row_no, array('class' => 'pull-left form-control row_no','id'=>'row_no','style'=>'margin:0;margin-bottom:5px')) !!}
                                </div>
                                <label class="ui-check m-a-0 p-a-0">
                                    <input type="checkbox" name="ids[]" value="{{ $photo->id }}"><i
                                        class="dark-white"></i>
                                    {!! Form::hidden('row_ids[]',$photo->id, array('class' => 'form-control row_no')) !!}
                                </label>
                                <img src="{{ asset('uploads/topics/'.$photo->file) }}"
                                     alt="{{ $photo->title  }}" title="{{ $photo->title  }}"
                                     style="height: 150px"
                                     class="img-responsive">
                                <div class="p-a-sm">
                                    <div class="text-ellipsis">
                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                            <button class="btn btn-sm warning pull-right"
                                                    data-toggle="modal"
                                                    data-target="#mx-{{ $photo->id }}"
                                                    ui-toggle-class="bounce"
                                                    ui-target="#animate"
                                                    title="{{ __('backend.delete') }}"
                                                    style="padding: 0 5px 2px;">
                                                <small><i class="material-icons">&#xe872;</i></small>
                                            </button>
                                        @endif
                                        <a style="display: block;overflow: hidden;"
                                           href="{{ asset('uploads/topics/'.$photo->file) }}"
                                           target="_blank">
                                            <small>{{ ($photo->title !="") ? $photo->title:$photo->file  }}</small>
                                        </a>
                                    </div>
                                </div>

                                <!-- .modal -->
                                <div id="mx-{{ $photo->id }}" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog" id="animate">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <p>
                                                    {{ __('backend.confirmationDeleteMsg') }}
                                                    <br>
                                                    <strong>[ {{ ($photo->title !="") ? $photo->title:$photo->file  }}
                                                        ]</strong>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white p-x-md"
                                                        data-dismiss="modal">{{ __('backend.no') }}</button>
                                                <a href="{{ route("topicsPhotosDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"photo_id"=>$photo->id]) }}"
                                                   class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div>
                                </div>
                                <!-- / .modal -->
                            </div>
                        </div>

                    @endforeach
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <!-- .modal -->
                        <div id="mx-all" class="modal fade" data-backdrop="true">
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

                        <label class="ui-check m-a-0">
                            <input id="checkAll"
                                   type="checkbox"><i></i> {{ __('backend.checkAll') }}
                        </label>
                        <div class="pull-right">
                            <select name="action" id="action"
                                    class="form-control c-select w-sm inline v-middle" required>
                                <option value="">{{ __('backend.bulkAction') }}</option>
                                <option value="order">{{ __('backend.saveOrder') }}</option>
                                @if(@Auth::user()->permissionsGroup->delete_status)
                                    <option value="delete">{{ __('backend.deleteSelected') }}</option>
                                @endif
                            </select>
                            <button type="submit" id="submit_all"
                                    class="btn white">{{ __('backend.apply') }}</button>
                            <button id="submit_show_msg" class="btn white" data-toggle="modal"
                                    style="display: none"
                                    data-target="#mx-all" ui-toggle-class="bounce"
                                    ui-target="#animate">{{ __('backend.apply') }}
                            </button>
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            @endif
        </div>
    </div>
@endif
