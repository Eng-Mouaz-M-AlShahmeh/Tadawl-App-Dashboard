@extends('dashboard.layouts.master')
@section('title', __('backend.appREOffices'))
@section('content')

<div class="padding">
    <div class="box">
<div class="p-a-xs b-b">
    {{Form::open(['route'=>['appREOfficesSearch'],'method'=>'POST'])}}
        <div class="input-group">
            <input type="text" style="width: 85%" name="q" required value="{{ $search_word }}" class="form-control no-border no-bg" placeholder="{{ __('backend.searchAllREOffices') }}">

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
                <h3>{{ __('backend.appREOffices') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.appData') }} /
                    <a href="{{ route('appREOffices') }}">{{ __('backend.appREOffices') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{route("appREOfficesCreate")}}">
                            <i class="material-icons">&#xe02e;</i>
                            &nbsp; {{ __('backend.REOfficeNew') }}</a>
                    </li>
                </ul>
            </div>
            @if($REOffices->count() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class=" p-a text-center light ">
                            {{ __('backend.noData') }}
                        </div>
                    </div>
                </div>
            @endif

            @if($REOffices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-a-0">
                        <thead  class="dker">
                        <tr>
                            <th  class="width20 dker">
                                #
                            </th>
                            
                            <th >{{ __('backend.office_name') }}</th>
                            
                            <th class="text-center">{{ __('backend.sejel_image') }}</th>
                            
                            <th class="text-center">{{ __('backend.sejel') }}</th>
                            <th class="text-center">{{ __('backend.userPhone') }}</th>
                            
                            <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                            <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($REOffices as $REOffice)
                            <tr>
                                <td class="dker">
                                    {!! $REOffice->id  !!}
                                </td>
                                
                                
                                <td class="h6">
                                    {!! $REOffice->office_name  !!}
                                </td>
                                

                           <td class="text-center">
                             <span>       
                            @if($REOffice->sejel_image!="")
                                <img width="50" height="50" src="{{ asset('API22544445213/assets/images/offices/'.$REOffice->sejel_image) }}" class="img-fluid img-thumbnail">
                            @else
                                <img src="{{ asset('uploads/contacts/profile.jpg') }}" class="img-fluid img-thumbnail"
                                     style="opacity: 0.5">
                            @endif
                              </span>      
                                    </td>
                                    
                                    
                                    
                                    
                                    
                                <td class="text-center">
                                    {!! $REOffice->sejel  !!}
                                   </td>
                                   
                                   
                                <td class="text-center"> 
                                 <i class="fa fa-phone m-r-sm text-muted"></i>  {!! $REOffice->phone_user !!}
                                </td>
                                
                                
                                <td class="text-center">
                                    <i class="fa {{ ($REOffice->state==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                                </td>
                                <td class="text-center">
                                    
                                    <a class="btn btn-sm info"
                                       href="{{ route("appREOfficesShow",["id"=>$REOffice->id]) }}">
                                        <small><i class="material-icons">&#xe8f4;</i> {{-- __('backend.view') --}}
                                        </small>
                                    </a>
                                    
                                    
                                    <a class="btn btn-sm success"
                                       href="{{ route("appREOfficesEdit",["id"=>$REOffice->id]) }}">
                                        <small><i class="material-icons">&#xe3c9;</i> {{-- __('backend.edit') --}}
                                        </small>
                                    </a>

                                    <button class="btn btn-sm warning" data-toggle="modal"
                                            data-target="#m-{{ $REOffice->id }}" ui-toggle-class="bounce"
                                            ui-target="#animate">
                                        <small><i class="material-icons">&#xe872;</i> {{-- __('backend.delete') --}}
                                        </small>
                                    </button>


                                </td>
                            </tr>
                            <!-- .modal -->
                            <div id="m-{{ $REOffice->id }}" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog" id="animate">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                        </div>
                                        <div class="modal-body text-center p-lg">
                                            <p>
                                                {{ __('backend.confirmationDeleteMsg') }}
                                                <br>
                                                <strong>[ {!! $REOffice->office_name !!}
                                                    ]</strong>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn dark-white p-x-md"
                                                    data-dismiss="modal">{{ __('backend.no') }}</button>
                                            <a href="{{ route("appREOfficesDestroy",["id"=>$REOffice->id]) }}"
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
                                <strong>{{ $REOffices->count()  }}</strong> {{ __('backend.records') }}
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
