<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . env('DEFAULT_LANGUAGE');
if ($WebmasterSection->$title_var != "") {
    $WebmasterSectionTitle = $WebmasterSection->$title_var;
} else {
    $WebmasterSectionTitle = $WebmasterSection->$title_var2;
}
?>
@extends('dashboard.layouts.master')
@section('title', __('backend.sectionsOf')." ".$WebmasterSectionTitle)
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.sectionsOf') }}  {!! $WebmasterSectionTitle !!}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>{!! $WebmasterSectionTitle !!}</a> /
                    <a>{{ __('backend.sectionsOf') }}  {!! $WebmasterSectionTitle !!}</a>
                </small>
            </div>
            @if($Sections->total() > 0)
                @if(@Auth::user()->permissionsGroup->add_status)
                    <div class="row p-a">
                        <div class="col-sm-12">
                            <a class="btn btn-fw primary" href="{{route("categoriesCreate",$WebmasterSection->id)}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ __('backend.categoryNew') }}</a>
                        </div>
                    </div>
                @endif
            @endif
            @if($Sections->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center ">
                            {{ __('backend.noData') }}
                            <br>
                            <br>
                            @if(@Auth::user()->permissionsGroup->add_status)
                                <a class="btn btn-fw primary"
                                   href="{{route("categoriesCreate",$WebmasterSection->id)}}">
                                    <i class="material-icons">&#xe02e;</i>
                                    &nbsp; {{ __('backend.sectionNew') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($Sections->total() > 0)
                {{Form::open(['route'=>['categoriesUpdateAll',$WebmasterSection->id],'method'=>'post'])}}
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th class="dker width20">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ __('backend.categoryName') }}</th>
                            <th class="text-center" style="width:100px;">{{ __('backend.contents') }}</th>
                            <th class="text-center" style="width:100px;">{{ __('backend.visits') }}</th>
                            <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . @Helper::currentLanguage()->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                        ?>
                        @foreach($Sections as $Section)
                            <?php
                            if ($Section->$title_var != "") {
                                $title = $Section->$title_var;
                            } else {
                                $title = $Section->$title_var2;
                            }
                            try {
                                $ccount = @$category_and_topics_count[$Section->id];
                            } catch (Exception $e) {
                                $ccount = 0;
                            }
                            ?>
                            <tr>
                                <td class="dker"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $Section->id }}"><i
                                            class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$Section->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td class="h6">
                                    @if($Section->photo !="")
                                        <div class="pull-right">
                                            <img src="{{ asset('uploads/sections/'.$Section->photo) }}"
                                                 style="height: 30px" alt="{{ $title }}">
                                        </div>
                                    @endif
                                    {!! Form::text('row_no_'.$Section->id,$Section->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                    @if($Section->icon !="")
                                        <i class="fa {!! $Section->icon !!} "></i>
                                    @endif
                                    {{ $title }}</td>
                                <td class="text-center">
                                    {!! $ccount !!}
                                </td>
                                <td class="text-center">
                                    {!! $Section->visits  !!}
                                </td>

                                <td class="text-center">
                                    <i class="fa {{ ($Section->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm info"
                                       href="{{ Helper::categoryURL($Section->id) }}"
                                       data-toggle="tooltip" data-original-title="{{ __('backend.viewDetails') }}"
                                       target="_blank">
                                        <i class="material-icons">&#xe8f4;</i>
                                    </a>

                                    @if(@Auth::user()->permissionsGroup->edit_status)
                                        <a class="btn btn-sm success"
                                           href="{{ route("categoriesEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$Section->id]) }}"
                                           data-toggle="tooltip" data-original-title="{{ __('backend.edit') }}">
                                            <i class="material-icons">&#xe3c9;</i>
                                        </a>
                                    @endif
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button class="btn btn-sm warning" type="button"
                                                onclick="DeleteCategory('{{ $Section->id }}')" data-toggle="tooltip"
                                                data-original-title="{{ __('backend.delete') }}">
                                            <i class="material-icons">&#xe872;</i>
                                        </button>
                                    @endif

                                </td>
                            </tr>

                            @foreach($Section->fatherSections as $subSection)
                                <?php
                                if ($subSection->$title_var != "") {
                                    $title = $subSection->$title_var;
                                } else {
                                    $title = $subSection->$title_var2;
                                }
                                ?>
                                <tr>
                                    <td class="dker"><label class="ui-check m-a-0">
                                            <input type="checkbox" name="ids[]" value="{{ $subSection->id }}"><i
                                                class="dark-white"></i>
                                            {!! Form::hidden('row_ids[]',$subSection->id, array('class' => 'form-control row_no')) !!}
                                        </label>
                                    </td>
                                    <td class="h6">
                                        @if($subSection->photo !="")
                                            <div class="pull-right">
                                                <img src="{{ asset('uploads/sections/'.$subSection->photo) }}"
                                                     style="height: 30px" alt="{{ $title }}">
                                            </div>
                                        @endif
                                        <img
                                            src="{{ asset('assets/dashboard/images/treepart_'.@Helper::currentLanguage()->direction.'.png') }}"
                                            class="submenu_tree">
                                        {!! Form::text('row_no_'.$subSection->id,$subSection->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                        @if($subSection->icon !="")
                                            <i class="fa {!! $subSection->icon !!} "></i>
                                        @endif
                                        {!! $title   !!}</td>
                                    <td class="text-center">
                                        {!! $subSection->visits  !!}
                                    </td>
                                    <td class="text-center">
                                        {!! $subSection->visits !!}
                                    </td>
                                    <td class="text-center">
                                        <i class="fa {{ ($subSection->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-sm info"
                                           href="{{ Helper::categoryURL($subSection->id) }}"
                                           data-toggle="tooltip" data-original-title="{{ __('backend.viewDetails') }}"
                                           target="_blank">
                                            <i class="material-icons">&#xe8f4;</i>
                                        </a>

                                        @if(@Auth::user()->permissionsGroup->edit_status)
                                            <a class="btn btn-sm success"
                                               href="{{ route("categoriesEdit",["webmasterId"=>$WebmasterSection->id,"id"=>$subSection->id]) }}"
                                               data-toggle="tooltip" data-original-title="{{ __('backend.edit') }}">
                                                <i class="material-icons">&#xe3c9;</i>
                                            </a>
                                        @endif
                                        @if(@Auth::user()->permissionsGroup->delete_status)
                                            <button class="btn btn-sm warning" type="button"
                                                    onclick="DeleteCategory('{{ $subSection->id }}')" data-toggle="tooltip"
                                                    data-original-title="{{ __('backend.delete') }}">
                                                <i class="material-icons">&#xe872;</i>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                                <!-- .modal -->
                                <div id="m-{{ $subSection->id }}" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog" id="animate">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                            </div>
                                            <div class="modal-body text-center p-lg">
                                                <p>
                                                    {{ __('backend.confirmationDeleteMsg') }}
                                                    <br>
                                                    <strong>[ {{ $title }} ]</strong>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark-white p-x-md"
                                                        data-dismiss="modal">{{ __('backend.no') }}</button>
                                                <a href="{{ route("categoriesDestroy",["webmasterId"=>$WebmasterSection->id,"id"=>$subSection->id]) }}"
                                                   class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div>
                                </div>
                                <!-- / .modal -->
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <!-- .modal -->
                            <div id="m-all" class="modal fade" data-backdrop="true">
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

                            @if(@Auth::user()->permissionsGroup->edit_status)
                                <select name="action" id="action" class="form-control c-select w-sm inline v-middle"
                                        required>
                                    <option value="">{{ __('backend.bulkAction') }}</option>
                                    <option value="order">{{ __('backend.saveOrder') }}</option>
                                    <option value="activate">{{ __('backend.activeSelected') }}</option>
                                    <option value="block">{{ __('backend.blockSelected') }}</option>
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <option value="delete">{{ __('backend.deleteSelected') }}</option>
                                    @endif
                                </select>
                                <button type="submit" id="submit_all"
                                        class="btn white">{{ __('backend.apply') }}</button>
                                <button id="submit_show_msg" class="btn white" data-toggle="modal"
                                        style="display: none"
                                        data-target="#m-all" ui-toggle-class="bounce"
                                        ui-target="#animate">{{ __('backend.apply') }}
                                </button>
                            @endif
                        </div>

                        <div class="col-sm-3 text-center">
                            <small
                                class="text-muted inline m-t-sm m-b-sm">{{ __('backend.showing') }} {{ $Sections->firstItem() }}
                                -{{ $Sections->lastItem() }} {{ __('backend.of') }}
                                <strong>{{ $Sections->total()  }}</strong> {{ __('backend.records') }}</small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $Sections->links() !!}
                        </div>
                    </div>
                </footer>
                {{Form::close()}}
            @endif
        </div>
    </div>
    <!-- .modal -->
    <div id="delete-category" class="modal fade" data-backdrop="true">
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
                    <a type="button" id="category_delete_btn" href=""
                       class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });

        function DeleteCategory(id) {
            $("#category_delete_btn").attr("href", '{{ route("categoriesDestroy",["webmasterId"=>$WebmasterSection->id]) }}/' + id);
            $("#delete-category").modal("show");
        }
    </script>
@endpush
