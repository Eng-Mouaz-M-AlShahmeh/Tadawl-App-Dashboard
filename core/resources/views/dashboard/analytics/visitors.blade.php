@extends('dashboard.layouts.master')
@section('title', __('backend.visitorsAnalyticsVisitorsHistory'))
@push("after-styles")
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/dashboard/css/flags.css") }}"/>
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.visitorsAnalyticsVisitorsHistory') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.visitorsAnalytics') }}</a>
                </small>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered m-a-0">
                    <thead class="dker">
                    <tr>
                        <th class="text-center">{{ __('backend.topicDate') }}</th>
                        <th class="text-center">{{ __('backend.ip') }}</th>
                        <th class="text-center">{{ __('backend.visitorsAnalyticsByCity') }}</th>
                        <th class="text-center">{{ __('backend.visitorsAnalyticsByCountry') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ii = 1;
                    ?>
                    @foreach($AnalyticsVisitors as $Analytic)
                        <tr>
                            <td class="text-center">
                                <small>{{Helper::formatDate($Analytic->date)}}
                                    &nbsp; {{date('h:i A', strtotime($Analytic->time)) }}</small>
                            </td>
                            <td class="text-center dker text-info"><a
                                    href="{{route("visitorsIP",$Analytic->ip)}}">{{$Analytic->ip}}</a></td>
                            <td class="text-center">{{$Analytic->city}}</td>
                            <?php
                            $flag = "";
                            $country_code = strtolower($Analytic->country_code);
                            if ($country_code != "unknown") {
                                $flag = "<div class='flag flag-$country_code' style='display: inline-block'></div> ";
                            }
                            ?>
                            <td class="text-center">{!! $flag !!} &nbsp;{{$Analytic->country}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    {!! $AnalyticsVisitors->links() !!}
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
