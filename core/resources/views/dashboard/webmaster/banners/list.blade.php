@extends('dashboard.layouts.master')
@section('title', __('backend.adsBannersSettings'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.adsBannersSettings') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.webmasterTools') }} /
                    <a href="">{{ __('backend.adsBannersSettings') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{route("WebmasterBannersCreate")}}">
                            <i class="material-icons">&#xe02e;</i>
                            &nbsp; {{ __('backend.addNewBannerType') }}</a>
                    </li>
                </ul>
            </div>
            @if($WebmasterBanners->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center light ">
                            {{ __('backend.noData') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($WebmasterBanners->total() > 0)
                {{Form::open(['route'=>'WebmasterBannersUpdateAll','method'=>'post'])}}
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead  class="dker">
                        <tr>
                            <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>{{ __('backend.bannerTitle') }}</th>
                            <th class="text-center">{{ __('backend.sectionType') }}</th>
                            <th class="text-center">{{ __('backend.size') }}</th>
                            <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $title_var = "title_" . @Helper::currentLanguage()->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                        ?>
                        @foreach($WebmasterBanners as $WebmasterBanner)
                            <?php
                            if ($WebmasterBanner->$title_var != "") {
                                $title = $WebmasterBanner->$title_var;
                            } else {
                                $title = $WebmasterBanner->$title_var2;
                            }
                            ?>
                            <tr>
                                <td class="dker"><label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $WebmasterBanner->id }}"><i
                                            class="dark-white"></i>
                                        {!! Form::hidden('row_ids[]',$WebmasterBanner->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td class="h6">
                                    {!! Form::text('row_no_'.$WebmasterBanner->id,$WebmasterBanner->row_no, array('class' => 'form-control row_no','id'=>'row_no')) !!}
                                    {!! $title !!}</td>
                                <td class="text-center">{!! ($WebmasterBanner->type==2) ? "<span class='label red'><i class='material-icons'>&#xe63a;</i>  ".__('backend.sectionTypeVideo')."</span>":"" !!}
                                    {!! ($WebmasterBanner->type==1) ? "<span class='label green'><i class='material-icons'>&#xe251;</i>  ".__('backend.sectionTypePhoto')."</span>":"" !!}
                                    {!! ($WebmasterBanner->type==0) ? "<span class='label'><i class='material-icons'>&#xe86f;</i>  ".__('backend.sectionTypeCode')."</span>":"" !!}
                                </td>
                                <td class="text-center">{{ $WebmasterBanner->width }}* {{ $WebmasterBanner->height }}</td>
                                <td class="text-center">
                                    <i class="fa {{ ($WebmasterBanner->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm success"
                                       href="{{ route("WebmasterBannersEdit",["id"=>$WebmasterBanner->id]) }}">
                                        <small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                        </small>
                                    </a>

                                    <button class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#m-{{ $WebmasterBanner->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate">
                                        <small><i class="material-icons">&#xe872;</i> {{ __('backend.delete') }}
                                        </small>
                                    </button>


                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $WebmasterBanner->id }}" class="modal fade" data-backdrop="true">
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
                                            <a href="{{ route("WebmasterBannersDestroy",["id"=>$WebmasterBanner->id]) }}"
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

                            <select name="action" id="action" class="form-control c-select w-sm inline v-middle"
                                    required>
                                <option value="">{{ __('backend.bulkAction') }}</option>
                                <option value="order">{{ __('backend.saveOrder') }}</option>
                                <option value="activate">{{ __('backend.activeSelected') }}</option>
                                <option value="block">{{ __('backend.blockSelected') }}</option>
                                <option value="delete">{{ __('backend.deleteSelected') }}</option>
                            </select>
                            <button type="submit" id="submit_all"
                                    class="btn white">{{ __('backend.apply') }}</button>
                            <button id="submit_show_msg" class="btn white" data-toggle="modal"
                                    style="display: none"
                                    data-target="#m-all" ui-toggle-class="bounce"
                                    ui-target="#animate">{{ __('backend.apply') }}
                            </button>
                        </div>

                        <div class="col-sm-3 text-center">
                            <small
                                class="text-muted inline m-t-sm m-b-sm">{{ __('backend.showing') }} {{ $WebmasterBanners->firstItem() }}
                                -{{ $WebmasterBanners->lastItem() }} {{ __('backend.of') }}
                                <strong>{{ $WebmasterBanners->total()  }}</strong> {{ __('backend.records') }}
                            </small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $WebmasterBanners->links() !!}
                        </div>
                    </div>
                </footer>
                {{Form::close()}}
            @endif
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
    </script>
@endpush
