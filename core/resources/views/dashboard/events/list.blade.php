@extends('dashboard.layouts.master')
@section('title', __('backend.calendar'))
@section('content')

    @include('dashboard.events.edit')
    @include('dashboard.events.create')

    <!-- Clear ALL modal -->
    <div id="m-deleteAll" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        {{ __('backend.eventClear') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal" data-toggle="modal"
                            data-target="#mmn-edit" ui-toggle-class="bounce"
                            ui-target="#animate">{{ __('backend.no') }}</button>
                    <a href="{{ route("calendarUpdateAll") }}"
                       class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

    <div class="padding">
        <div class="row m-b">
            <div class="col-sm-4 m-b-sm">
                <button type="button" class="btn btn-sm primary" id="btnNew" data-toggle="modal"
                        data-target="#mmn-new"
                        ui-toggle-class="bounce"
                        ui-target="#animate"><i class="material-icons">
                        &#xe02e;</i> {{ __('backend.newEvent') }}</button>
                <button type="button" id="btnEdit" data-toggle="modal" class="displayNone"
                        data-target="#mmn-edit"
                        ui-toggle-class="bounce"
                        ui-target="#animate">{{ __('backend.edit') }}</button>

            </div>
            <div class="col-sm-8 text-sm-right">
                <div class="btn-group m-l-xs">
                    <button class="btn btn-sm white" id="todayview">{{ __('backend.eventToday') }}</button>
                    <button class="btn btn-sm white" id="dayview">{{ __('backend.eventDay') }}</button>
                    <button class="btn btn-sm white" id="weekview">{{ __('backend.eventWeek') }}</button>
                    <button class="btn btn-sm white" id="monthview">{{ __('backend.eventMonth') }}</button>
                </div>
            </div>
        </div>
        <div class="fullcalendar" ui-jp="fullCalendar" ui-options="{
        header: {
          left: '{{ ( @Helper::currentLanguage()->direction=="rtl")?"next":"prev" }}',
          center: 'title',
          right: '{{ ( @Helper::currentLanguage()->direction=="rtl")?"prev":"next" }}'
        },
        defaultDate: '{{ $DefaultDate }}',
        editable: true,
        eventLimit: false,
        firstDay: {{ env("FIRST_DAY_OF_WEEK",0) }},
        events: [
        @foreach($Events as $Event)
        @if($Event->type ==3)
            {
          id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d', strtotime($Event->start_date)) }}',
                  end: '{{ date('Y-m-d', strtotime($Event->end_date)) }}',
                  className: ['info']
                },
        @elseif($Event->type ==2)
            {
          id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d H:i:s', strtotime($Event->start_date)) }}',
                  end: '{{ date('Y-m-d H:i:s', strtotime($Event->end_date)) }}',
                  className: ['danger']
                },
        @elseif($Event->type ==1)
            {
          id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d H:i:s', strtotime($Event->start_date)) }}',
                  className: ['green']
                },
        @else
            {
          id: {!! $Event->id !!},
                  title: '{!! $Event->title !!}',
                  url: '{{ route("calendarEdit",["id"=>$Event->id]) }}',
                  start: '{{ date('Y-m-d', strtotime($Event->start_date)) }}',
                  className: ['white']
                },
        @endif

        @endforeach
            ],

    eventResize: function(event, delta, revertFunc) {
        if (!confirm('is this okay?')) {
        revertFunc();
        }else{
            $(document).ready(function(){
                $.ajax({
                url: '{{ asset(env('BACKEND_PATH')."/calendar/") }}/' + event.id + '/extend',
                        type: 'post',
                        data: {'started_on': event.start.format(),'ended_on':event.end.format(),'_token':'{{ csrf_token() }}'},
                        success: function(data){

                            }
                        });
                    });
                }
            },
        dayClick:  function(date, jsEvent, view) {
            var thisdate = new Date(date).getFullYear() + '-' + ('0'+(new Date(date).getMonth()+1)).slice(-2)  + '-' + ('0'+(new Date(date).getDate())).slice(-2);
            $('#mmn-new #date').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}'));
            $('#mmn-new #date_start').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}'));
            $('#mmn-new #date_end').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}'));
            $('#mmn-new #date_at').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}') + ' {{ date("h:i A") }}');
            $('#mmn-new #time_start').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}') + ' {{ date("h:i A") }}');
            $('#mmn-new #time_end').val(js_fd(thisdate, '{{ Helper::jsDateFormat() }}') + ' {{ date("h:i A") }}');
            $('#mmn-new').modal();
        },
            eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {
                if (!confirm('is this okay?')) {
                revertFunc();
                }else{
                     $(document).ready(function(){
                        $.ajax({
                        url: '{{ asset(env('BACKEND_PATH')."/calendar/") }}/' + event.id + '/extend',
                        type: 'post',
                        data: {'started_on': event.start.format(),'_token':'{{ csrf_token() }}'},
                        success: function(data){

                            }
                        });
                    });
                }
            }

        }">
        </div>
        <br>
        <small class="pull-right">{{ __('backend.eventTotal') }} : ( {{ count($Events) }} )</small>

        <small><a data-dismiss="modal" data-toggle="modal"
                  data-target="#m-deleteAll" ui-toggle-class="bounce"
                  ui-target="#animate">{{ __('backend.eventClear') }}</a></small>
    </div>
@endsection
@push("after-scripts")

    <script type="text/javascript">
        $(document).ready(function () {
            $("#type0l").click(function () {
                $('#date').show();
                $('#date_at').hide();
                $('#from_to_time').hide();
                $('#from_to_date').hide();
            });
            $("#type1l").click(function () {
                $('#date').hide();
                $('#date_at').show();
                $('#from_to_time').hide();
                $('#from_to_date').hide();
            });
            $("#type2l").click(function () {
                $('#date').hide();
                $('#date_at').hide();
                $('#from_to_time').show();
                $('#from_to_date').hide();
            });
            $("#type3l").click(function () {
                $('#date').hide();
                $('#date_at').hide();
                $('#from_to_time').hide();
                $('#from_to_date').show();
            });
            @if($EStatus=="edit")
            $("#btnEdit").click();
            @endif

            @if($EStatus=="new")
            $(document).ready(function () {
                $("#btnNew").click();
            });
            @endif
            $("#etype0l").click(function () {
                $('#e_date').show();
                $('#e_date_at').hide();
                $('#e_from_to_time').hide();
                $('#e_from_to_date').hide();
            });
            $("#etype1l").click(function () {
                $('#e_date').hide();
                $('#e_date_at').show();
                $('#e_from_to_time').hide();
                $('#e_from_to_date').hide();
            });
            $("#etype2l").click(function () {
                $('#e_date').hide();
                $('#e_date_at').hide();
                $('#e_from_to_time').show();
                $('#e_from_to_date').hide();
            });
            $("#etype3l").click(function () {
                $('#e_date').hide();
                $('#e_date_at').hide();
                $('#e_from_to_time').hide();
                $('#e_from_to_date').show();
            });
        });

        function js_fd(date, format) {

            var arr = date.split("-");
            var dd = arr[2];
            var mm = arr[1];
            var yyyy = arr[0];

            var final_date = format;
            final_date = final_date.replace("MM", mm);
            final_date = final_date.replace("DD", dd);
            final_date = final_date.replace("YYYY", yyyy);
            return final_date;
        }
    </script>
@endpush
