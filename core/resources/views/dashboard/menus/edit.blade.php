@extends('dashboard.layouts.master')
@section('title', __('backend.siteMenus'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editSection') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.settings') }}</a> /
                    <a href="">{{ __('backend.siteMenus') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route("menus",["ParentMenuId"=>$ParentMenuId])  }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['menusUpdate',$Menus->id],'method'=>'POST', 'files' => true])}}
                {!! Form::hidden('ParentMenuId',$ParentMenuId) !!}


                <div class="form-group row">
                    <label for="father_id"
                           class="col-sm-3 form-control-label">{!!  __('backend.fatherSection') !!} </label>
                    <div class="col-sm-9">
                        <select name="father_id" id="father_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  __('backend.sectionNoFather') !!} - -
                            </option>
                            <?php
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            ?>
                            @foreach ($FatherMenus as $FatherMenu)
                                <?php
                                if ($FatherMenu->$title_var != "") {
                                    $title = $FatherMenu->$title_var;
                                } else {
                                    $title = $FatherMenu->$title_var2;
                                }
                                ?>
                                <option
                                    value="{{ $FatherMenu->id  }}" {{ ($FatherMenu->id == $Menus->father_id) ? "selected='selected'":""  }}>{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @foreach(Helper::languagesList() as $ActiveLanguage)
                    @if($ActiveLanguage->box_status)
                        <div class="form-group row">
                            <label
                                class="col-sm-3 form-control-label">{!!  __('backend.bannerTitle') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('title_'.@$ActiveLanguage->code,$Menus->{'title_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-3 form-control-label">{!!  __('backend.linkType') !!}</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','0',($Menus->type==0) ? true : false, array('id' => 'status1','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.linkType1') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','1',($Menus->type==1) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="block";document.getElementById("cat_div").style.display="none"')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.linkType2') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','2',($Menus->type==2) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.linkType3') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','3',($Menus->type==3) ? true : false, array('id' => 'status2','class'=>'has-value','onclick'=>'document.getElementById("link_div").style.display="none";document.getElementById("cat_div").style.display="block"')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.linkType4') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div id="link_div" class="form-group row" style="{{ ($Menus->type ==1)? "":"display: none" }}">
                    <label for="link"
                           class="col-sm-3 form-control-label">{!!  __('backend.linkURL') !!}
                    </label>
                    <div class="col-sm-9">
                        {!! Form::text('link',$Menus->link, array('placeholder' => '','class' => 'form-control', 'dir'=>'ltr')) !!}
                    </div>
                </div>
                <div id="cat_div" class="form-group row" style="{{ ($Menus->type <2)? "display: none":"" }}">
                    <label for="link"
                           class="col-sm-3 form-control-label">{!!  __('backend.linkSection') !!}
                    </label>
                    <div class="col-sm-9">
                        <select name="cat_id" id="cat_id" class="form-control c-select">
                            <option value="{{$ParentMenuId}}">- - {!!  __('backend.linkSection') !!} - -
                            </option>
                            <?php
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            ?>
                            @foreach ($GeneralWebmasterSections as $WSection)
                                @if($WSection->type !=4)
                                    <?php
                                    if ($WSection->$title_var != "") {
                                        $WSectionTitle = $WSection->$title_var;
                                    } else {
                                        $WSectionTitle = $WSection->$title_var2;
                                    }
                                    ?>
                                    <option
                                        value="{{ $WSection->id  }}" {{ ($WSection->id == $Menus->cat_id) ? "selected='selected'":""  }}>{!!  $WSectionTitle !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-3 form-control-label">{!!  __('backend.status') !!}</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','1',($Menus->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.active') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','0',($Menus->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.notActive') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row m-t-md">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{ route("menus",["ParentMenuId"=>$ParentMenuId])  }}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
