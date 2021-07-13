@extends('dashboard.layouts.master')
@section('title', __('backend.appCoupons'))
@section('content')

<div class="padding">
    <div class="box">
<div class="p-a-xs b-b">
    {{Form::open(['route'=>['appCouponsSearch'],'method'=>'POST'])}}
        <div class="input-group">
            <input type="text" style="width: 85%" name="q" required value="{{ $search_word }}" class="form-control no-border no-bg" placeholder="{{ __('backend.searchAllCoupons') }}">

            <button type="submit" style="padding-top: 10px;" class="input-group-addon no-border no-shadow no-bg pull-left"><i class="fa fa-search"></i>
            </button>
        </div>
    {{Form::close()}}
</div>
</div>                        
</div>                         

 <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ __('backend.appCoupons') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.appData') }} /
                    <a href="{{ route('appCoupons') }}">{{ __('backend.appCoupons') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{route("appCouponsCreate")}}">
                            <i class="material-icons">&#xe02e;</i>
                            &nbsp; {{ __('backend.couponNew') }}</a>
                    </li>
                </ul>
            </div>
            @if($Coupons->count() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center light ">
                            {{ __('backend.noData') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($Coupons->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-a-0">
                        <thead  class="dker">
                        <tr>
                            <th  class="width20 dker">
                                #
                            </th>
                            
                            <th >{{ __('backend.code') }}</th>
                            
                            <th class="text-center">{{ __('backend.start_at') }}</th>
                            <th class="text-center">{{ __('backend.end_at') }}</th>
                            
                            <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Coupons as $Coupon)
                            <tr>
                                <td class="dker">
                                    {!! $Coupon->id  !!}
                                </td>
                                
                                
                                <td class="h6">
                                    {!! $Coupon->code  !!}
                                </td>
                                

                                    
                                <td class="text-center">
                                   <i class="far fa-clock m-r-sm text-muted"></i> {!! $Coupon->start_at  !!}
                                   </td>
                                   
                                   
                                <td class="text-center"> 
                                  <i class="far fa-clock m-r-sm text-muted"></i>  {!! $Coupon->end_at !!}
                                </td>
                                
                                
                                <td class="text-center">
                                    <i class="fa {{ ($Coupon->state==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    
                                    <a class="btn btn-sm info"
                                       href="{{ route("appCouponsShow",["id"=>$Coupon->id]) }}">
                                        <small><i class="material-icons">&#xe8f4;</i> {{-- __('backend.view') --}}
                                        </small>
                                    </a>
                                    
                                    
                                    <a class="btn btn-sm success"
                                       href="{{ route("appCouponsEdit",["id"=>$Coupon->id]) }}">
                                        <small><i class="material-icons">&#xe3c9;</i> {{-- __('backend.edit') --}}
                                        </small>
                                    </a>

                                    <button class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#m-{{ $Coupon->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate">
                                        <small><i class="material-icons">&#xe872;</i> {{-- __('backend.delete') --}}
                                        </small>
                                    </button>


                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $Coupon->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {!! $Coupon->code !!}
                                                    ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <a href="{{ route("appCouponsDestroy",["id"=>$Coupon->id]) }}"
                                               class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div>
                            </div>
                            <!-- / .modal -->
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
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

                        </div>

                        <div class="col-sm-3 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">
                                <strong>{{ $Coupons->count()  }}</strong> {{ __('backend.records') }}
                            </small>
                        </div>
                    </div>
                </footer>

            @endif
        </div>
    </div>
  
@endsection

@push("after-scripts")


    
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

    </script>


@endpush
