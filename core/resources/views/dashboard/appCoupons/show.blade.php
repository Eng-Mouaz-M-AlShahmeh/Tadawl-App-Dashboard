@extends('dashboard.layouts.master')
@section('title', __('backend.appCoupons'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe241;</i> {{ __('backend.viewDetails') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appCoupons') }}">{{ __('backend.appCoupons') }}</a> /
                    {{ __('backend.viewDetails') }}
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
                <div class="form-group row">
                    <label for="code"
                           class="col-sm-2 form-control-label">{!!  __('backend.code') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('code',$Coupon->code, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'code')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="start_at"
                           class="col-sm-2 form-control-label">{!!  __('backend.start_at') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('start_at',$Coupon->start_at, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'start_at')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="end_at"
                           class="col-sm-2 form-control-label">{!!  __('backend.end_at') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('end_at',$Coupon->end_at, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'end_at')) !!}
                    </div>
                </div>
                
                

                <div class="form-group row">
                    <label for="discount_ammount"
                           class="col-sm-2 form-control-label">{!!  __('backend.discount_ammount') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('discount_ammount',$Coupon->discount_ammount, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'discount_ammount')) !!}
                    </div>
                </div>
                
                
                 <div class="form-group row">
                    <label for="discount_ratio"
                           class="col-sm-2 form-control-label">{!!  __('backend.discount_ratio') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('discount_ratio',$Coupon->discount_ratio, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'discount_ratio')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="num_of_use"
                           class="col-sm-2 form-control-label">{!!  __('backend.num_of_use') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('num_of_use',$Coupon->num_of_use, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'num_of_use')) !!}
                    </div>
                </div>
                


                
            

                    <div class="form-group row">
                        <label for="state" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            
                               <i class="fa {{ ($Coupon->state==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                           
                        </div>
                    </div>
                    
                    
                    


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">

                        <a href="{{route("appCoupons")}}"
                           class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.returnTo') !!}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
