@extends('dashboard.layouts.master')
@section('title', __('backend.appCoupons'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editCoupon') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appCoupons') }}">{{ __('backend.appCoupons') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("appCoupons")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['appCouponsUpdate',$Coupon->id],'method'=>'POST', 'files' => true])}}

                <div class="form-group row">
                    <label for="code"
                           class="col-sm-2 form-control-label">{!!  __('backend.code') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('code',$Coupon->code, array('placeholder' => '','class' => 'form-control','id'=>'code','required'=>'')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="start_at"
                           class="col-sm-2 form-control-label">{!!  __('backend.start_at') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::input('dateTime-local','start_at', date('Y-m-d\Th:m:s',  strtotime($Coupon->start_at)), array('placeholder' => '','class' => 'form-control','id'=>'start_at','required'=>'')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="end_at"
                           class="col-sm-2 form-control-label">{!!  __('backend.end_at') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::input('dateTime-local','end_at', date('Y-m-d\Th:m:s',  strtotime($Coupon->end_at)), array('placeholder' => '','class' => 'form-control','id'=>'end_at','required'=>'')) !!}
                    </div>
                </div>
                

 
                <div class="form-group row">
                    <label for="discount_ammount"
                           class="col-sm-2 form-control-label">{!!  __('backend.discount_ammount') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('discount_ammount',$Coupon->discount_ammount, array('placeholder' => '','class' => 'form-control','id'=>'discount_ammount','required'=>'')) !!}
                    </div>
                </div>
                
                
                 
                <div class="form-group row">
                    <label for="discount_ratio"
                           class="col-sm-2 form-control-label">{!!  __('backend.discount_ratio') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('discount_ratio',$Coupon->discount_ratio, array('placeholder' => '','class' => 'form-control','id'=>'discount_ratio','required'=>'')) !!}
                    </div>
                </div>
             
             
             
             <div class="form-group row">
                    <label for="num_of_use"
                           class="col-sm-2 form-control-label">{!!  __('backend.num_of_use') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('num_of_use',$Coupon->num_of_use, array('placeholder' => '','class' => 'form-control','id'=>'num_of_use','required'=>'')) !!}
                    </div>
                </div>
                
                



                    <div class="form-group row">
                        <label for="state" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('state','1',($Coupon->state==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('state','0',($Coupon->state==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{route("appCoupons")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
