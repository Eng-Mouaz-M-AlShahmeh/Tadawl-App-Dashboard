@extends('dashboard.layouts.master')
@section('title', __('backend.appContactUss'))
@section('content') 
 
 <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ __('backend.ContactUssNew') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appContactUss') }}">{{ __('backend.appContactUss') }}</a> /
                    {{ __('backend.ContactUssNew') }} 
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("appContactUss")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                
{{Form::open(['route'=>['appContactUssStore'],'method'=>'POST', 'files' => true ])}}
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.name') }}</label>
        <div class="col-sm-9">
            {!! Form::text('name','', array('placeholder' =>'','class' => 'form-control','id'=>'name','required'=>'')) !!}
        </div>
    </div>
 
 
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userPhone') }}</label>
        <div class="col-sm-9">
            {!! Form::number('mobile','', array('placeholder' =>'','class' => 'form-control','id'=>'mobile','required'=>'')) !!}
        </div>
    </div>
    
    
 
                                
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.title') }}</label>
        <div class="col-sm-9">
            {!! Form::text('title','', array('placeholder' =>'','class' => 'form-control','id'=>'title','required'=>'')) !!}
        </div>
     </div>
     
     
     
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.description') }}</label>
        <div class="col-sm-9">
            {!! Form::textarea('description','', array('placeholder' =>'','class' => 'form-control', 'rows' => 5, 'id'=>'description','required'=>'')) !!}
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
