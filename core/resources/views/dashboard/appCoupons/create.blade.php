@extends('dashboard.layouts.master')
@section('title', __('backend.appCoupons'))
@section('content') 
 
 <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ __('backend.couponNew') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appCoupons') }}">{{ __('backend.appCoupons') }}</a> /
                    {{ __('backend.couponNew') }} 
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
                
{{Form::open(['route'=>['appCouponsStore'],'method'=>'POST', 'files' => true ])}}
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.code') }}</label>
        <div class="col-sm-9">
            {!! Form::text('code','', array('placeholder' =>'','class' => 'form-control','id'=>'code','required'=>'')) !!}
        </div>
    </div>
 
 
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.start_at') }}</label>
        <div class="col-sm-9">
             {!! Form::input('dateTime-local','start_at', date('Y-m-d\Th:m:s', strtotime('')), array('placeholder' => '','class' => 'form-control','id'=>'start_at','required'=>'')) !!}
             
        </div>
    </div>
    
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.end_at') }}</label>
        <div class="col-sm-9">
            {!! Form::input('dateTime-local','end_at', date('Y-m-d\Th:m:s', strtotime('')), array('placeholder' => '','class' => 'form-control','id'=>'end_at','required'=>'')) !!}
        </div>
    </div>
    
    
    
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.discount_ammount') }}</label>
        <div class="col-sm-9">
            {!! Form::number('discount_ammount','', array('placeholder' =>'','class' => 'form-control','id'=>'discount_ammount','required'=>'')) !!}
        </div>
    </div>
    
    
 
    
 
                                
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.discount_ratio') }}</label>
        <div class="col-sm-9">
            {!! Form::number('discount_ratio','', array('placeholder' =>'','class' => 'form-control','id'=>'discount_ratio','required'=>'')) !!}
        </div>
     </div>
     
     
     
     
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.num_of_use') }}</label>
        <div class="col-sm-9">
            {!! Form::number('num_of_use','', array('placeholder' =>'','class' => 'form-control','id'=>'num_of_use','required'=>'')) !!}
        </div>
     </div>
     
     
                            
    <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary"><i class="material-icons"> &#xe31b;</i> {!! __('backend.add') !!}</button>
        </div>
    </div>
                            
{{Form::close()}}
 


</div>


</div>
</div>
</div>

@endsection
