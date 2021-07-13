{{-- Related Topics --}}
@if($WebmasterSection->related_status)
    <div class="tab-pane  {{ $tab_7 }}" id="tab_related">

        <div class="box-body">
            @if (Session::has('relatedST'))
                @if (Session::get('relatedST') == "create")

                    <div>
                        {{Form::open(['route'=>['topicsRelatedStore',$WebmasterSection->id,$Topics->id],'method'=>'POST' ])}}

                        <div class="form-group row">
                            <label for="file_title_ar"
                                   class="col-sm-2 form-control-label">{!!  __('backend.siteSectionsSettings') !!}
                            </label>
                            <div class="col-sm-10">
                                <select name="related_section_id" id="related_section_id"
                                        class="form-control c-select">
                                    <option value="0">- - {!!  __('backend.topicSelectSection') !!}
                                        - -
                                    </option>
                                    <?php
                                    $title_var = "title_" . @Helper::currentLanguage()->code;
                                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                    ?>
                                    @foreach ($GeneralWebmasterSections as $WebmasterSection)
                                        <?php
                                        if ($WebmasterSection->$title_var != "") {
                                            $WSectionTitle = $WebmasterSection->$title_var;
                                        } else {
                                            $WSectionTitle = $WebmasterSection->$title_var2;
                                        }
                                        ?>
                                        <option
                                            value="{{ $WebmasterSection->id  }}">{!! $WSectionTitle !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file_title_ar"
                                   class="col-sm-2 form-control-label">{!!  __('backend.relatedTopics') !!}
                            </label>
                            <div class="col-sm-10">
                                <div id="r_topics"
                                     style="max-height: 200px;overflow-y: scroll;padding: 5px;background: #f5f5f5;border: 1px solid #eee">
                                    <i class="material-icons">&#xe8fd;</i> {!!  __('backend.relatedTopicsSelect') !!}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row m-t-md">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary m-t"><i
                                        class="material-icons">
                                        &#xe31b;</i> {!! __('backend.add') !!}</button>
                                <a href="{{ route('topicsRelated',[$WebmasterSection->id,$Topics->id]) }}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>

                @endif

            @else

                @if(count($Topics->relatedTopics)>0)
                    <div class="row m-b">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary"
                               href="{{route("topicsRelatedCreate",[$WebmasterSection->id,$Topics->id])}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ __('backend.relatedTopicsAdd') }}
                            </a>
                        </div>
                    </div>
                @endif
                @if(count($Topics->relatedTopics) == 0)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class=" p-y-2 p-x text-center light b-a h6 m-a-0">
                                <div class="text-muted m-b"><i class="fa fa-laptop fa-4x"></i></div>
                                {{ __('backend.noData') }}
                                <br>
                                <br>
                                <a class="btn btn-fw primary"
                                   href="{{route("topicsRelatedCreate",[$WebmasterSection->id,$Topics->id])}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ __('backend.relatedTopicsAdd') }}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif
                @if(count($Topics->relatedTopics)>0)
                    {{Form::open(['route'=>['topicsRelatedUpdateAll',$WebmasterSection->id,$Topics->id],'method'=>'post'])}}
                    <table class="table table-bordered">
                        <thead class="dker">
                        <tr>
                            <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll4" type="checkbox"><i></i>
                                </label>
                            </th>
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
                        @foreach($Topics->relatedTopics as $relatedTopic)
                            <?php


                            if ($relatedTopic->topic->$title_var != "") {
                                $relatedTopic_title = $relatedTopic->topic->$title_var;
                            } else {
                                $relatedTopic_title = $relatedTopic->topic->$title_var2;
                            }

                            ?>
                            <tr>
                                <td class="dker"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]"
                                               value="{{ $relatedTopic->id }}"><i
                                            class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$relatedTopic->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td> {!! Form::text('row_no_'.$relatedTopic->id,$relatedTopic->row_no, array('class' => 'pull-left form-control row_no')) !!}
                                    <small>
                                        {!! $relatedTopic_title !!}
                                    </small>
                                </td>
                                <td class="text-center">
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning" data-toggle="modal"
                                                data-target="#mf-{{ $relatedTopic->id }}"
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
                            <div id="mf-{{ $relatedTopic->id }}" class="modal fade"
                                 data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {!! $relatedTopic_title !!} ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <a href="{{ route("topicsRelatedDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$Topics->id,"related_id"=>$relatedTopic->id]) }}"
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
    @push("after-scripts")
        <?php
        if (Session::has('relatedST')){
        if (Session::get('relatedST') == "create"){
        ?>
        <script type="text/javascript">
            $('#related_section_id').change(function () {

                var fid = $(this).val();
                $(document).ready(function () {
                    $.ajax({
                        url: '<?php echo url(env('BACKEND_PATH', 'admin') . "/relatedLoad"); ?>/' + fid,
                        data: {},
                        success: function (data) {
                            $('#r_topics').html(data)
                        }
                    }); //End of Ajax
                });

            });
        </script>
        <?php
        }
        }
        ?>
    @endpush
@endif
{{-- End of Related Topics --}}
