@extends('dashboard.layouts.master')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . env('DEFAULT_LANGUAGE');
if ($WebmasterSection->$title_var != "") {
    $WebmasterSectionTitle = $WebmasterSection->$title_var;
} else {
    $WebmasterSectionTitle = $WebmasterSection->$title_var2;
}
?>
@section('title', $WebmasterSectionTitle)
@push("after-styles")
    <link rel="stylesheet" href="{{ asset('assets/dashboard/js/datatables/datatables.min.css') }}">
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <?php
                $cf_title_var = "title_" . @Helper::currentLanguage()->code;
                $cf_title_var2 = "title_" . env('DEFAULT_LANGUAGE');

                $title_var = "title_" . @Helper::currentLanguage()->code;
                $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                if ($WebmasterSection->$title_var != "") {
                    $WebmasterSectionTitle = $WebmasterSection->$title_var;
                } else {
                    $WebmasterSectionTitle = $WebmasterSection->$title_var2;
                }
                ?>
                <h3>{!! $WebmasterSectionTitle !!}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>{!! $WebmasterSectionTitle !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    @if(@Auth::user()->permissionsGroup->add_status)
                        <li class="nav-item inline">
                            <a class="btn btn-fw primary" href="{{route("topicsCreate",$WebmasterSection->id)}}">
                                <i class="material-icons">&#xe02e;</i>
                                &nbsp; {{ __('backend.topicNew') }}  {!! $WebmasterSectionTitle !!}
                            </a>
                        </li>
                    @endif
                    <li class="nav-item inline">
                        <button type="button" class="btn btn-outline b-success text-success" id="filter_btn"><i
                                class="fa fa-search"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <div>

                <div class="dker b-b displayNone" id="filter_div">
                    <div class="p-a">
                        {{Form::open(['route'=>['topics',$WebmasterSection->id],'method'=>'GET','id'=>'filter_form','target'=>''])}}
                        <div class="filter_div">
                            <div class="row">
                                @if(count($WebmasterSection->customFields->where("in_search",true))==0)
                                    @if($WebmasterSection->date_status)

                                        <div class="col-md-3"></div>
                                    @else
                                        <div class="col-md-4"></div>
                                    @endif
                                @endif
                                <div class="col-md-3 col-xs-6 m-b-5p">
                                    {!! Form::text('find_q',@$_GET['find_q'], array('placeholder' =>  __('backend.searchFor'),'class' => 'form-control','id'=>'find_q', "autocomplete"=>"off")) !!}
                                </div>
                                @if($WebmasterSection->date_status)
                                    <div class="col-md-3 col-xs-6 m-b-5p">
                                        <div class="form-group m-b-0">
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }}',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('date',((@$_GET['date']!="")?Helper::formatDate(@$_GET['date']):""), array('placeholder' => __('backend.topicDate'),'class' => 'form-control','id'=>'find_date')) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @foreach($WebmasterSection->customFields as $customField)
                                    @if($customField->in_search)
                                        <?php
                                        if ($customField->$cf_title_var != "") {
                                            $cf_title = $customField->$cf_title_var;
                                        } else {
                                            $cf_title = $customField->$cf_title_var2;
                                        }

                                        // check field language status
                                        $cf_land_identifier = "";
                                        $cf_land_active = false;
                                        $cf_land_dir = @Helper::currentLanguage()->direction;
                                        if ($customField->lang_code != "all") {
                                            $ct_language = @Helper::LangFromCode($customField->lang_code);
                                            $cf_land_identifier = @Helper::languageName($ct_language);
                                            $cf_land_dir = $ct_language->direction;
                                            if ($ct_language->box_status) {
                                                $cf_land_active = true;
                                            }
                                        }
                                        if ($customField->lang_code == "all") {
                                            $cf_land_active = true;
                                        }
                                        // required Status
                                        $cf_required = "";
                                        ?>
                                        @if($cf_land_active)
                                            @if($customField->type ==12)

                                            @elseif($customField->type ==11)

                                            @elseif($customField->type ==10)

                                            @elseif($customField->type ==9)

                                            @elseif($customField->type ==8)

                                            @elseif($customField->type ==7 || $customField->type ==6)
                                                <div class="col-md-3 col-xs-6 m-b-5p">
                                                    <select name="{{'customField_'.$customField->id}}"
                                                            id="{{'customField_'.$customField->id}}"
                                                            class="form-control c-select" {{$cf_required}}>
                                                        <option value="">- - {!!  $cf_title !!} - -</option>
                                                        <?php
                                                        $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                                                        $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                                                        if ($customField->$cf_details_var != "") {
                                                            $cf_details = $customField->$cf_details_var;
                                                        } else {
                                                            $cf_details = $customField->$cf_details_var2;
                                                        }
                                                        $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                        $line_num = 1;
                                                        ?>
                                                        @foreach ($cf_details_lines as $cf_details_line)
                                                            <option
                                                                value="{{ $line_num  }}" {{ (@$_GET['customField_'.$customField->id] == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                                            <?php
                                                            $line_num++;
                                                            ?>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @elseif($customField->type ==5 || $customField->type ==4)
                                                <div class="col-md-3 col-xs-6 m-b-5p">
                                                    <div class="form-group m-b-0">
                                                        <div class='input-group date' ui-jp="datetimepicker"
                                                             ui-options="{
                format: '{{ Helper::jsDateFormat() }}',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                            {!! Form::text('customField_'.$customField->id,(@$_GET['customField_'.$customField->id]!="")?Helper::formatDate(@$_GET['customField_'.$customField->id]):"", array('placeholder' => $cf_title,'class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                            <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==3)
                                                <div class="col-md-3 col-xs-6 m-b-5p">
                                                    {!! Form::email('customField_'.$customField->id,@$_GET['customField_'.$customField->id], array('placeholder' => $cf_title,'class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                </div>
                                            @elseif($customField->type ==2)
                                                <div class="col-md-3 col-xs-6 m-b-5p">
                                                    {!! Form::number('customField_'.$customField->id,@$_GET['customField_'.$customField->id], array('placeholder' => $cf_title,'class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','min'=>0, 'dir'=>$cf_land_dir)) !!}
                                                </div>
                                            @else
                                                <div class="col-md-3 col-xs-6 m-b-5p">
                                                    {!! Form::text('customField_'.$customField->id,@$_GET['customField_'.$customField->id], array('placeholder' => $cf_title,'class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                                <div class="col-md-1 col-xs-6 m-b-5p">
                                    <button class="btn white w-full" id="search-btn" type="submit"><i
                                            class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                {{Form::open(['route'=>['topicsUpdateAll',$WebmasterSection->id],'method'=>'post'])}}
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%"
                           id="topics_{{ $WebmasterSection->id }}">
                        <thead class="dker">

                        @if(@Auth::user()->permissionsGroup->edit_status)
                            <th style="width:20px;">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                        @endif
                        @if($WebmasterSection->title_status)
                            <th>{{ __('backend.topicName') }}</th>
                        @endif
                        @if($WebmasterSection->date_status)
                            <th style="width:100px;">{{ __('backend.topicDate') }}</th>
                        @endif
                        @if($WebmasterSection->expire_date_status)
                            <th style="width:100px;">{{ __('backend.expireDate') }}</th>
                        @endif
                        @if($WebmasterSection->visits_status)
                            <th style="width:80px;">{{ __('backend.visits') }}</th>
                        @endif
                        @if($WebmasterSection->case_status)
                            <th style="width:80px;">{{ __('backend.status') }}</th>
                        @endif
                        @foreach($WebmasterSection->customFields as $customField)
                            <?php
                            // check permission
                            $view_permission_groups = [];
                            if ($customField->view_permission_groups != "") {
                                $view_permission_groups = explode(",", $customField->view_permission_groups);
                            }
                            if (in_array(Auth::user()->permissions_id, $view_permission_groups) || in_array(0, $view_permission_groups) || $customField->view_permission_groups == "") {
                            // have permission & continue
                            ?>
                            @if($customField->in_table)
                                @if ($customField->lang_code == "all" || $customField->lang_code == @Helper::currentLanguage()->code)
                                    <?php
                                    if ($customField->$cf_title_var != "") {
                                        $cf_title = $customField->$cf_title_var;
                                    } else {
                                        $cf_title = $customField->$cf_title_var2;
                                    }
                                    ?>
                                    <th class="text-center">{{ $cf_title }}</th>
                                @endif
                            @endif
                            <?php
                            }
                            ?>
                        @endforeach
                        <th class="text-center" style="max-width:150px;">{{ __('backend.options') }}</th>
                        </thead>
                    </table>
                </div>
                <footer class="p-x p-b light dk">
                    <div class="row">
                        <div class="col-sm-12 hidden-xs">
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
                                <select name="action" id="action"
                                        class="input-sm form-control w-sm inline v-middle c-select"
                                        required>
                                    <option value="">{{ __('backend.bulkAction') }}</option>
                                    @if(@Auth::user()->permissionsGroup->active_status)
                                        <option value="activate">{{ __('backend.activeSelected') }}</option>
                                        <option value="block">{{ __('backend.blockSelected') }}</option>
                                    @endif
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
                    </div>
                </footer>
                {{Form::close()}}

            </div>
        </div>
        @foreach($WebmasterSection->customFields as $customField)
            @if($customField->in_statics && ($customField->type==6 || $customField->type==7))
                <div class="box">
                    <?php
                    $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                    $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                    if ($customField->$cf_details_var != "") {
                        $cf_details = $customField->$cf_details_var;
                    } else {
                        $cf_details = $customField->$cf_details_var2;
                    }
                    $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                    $heigth = count($cf_details_lines) * 12;
                    if ($heigth < 200) {
                        $heigth = 200;
                    }
                    ?>
                    <div id="canvas-holder-{{ $customField->id }}"
                         style="overflow: auto;padding: 20px;border-bottom: 1px solid #ddd;">
                        <h6 class="text-muted">{!! $customField->$title_var !!}</h6>
                        <canvas id="chart-area-{{ $customField->id }}" width="920" height="{{ $heigth }}"
                                style="margin: 0 auto"></canvas>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- .modal -->
    <div id="delete-topic" class="modal fade" data-backdrop="true">
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
                    <button type="button" id="topic_delete_btn" row-id=""
                            class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endsection
@push("after-scripts")


    <script src="{{ URL::asset('assets/frontend/js/Chart.min.js') }}"></script>
    <script>
        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };

        window.onload = function () {
            @foreach($WebmasterSection->customFields as $customField)
            @if($customField->in_statics && ($customField->type==6 || $customField->type==7))
            <?php
            $cf_details_var = "details_" . @Helper::currentLanguage()->code;
            $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
            if ($customField->$cf_details_var != "") {
                $cf_details = $customField->$cf_details_var;
            } else {
                $cf_details = $customField->$cf_details_var2;
            }
            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
            ?>
            new Chart(document.getElementById('chart-area-{{ $customField->id }}').getContext('2d'), {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                            {{ (@$statics[$customField->id][$line_num] !="")?@$statics[$customField->id][$line_num]:0 }},
                            <?php
                            $line_num++;
                            ?>
                            @endforeach
                        ],
                        backgroundColor: [
                            <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)

                            dynamicColors(),
                            <?php
                            $line_num++;
                            ?>
                            @endforeach
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                        ('{{ $cf_details_line }}').substring(0, 40) + ((('{{ $cf_details_line }}').length > 40) ? '..' : '') + " ( " + '{{ (@$statics[$customField->id][$line_num] !="")?@$statics[$customField->id][$line_num]:0 }}' + ' )',
                        <?php
                        $line_num++;
                        ?>
                        @endforeach
                    ]
                },
                options: {
                    responsive: false,
                    legend: {
                        display: true,
                        position: 'left',
                        labels: {

                            // font size, default is defaultFontSize
                            fontSize: 11,

                            // font color, default is '#fff'
                            fontColor: '#666',

                            // font style, default is defaultFontStyle
                            fontStyle: 'normal',

                            // font family, default is defaultFontFamily
                            fontFamily: "smart4dsTitles, 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
                        }
                    }
                }
            });
            @endif
            @endforeach
        };
    </script>


    <script src="{{ asset('assets/dashboard/js/datatables/datatables.min.js') }}"></script>
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
        $(document).ready(function () {
            var table_name = "#topics_{{ $WebmasterSection->id }}";
            var dataTable = $(table_name).DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "responsive": true,
                "pageLength": {{ env('BACKEND_PAGINATION') }},
                "lengthMenu": [[10, 20, 30, 50, 75, 100, 200, -1], [10, 20, 30, 50, 75, 100, 200, "All"]],
                "ajax": {
                    "url": "{{ route('topicsList') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (data) {
                        data._token = "{{csrf_token()}}";
                        data.find_q = $('#find_q').val();
                        data.find_date = $('#find_date').val();
                        data.webmaster_id = '{{ $WebmasterSection->id }}';
                        @foreach($WebmasterSection->customFields as $customField)
                            @if($customField->in_search)
                            data.customField_{{ $customField->id }} = $('#customField_{{ $customField->id }}').val();
                        @endif
                        @endforeach
                    }

                },
                "dom": '<"dataTables_wrapper"<"col-sm-12 col-md-9"i><"col-sm-12 col-md-3"l><"col-sm-12 col-md-12"r><"row"t><"row b-t p-x p-t light dk"<"col-sm-12"p>>>',
                "fnDrawCallback": function () {
                    if ($(table_name + '_paginate .paginate_button').size() > 3) {
                        $(table_name + '_paginate')[0].style.display = "block";
                    } else {
                        $(table_name + '_paginate')[0].style.display = "none";
                    }


                    $('[data-toggle="tooltip"]').tooltip({html: true});
                },
                "language": {!! json_encode(__("backend.dataTablesTranslation")) !!}
                ,
                "columns": [

                        @if(@Auth::user()->permissionsGroup->edit_status)
                    {
                        "data": "check", "class": "dker", "orderable": false
                    },
                        @endif
                        @if($WebmasterSection->title_status)
                    {
                        "data": "id"
                    },
                        @endif
                        @if($WebmasterSection->date_status)
                    {
                        "data": "date", "orderable": true
                    },
                        @endif
                        @if($WebmasterSection->expire_date_status)
                    {
                        "data": "expire_date", "orderable": true
                    },
                        @endif
                        @if($WebmasterSection->visits_status)
                    {
                        "data": "visits", "orderable": true
                    },
                        @endif
                        @if($WebmasterSection->case_status)
                    {
                        "data": "status", "orderable": true
                    },
                        @endif
                        @foreach($WebmasterSection->customFields as $customField)
                        <?php
                        // check permission
                        $view_permission_groups = [];
                        if ($customField->view_permission_groups != "") {
                            $view_permission_groups = explode(",", $customField->view_permission_groups);
                        }
                        if (in_array(Auth::user()->permissions_id, $view_permission_groups) || in_array(0, $view_permission_groups) || $customField->view_permission_groups == "") {
                        // have permission & continue
                        ?>
                        @if($customField->in_table)
                        @if ($customField->lang_code == "all" || $customField->lang_code == @Helper::currentLanguage()->code)
                    {
                        "data": "field_{{ $customField->id }}", "orderable": false,
                        "createdCell": function (td, cellData, rowData, row, col) {
                            $(td).addClass(rowData['class_field_{{ $customField->id }}']);
                        },
                    },
                        @endif
                        @endif
                        <?php
                        }
                        ?>
                        @endforeach
                    {
                        "data": "options", "orderable": false
                    }
                ]
                @if(@Auth::user()->permissionsGroup->edit_status)
                , "order": [[1, "desc"]]
                @else
                , "order": [[0, "desc"]]
                @endif

            });
            dataTable.on('page.dt', function () {
                $('html, body').animate({
                    scrollTop: $(".dataTables_wrapper").offset().top
                }, 'slow');
            });
            $.fn.dataTable.ext.errMode = 'none';

            $("#filter_form").submit(function (event) {
                event.preventDefault();
                dataTable.draw();
            });
        });

        $("#filter_btn").click(function () {
            $("#filter_div").slideToggle();
        });

        function DeleteTopic(id) {
            $("#topic_delete_btn").attr("row-id", id);
            $("#delete-topic").modal("show");
        }

        $("#topic_delete_btn").click(function () {
            $(this).html("<img src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 25px\"/> {!! __('backend.yes') !!}");
            var row_id = $(this).attr('row-id');
            if (row_id != "") {
                $.ajax({
                    type: "GET",
                    url: "<?php echo route("topicsDestroy", ["webmasterId" => $WebmasterSection->id]); ?>/" + row_id,
                    success: function (result) {
                        var obj_result = jQuery.parseJSON(result);
                        if (obj_result.stat == 'success') {
                            $('#topic_delete_btn').html("{!! __('backend.yes') !!}");
                            $('#topics_{{ $WebmasterSection->id }}').DataTable().ajax.reload();
                        }
                        $('#delete-topic').modal('hide');
                        $('.modal-backdrop').hide();
                    }
                });
            }
        });
    </script>
@endpush
