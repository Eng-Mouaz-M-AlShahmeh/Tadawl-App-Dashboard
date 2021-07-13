@extends('dashboard.layouts.master')
@section('title', __('backend.visitorsAnalyticsIPInquiry'))
@push("after-styles")
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/dashboard/css/flags.css") }}"/>
@endpush
@section('content')
    <?php
    $visitor_loc_0 = "";
    $visitor_loc_1 = "";
    ?>
    <div class="padding p-b-0">
        <div class="box">
            @if($ip_code!="")
                <div class="box-header dker">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3>{{ __('backend.visitorsAnalyticsIPInquiry') }}</h3>
                            <small>
                                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                                <a href="">{{ __('backend.visitorsAnalytics') }}</a>
                            </small>
                        </div>
                        <div class="col-sm-3">
                            <div class="btn-group pull-right">
                                {{Form::open(['route'=>['visitorsSearch'],'method'=>'POST'])}}
                                <div class="input-group input-group-sm">
                                    {!! Form::text('ip',$ip_code, array('placeholder' => __('backend.ip')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                    <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="box-header dker">
                    <div class="row">
                        <div class="text-center">
                            <br>
                            <h3>{{ __('backend.visitorsAnalyticsIPInquiry') }}</h3>
                            <small>
                                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                                <a href="">{{ __('backend.visitorsAnalytics') }}</a>
                            </small>
                            <div class="btn-group p-a w-lg">
                                {{Form::open(['route'=>['visitorsSearch'],'method'=>'POST'])}}
                                <div class="input-group input-group-sm">
                                    {!! Form::text('ip',$ip_code, array('placeholder' => __('backend.ip')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                    <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($ip_code!="")
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table  table-striped b-a">
                                    <tbody>
                                    <?php
                                    $lmt = 0;
                                    ?>
                                    @foreach($AnalyticsVisitors as $AnalyticsVisitor)
                                        @if($lmt==0)
                                            <?php
                                            $visitor_loc_0 = $AnalyticsVisitor->location_cor1;
                                            $visitor_loc_1 = $AnalyticsVisitor->location_cor2;

                                            $flag = "";
                                            $country_code = strtolower($AnalyticsVisitor->country_code);
                                            if ($country_code != "unknown") {
                                                $flag = "<div class='flag flag-$country_code' style='display: inline-block'></div> ";
                                            }

                                            ?>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByCountry') }}:
                                                </td>
                                                <td>{!! $flag !!} &nbsp;{{ $AnalyticsVisitor->country }}</td>
                                            </tr>

                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByCity') }} :</td>
                                                <td>{{ $AnalyticsVisitor->city }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByRegion') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->region }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.continent') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->hostname }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.timezone') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->org }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsLastVisit') }}:
                                                </td>
                                                <td>{{ Helper::formatDate($AnalyticsVisitor->date) }}
                                                    &nbsp; {{date('h:i A', strtotime($AnalyticsVisitor->time)) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByOperatingSystem') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->os }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByBrowser') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->browser }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByScreenResolution') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->resolution }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ __('backend.visitorsAnalyticsByReachWay') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->referrer }}</td>
                                            </tr>
                                        @endif
                                        <?php
                                        $lmt++
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="ipmap" class="b-a" style="height: 460px;"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($ip_code!="")
        <div class="padding">
            <h5>{{ __('backend.activitiesHistory') }}</h5>
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-striped  b-t">
                        <thead class="dker">
                        <tr>
                            <th class="text-center">{{ __('backend.topicDate') }}</th>
                            <th>{{ __('backend.activity') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ii = 1;
                        ?>
                        <?php
                        foreach($AnalyticsVisitors as $AnalyticsVisitor){
                        foreach($AnalyticsVisitor->vPages as $page){
                        if ($ii > 100) {
                            break 2;
                        }
                        ?>
                        <tr>
                            <td class="text-center dker" style="width: 200px">
                                <small>{{Helper::formatDate($page->date)}}
                                    &nbsp; {{date('h:i A', strtotime($page->time)) }}</small>
                            </td>
                            <td class="text-info"><a href="{{$page->query}}" target="_blank">{!! $page->title !!}</a>
                            </td>
                        </tr>

                        <?php
                        $ii++;

                        }
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    @endif
@endsection
@push("after-scripts")
    <?php
    if ($visitor_loc_0 != "unknown" && $visitor_loc_1 != "unknown") {
    ?>
    <script type="text/javascript"
            src="//maps.google.com/maps/api/js?key={{ env("GOOGLE_MAPS_KEY") }}&language={{ @Helper::currentLanguage()->code }}"></script>
    <script type="text/javascript">
        function initialize() {
            var latlng = new google.maps.LatLng(<?php echo $visitor_loc_0; ?>, <?php echo $visitor_loc_1; ?>);
            var myOptions = {
                zoom: 9,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("ipmap"), myOptions);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: '<?php echo $ip_code; ?>'
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <?php
    }
    ?>
@endpush
