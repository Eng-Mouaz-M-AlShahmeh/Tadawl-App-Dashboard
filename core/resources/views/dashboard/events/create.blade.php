
<div id="mmn-new" class="modal fade"
     data-backdrop="true">
    <div class="modal-dialog" id="animate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="material-icons">&#xe02e;</i> {{ __('backend.newEvent') }}
                </h5>
            </div>
            {{Form::open(['route'=>['calendarStore'],'method'=>'POST'])}}
            <div class="modal-body p-lg">
                <div class="p-a">
                    <div class="form-group row">
                        <label for="type"
                               class="col-sm-3 form-control-label">{!!  __('backend.eventType') !!}</label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label class="ui-check ui-check-md" id="type0l">
                                    {!! Form::radio('type','0',true, array('id' => 'type0','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <strong>{!!  __('backend.eventNote') !!}</strong>
                                </label>
                                &nbsp;
                                <label class="ui-check ui-check-md text-success" id="type1l">
                                    {!! Form::radio('type','1',false, array('id' => 'type1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <strong>{!!  __('backend.eventMeeting') !!}</strong>
                                </label>
                                &nbsp;
                                <label class="ui-check ui-check-md text-danger" id="type2l">
                                    {!! Form::radio('type','2',false, array('id' => 'type2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <strong>{!!  __('backend.eventEvent') !!}</strong>
                                </label>
                                &nbsp;
                                <label class="ui-check ui-check-md text-info" id="type3l">
                                    {!! Form::radio('type','3',false, array('id' => 'type3','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <strong>{!!  __('backend.eventTask') !!}</strong>
                                </label>

                            </div>
                        </div>
                    </div>


                    <div id="date" class="form-group row">
                        <label for="title"
                               class="col-sm-3 form-control-label">{!!  __('backend.topicDate') !!}
                        </label>
                        <div class="col-sm-9">
                            <div>
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
                                    {!! Form::text('date',Helper::formatDate(date("Y-m-d")), array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="date_at" class="form-group row displayNone">
                        <label for="date_at"
                               class="col-sm-3 form-control-label">{!!  __('backend.eventAt') !!}
                        </label>
                        <div class="col-sm-9">
                            <div>
                                <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }} hh:mm A',
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
                                    {!! Form::text('date_at',Helper::formatDate(date("Y-m-d"))." ".date("h:i A"), array('placeholder' => '','class' => 'form-control','id'=>'date_at')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="from_to_time" class="displayNone">

                        <div class="form-group row">
                            <label for="time_start"
                                   class="col-sm-3 form-control-label">{!!  __('backend.eventStart') !!}
                            </label>
                            <div class="col-sm-9">
                                <div>
                                    <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }} hh:mm A',
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
                                        {!! Form::text('time_start',Helper::formatDate(date("Y-m-d"))." ".date("h:i A"), array('placeholder' => '','class' => 'form-control','id'=>'time_start')) !!}
                                        <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time_end"
                                   class="col-sm-3 form-control-label">{!!  __('backend.eventEnd') !!}
                            </label>
                            <div class="col-sm-9">
                                <div>
                                    <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }} hh:mm A',
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
                                        {!! Form::text('time_end',Helper::formatDate(date("Y-m-d"))." ".date("h:i A"), array('placeholder' => '','class' => 'form-control','id'=>'time_end')) !!}
                                        <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="from_to_date" class="displayNone">

                        <div class="form-group row">
                            <label for="date_start"
                                   class="col-sm-3 form-control-label">{!!  __('backend.eventStart2') !!}
                            </label>
                            <div class="col-sm-9">
                                <div>
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
                                        {!! Form::text('date_start',Helper::formatDate(date("Y-m-d")), array('placeholder' => '','class' => 'form-control','id'=>'date_start')) !!}
                                        <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_end"
                                   class="col-sm-3 form-control-label">{!!  __('backend.eventEnd2') !!}
                            </label>
                            <div class="col-sm-9">
                                <div>
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
                                        {!! Form::text('date_end',Helper::formatDate(date("Y-m-d")), array('placeholder' => '','class' => 'form-control','id'=>'date_end')) !!}
                                        <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title"
                               class="col-sm-3 form-control-label">{!!  __('backend.eventTitle') !!}
                        </label>
                        <div class="col-sm-9">
                            {!! Form::text('title','', array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="details"
                               class="col-sm-3 form-control-label">{!!  __('backend.eventDetails') !!}
                        </label>
                        <div class="col-sm-9">
                            {!! Form::textarea('details','', array('placeholder' => '','class' => 'form-control','id'=>'details','rows'=>'3')) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                <button type="submit"
                        class="btn btn-primary p-x-md">{!! __('backend.add') !!}</button>
            </div>
            {{Form::close()}}
        </div><!-- /.modal-content -->
    </div>
</div>
