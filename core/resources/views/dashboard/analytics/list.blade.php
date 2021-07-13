@extends('dashboard.layouts.master')
@section('title', __('backend.visitorsAnalytics'))
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/bootstrap-daterangepicker/daterangepicker-bs3.css") }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="padding">
        <div class="row m-b">
            <div class="col-sm-6 m-b-sm">
                <h3> {{ __('backend.visitorsAnalytics') }} [ {{ __('backend.'.$statText) }} ]</h3>
            </div>
            <div class="col-sm-6 text-sm-right">
                <div class="btn-group m-l-xs m-t-1">
                    {{Form::open(['route'=>['analyticsFilter',$stat],'method'=>'POST', 'id' => "form_ofchangedate" ])}}
                    <div id="dashboard-report-range" class="btn btn-sm primary"
                         data-placement="top" data-original-title="Change dashboard date range">
                        <i class="fa fa-calendar"></i>
                        <span>
								</span>
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <input type="hidden" id="this_daterangepicker_start"
                           name="this_daterangepicker_start"
                           value="<?php echo date("d-m-Y", strtotime($daterangepicker_start)); ?>"/>
                    <input type="hidden" id="this_daterangepicker_end" name="this_daterangepicker_end"
                           value="<?php echo date("d-m-Y", strtotime($daterangepicker_end)); ?>"/>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <div class="row m-b">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <div class="box-color p-a-3 primary">
                    <div class="pull-right m-l">
            <span class="w-56 dker text-center rounded">
              <i class="text-lg material-icons">&#xe7fb;</i>
            </span>
                    </div>
                    <div class="clear">
                        <h3 class="m-a-0 text-lg"><a href>{{ $TotalVisitors }}</a></h3>
                        <small class="text-muted">{{ __('backend.visitors') }}</small>
                    </div>
                </div>
                <div class="box-color p-a-3 warn">
                    <div class="pull-right m-l">
            <span class="w-56 dker text-center rounded">
              <i class="text-lg material-icons">&#xe54b;</i>
            </span>
                    </div>
                    <div class="clear">
                        <h3 class="m-a-0 text-lg"><a href>{{ $TotalPages }}</a></h3>
                        <small class="text-muted">{{ __('backend.pageViews') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3>{{ __('backend.diagram') }}</h3>
                        <small>{{ __('backend.barDiagram') }}</small>
                    </div>
                    <div class="box-body">
                        <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
              [
                {
                  data: [
                  <?php
                        $ii = 1;
                        ?>
                        @foreach($AnalyticsValues as $id)

                        @if($ii<=10)
                        @if($ii!=1)
                            ,
@endif
                        <?php
                        $i2 = 0;
                        ?>
                        @foreach($id as $key => $val)
                        <?php
                        if ($i2 == 1) {
                        ?>
                            [{{ $ii }}, {{$val}}]
                                <?php
                        }
                        $i2++;
                        ?>
                        @endforeach
                        @endif
                        <?php $ii++;?>
                        @endforeach
                            ],
                                                            bars: { show: true, barWidth: 0.25, lineWidth: 1, fillColor: { colors: [{ opacity: 0.8 }, { opacity: 1}] }, order:1 }
                                                          },
                                                          {
                                                            data: [
<?php
                        $ii = 1;
                        ?>
                        @foreach($AnalyticsValues as $id)

                        @if($ii<=10)
                        @if($ii!=1)
                            ,
@endif
                        <?php
                        $i2 = 0;
                        ?>
                        @foreach($id as $key => $val)
                        <?php
                        if ($i2 == 2) {
                        ?>
                            [{{ $ii }}, {{$val}}]
                                <?php
                        }
                        $i2++;
                        ?>
                        @endforeach
                        @endif
                        <?php $ii++;?>
                        @endforeach
                            ],
                            bars: { show: true, barWidth: 0.25, lineWidth: 1, fillColor: { colors: [{ opacity: 0.8 }, { opacity: 1}] }, order:2 }
                          }
                        ],
                        {
                          colors: ['#0cc2aa','#fcc100'],
                          series: { shadowSize: 3 },
                          xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
                          yaxis:{ show: true, font: { color: '#ccc' }},
                          grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                          tooltip: true,
                          tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
                        }
" style="height:207px">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="box m-b-0">
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th class="text-center width20">#</th>
                            <th>{{ __('backend.'.$statText) }}</th>
                            <th class="text-center">{{ __('backend.visitors') }}</th>
                            <th class="text-center">{{ __('backend.pageViews') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ii = 1;
                        ?>
                        @foreach($AnalyticsValues as $id)
                            @if($ii<=60)
                                <tr>
                                    <td class="dker text-center">{{$ii}}</td>
                                    <?php
                                    $i2 = 0;
                                    ?>
                                    @foreach($id as $key => $val)
                                        <?php
                                        if ($i2 == 0) {
                                        if (strlen($val) > 80) {
                                        $val0 = $val;
                                        $val = substr($val, 0, 80) . "..";
                                        ?>
                                        <td title="{{ $val0 }}">{{ $val }}</td>
                                        <?php
                                        }else{
                                        ?>
                                        <td>{{ $val }}</td>
                                        <?php
                                        }
                                        }else{
                                        ?>
                                        <td class="text-center">{{ $val }}</td>
                                        <?php
                                        }
                                        $i2++;
                                        ?>
                                    @endforeach
                                </tr>
                            @endif
                            <?php $ii++;?>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@push("after-scripts")
    <script src="{{ asset("assets/dashboard/js/bootstrap-daterangepicker/moment.min.js") }}"
            type="text/javascript"></script>
    <script src="{{ asset("assets/dashboard/js/bootstrap-daterangepicker/daterangepicker.js") }}"
            type="text/javascript"></script>
    <script type="text/javascript">
        var Index = function () {
            return {
                initDashboardDaterange: function () {

                    $('#dashboard-report-range').daterangepicker({
                            opens: ('{{ @Helper::currentLanguage()->left }}'),
                            startDate: '<?php echo date("d-m-Y", strtotime($daterangepicker_start)); ?>',
                            endDate: '<?php echo date("d-m-Y", strtotime($daterangepicker_end)); ?>',
                            minDate: '<?php echo $min_visitor_date; ?>',
                            maxDate: '<?php echo $max_visitor_date; ?>',
                            showDropdowns: false,
                            showWeekNumbers: false,
                            timePicker: false,
                            timePickerIncrement: 1,
                            timePicker12Hour: true,
                            ranges: {
                                '{{ __('backend.today') }}': [moment(), moment()],
                                '{{ __('backend.yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                '{{ __('backend.last7Days') }}': [moment().subtract(6, 'days'), moment()],
                                '{{ __('backend.last30Days') }}': [moment().subtract(29, 'days'), moment()],
                                '{{ __('backend.thisMonth') }}': [moment().startOf('month'), moment().endOf('month')],
                                '{{ __('backend.lastMonth') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            buttonClasses: ['btn'],
                            applyClass: 'primary',
                            cancelClass: 'default',
                            format: 'DD-MM-YYYY',
                            separator: ' {{ __('backend.applyTo') }} ',
                            locale: {
                                applyLabel: '{{ __('backend.apply') }}',
                                fromLabel: '{{ __('backend.applyFrom') }}',
                                toLabel: '{{ __('backend.applyTo') }}',
                                customRangeLabel: '{{ __('backend.customRange') }}',
                                daysOfWeek: [{!! __('backend.weekDays') !!}],
                                monthNames: [{!! __('backend.monthsNames') !!}],
                                firstDay: 1
                            }
                        },
                        function (start, end) {
                            $('#dashboard-report-range span').html(start.format('MMMM D , YYYY') + ' - ' + end.format('MMMM D , YYYY'));
                            $("#this_daterangepicker_start").val(start.format('YYYY-MM-DD'));
                            $("#this_daterangepicker_end").val(end.format('YYYY-MM-DD'));
                            $("#form_ofchangedate").submit();
                        }
                    );


                    $('#dashboard-report-range span').html("<?php echo $daterangepicker_start_text; ?>" + ' - ' + "<?php echo $daterangepicker_end_text; ?>");
                    $("#this_daterangepicker_start").val("<?php echo $daterangepicker_start; ?>");
                    $("#this_daterangepicker_end").val("<?php echo $daterangepicker_end; ?>");
                    $('#dashboard-report-range').show();
                }
            };

        }();
        jQuery(document).ready(function () {
            Index.initDashboardDaterange();
        });
    </script>
@endpush
