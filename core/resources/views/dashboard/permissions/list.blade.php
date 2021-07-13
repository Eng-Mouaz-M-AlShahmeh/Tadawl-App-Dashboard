<div class="padding">
    <div class="box">


        <div class="box-header dker">
            <h3>{{ __('backend.permissions') }}</h3>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="">{{ __('backend.settings') }}</a>
            </small>
        </div>
        @if(count($Permissions) >0)
            <div class="row p-a pull-right" style="margin-top: -70px;">
                <div class="col-sm-12">
                    <a class="btn btn-fw danger" href="{{route("permissionsCreate")}}">
                        <i class="material-icons">&#xe03b;</i>
                        &nbsp; {{ __('backend.newPermissions') }}
                    </a>
                </div>
            </div>
        @endif

        @if(count($Permissions)  == 0)
            <div class="row p-a">
                <div class="col-sm-12">
                    <div class=" p-a text-center ">
                        {{ __('backend.noData') }}
                        <br>
                        <br>
                        <a class="btn btn-fw primary" href="{{route("permissionsCreate")}}">
                            <i class="material-icons">&#xe03b;</i>
                            &nbsp; {{ __('backend.newPermissions') }}
                        </a>

                    </div>
                </div>
            </div>
        @endif

        @if(count($Permissions) > 0)
            <div class="table-responsive">
                <table class="table table-bordered m-a-0">
                    <thead class="dker">
                    <tr>
                        <th>{{ __('backend.title') }}</th>
                        <th>{{ __('backend.permissions') }}</th>
                        <th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
                        <th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($Permissions as $Permission)
                        <tr>
                            <td class="h6">
                                {!! $Permission->name   !!}</td>
                            <td>
                                <small>
                                    <small>
                                        @if($Permission->add_status==1)
                                            <i class="fa fa-check text-success inline"></i> {{ __('backend.perAdd') }}
                                            &nbsp;
                                        @endif
                                        @if($Permission->edit_status==1)
                                            <i class="fa fa-check text-success inline"></i> {{ __('backend.perEdit') }}
                                            &nbsp;
                                        @endif
                                        @if($Permission->delete_status==1)
                                            <i class="fa fa-check text-success inline"></i> {{ __('backend.perDelete') }}
                                            &nbsp;
                                        @endif

                                        @if($Permission->add_status==0 && $Permission->edit_status==0 && $Permission->delete_status==0)
                                            {{ __('backend.viewOnly') }}
                                            &nbsp;
                                        @endif

                                        <br>
                                        @if($Permission->analytics_status==1)
                                            {{ __('backend.visitorsAnalytics') }},
                                        @endif
                                        @if($Permission->newsletter_status==1)
                                            {{ __('backend.newsletter') }},
                                        @endif
                                        @if($Permission->inbox_status==1)
                                            {{ __('backend.siteInbox') }},
                                        @endif
                                        @if($Permission->calendar_status==1)
                                            {{ __('backend.calendar') }},
                                        @endif
                                        @if($Permission->banners_status==1)
                                            {{ __('backend.adsBanners') }},
                                        @endif
                                        @if($Permission->settings_status==1)
                                            {{ __('backend.generalSettings') }},
                                        @endif
                                        @if($Permission->webmaster_status==1)
                                            {{ __('backend.webmasterTools') }},
                                        @endif

                                        <br>
                                        <?php $i = 0; ?>
                                        @foreach($GeneralWebmasterSections as $WebmasterSection)
                                            <?php
                                            $data_sections_arr = explode(",", $Permission->data_sections);
                                            ?>
                                            @if(in_array($WebmasterSection->id,$data_sections_arr) && $i!=0)
                                                ,
                                            @endif
                                            {!! (in_array($WebmasterSection->id,$data_sections_arr)) ? __('backend.'.$WebmasterSection->name):"" !!}

                                            <?php $i++; ?>
                                        @endforeach
                                    </small>
                                </small>

                            </td>
                            <td class="text-center">
                                <i class="fa {{ ($Permission->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm success"
                                   href="{{ route("permissionsEdit",["id"=>$Permission->id]) }}">
                                    <small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                    </small>
                                </a>

                                <button class="btn btn-sm danger" data-toggle="modal"
                                        data-target="#p-{{ $Permission->id }}" ui-toggle-class="bounce"
                                        ui-target="#animate">
                                    <small><i class="material-icons">&#xe872;</i> {{ __('backend.delete') }}
                                    </small>
                                </button>


                            </td>
                        </tr>
                        <!-- .modal -->
                        <div id="p-{{ $Permission->id }}" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog" id="animate">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                                    </div>
                                    <div class="modal-body text-center p-lg">
                                        <p>
                                            {{ __('backend.confirmationDeleteMsg') }}
                                            <br>
                                            <strong>[ {{ $Permission->name }} ]</strong>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn dark-white p-x-md"
                                                data-dismiss="modal">{{ __('backend.no') }}</button>
                                        <a href="{{ route("permissionsDestroy",["id"=>$Permission->id]) }}"
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

        @endif
    </div>
</div>
