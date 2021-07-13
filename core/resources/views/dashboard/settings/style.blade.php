<div class="tab-pane {{  ( Session::get('active_tab') == 'styleTab') ? 'active' : '' }}" id="tab-5">
    <div class="p-a-md"><h5><i class="material-icons">&#xe41d;</i>
            &nbsp; {!!  __('backend.styleSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">

        <div class="form-group row">
            @foreach(Helper::languagesList() as $ActiveLanguage)
                <div class="col-sm-6 m-b-2">
                    <label>{!!  __('backend.siteLogo') !!}</label> {!! @Helper::languageName($ActiveLanguage) !!}
                    @if($Setting->{'style_logo_'.@$ActiveLanguage->code}!="")
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12 box p-a-xs text-center">
                                    <a target="_blank"
                                       href="{{ asset('uploads/settings/'.$Setting->{'style_logo_'.@$ActiveLanguage->code}) }}"><img
                                            src="{{ asset('uploads/settings/'.$Setting->{'style_logo_'.@$ActiveLanguage->code}) }}"
                                            class="img-responsive" id="style_logo_{{ @$ActiveLanguage->code }}_prv"
                                            style="width: auto;max-width: 260px;max-height: 60px">
                                        <br>
                                        <small>{{ $Setting->{'style_logo_'.@$ActiveLanguage->code} }}</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12 box p-a-xs text-center">
                                    <img
                                        src="{{ asset('uploads/settings/nologo.png') }}"
                                        class="img-responsive" id="style_logo_{{ @$ActiveLanguage->code }}_prv"
                                        style="width: auto;max-width: 260px;max-height: 60px">
                                    <br>
                                    <small>nologo.png</small>

                                </div>
                            </div>
                        </div>
                    @endif
                    {!! Form::file('style_logo_'.@$ActiveLanguage->code, array('class' => 'form-control','id'=>'style_logo_'.@$ActiveLanguage->code,'accept'=>'image/*')) !!}
                    <small>
                        <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
                        {!!  __('backend.imagesTypes') !!}
                    </small>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="style_fav">{!!  __('backend.favicon') !!}</label>
                @if($Setting->style_fav!="")
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12 box p-a-xs text-center">
                                <a target="_blank"
                                   href="{{ asset('uploads/settings/'.$Setting->style_fav) }}"><img
                                        src="{{ asset('uploads/settings/'.$Setting->style_fav) }}"
                                        class="img-responsive" id="style_fav_prv"
                                        style="max-width: 60px;height: 60px">
                                    <br>
                                    <small>{{ $Setting->style_fav }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12 box p-a-xs text-center">
                                <a target="_blank"
                                   href="{{ asset('uploads/settings/nofav.png') }}"><img
                                        src="{{ asset('uploads/settings/nofav.png') }}"
                                        class="img-responsive" id="style_fav_prv"
                                        style="max-width: 60px;height: 60px">
                                    <br>
                                    <small>nofav.png</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                {!! Form::file('style_fav', array('class' => 'form-control','id'=>'style_fav','accept'=>'image/*')) !!}
                <small>
                    <i class="material-icons">&#xe8fd;</i> ( 32x32 px ) -
                    {!!  __('backend.imagesTypes') !!}
                </small>
            </div>
            <div class="col-sm-6">
                <label for="style_apple">{!!  __('backend.appleIcon') !!}</label>
                @if($Setting->style_apple!="")
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12 box p-a-xs text-center">
                                <a target="_blank"
                                   href="{{ asset('uploads/settings/'.$Setting->style_apple) }}"><img
                                        src="{{ asset('uploads/settings/'.$Setting->style_apple) }}"
                                        class="img-responsive" id="style_apple_prv"
                                        style="width: 60px;height: 60px">
                                    <br>
                                    <small>{{ $Setting->style_apple }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12 box p-a-xs text-center">
                                <a target="_blank"
                                   href="{{ asset('uploads/settings/nofav.png') }}"><img
                                        src="{{ asset('uploads/settings/nofav.png') }}"
                                        class="img-responsive" id="style_apple_prv"
                                        style="max-width: 60px;height: 60px">
                                    <br>
                                    <small>nofav.png</small>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                {!! Form::file('style_apple', array('class' => 'form-control','id'=>'style_apple','accept'=>'image/*')) !!}
                <small>
                    <i class="material-icons">&#xe8fd;</i> ( 180x180 px ) -
                    {!!  __('backend.imagesTypes') !!}
                </small>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-sm-4">
                <label>{!!  __('backend.styleColor1') !!}</label>

                <div>
                    <div id="cp1" class="input-group colorpicker-component">
                        {!! Form::text('style_color1',$Setting->style_color1, array('placeholder' => '','class' => 'form-control','id'=>'style_color1', 'dir'=>'ltr')) !!}
                        <span class="input-group-addon" id="cpbg"><i></i></span>
                    </div>
                </div>
                <small><a href="javascript:null"
                          onclick="update_restcolor()">{!!  __('backend.restoreDefault') !!}</a>
                </small>
            </div>

            <div class="col-sm-4">
                <label>{!!  __('backend.styleColor2') !!}</label>

                <div>
                    <div id="cp2" class="input-group colorpicker-component">
                        {!! Form::text('style_color2',$Setting->style_color2, array('placeholder' => '','class' => 'form-control','id'=>'style_color2', 'dir'=>'ltr')) !!}
                        <span class="input-group-addon" id="cpbg2"><i></i></span>
                    </div>
                </div>
                <small><a href="javascript:null"
                          onclick="update_restcolor2()">{!!  __('backend.restoreDefault') !!}</a>
                </small>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-sm-4">
                <label>{{ __('backend.layoutMode') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('style_type','0',$Setting->style_type ? false : true , array('id' => 'style_type1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.wide') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('style_type','1',$Setting->style_type ? true : false , array('id' => 'style_type2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.boxed') }}
                    </label>
                </div>
            </div>

            <div class="col-sm-8"
                 id="bgtyps" {!!   (!$Setting->style_type) ? "style='display:none'":"" !!}>
                <label>{{ __('backend.backgroundStyle') }} : </label>
                <div class="radio">
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('style_bg_type','0',($Setting->style_bg_type==0) ? true : false , array('id' => 'style_bg_type1','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.colorBackground') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('style_bg_type','1',($Setting->style_bg_type==1) ? true : false , array('id' => 'style_bg_type2','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.patternsBackground') }}
                    </label>
                    &nbsp; &nbsp;
                    <label class="ui-check ui-check-md">
                        {!! Form::radio('style_bg_type','2',($Setting->style_bg_type==2) ? true : false , array('id' => 'style_bg_type3','class'=>'has-value')) !!}
                        <i class="dark-white"></i>
                        {{ __('backend.imageBackground') }}
                    </label>
                </div>
                <div class="row"
                     id="bgtclr" {!!   ($Setting->style_bg_type!=0) ? "style='display:none'":"" !!}>
                    <div class="col-sm-11">
                        <div id="cp3" class="input-group colorpicker-component">
                            {!! Form::text('style_bg_color',$Setting->style_bg_color, array('placeholder' => '','class' => 'form-control','id'=>'style_bg_color', 'dir'=>'ltr')) !!}
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                </div>

                <div class="row"
                     id="bgtptr" {!!   ($Setting->style_bg_type!=1) ? "style='display:none'":"" !!}>
                    <div>
                        @for($i=1;$i<=24;$i++)
                            <?php
                            $img_name = "p" . $i . ".png";
                            ?>
                            <div class="col-sm-3">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('style_bg_pattern',$img_name,($Setting->style_bg_pattern==$img_name) ? true : false , array('id' => 'style_bg_pattern'.$i,'class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    <img src="{{ asset('uploads/pattern/'.$img_name) }}"
                                         style="width: 40px;height: 40px;border: 2px solid #fff"
                                         alt="">
                                </label>
                            </div>
                        @endfor

                    </div>
                </div>

                <div class="row"
                     id="bgtimg" {!!   ($Setting->style_bg_type!=2) ? "style='display:none'":"" !!}>
                    <div>
                        @if($Setting->style_bg_image!="")
                            <div>
                                <div>
                                    <div class="col-sm-12 box p-a-xs text-center">
                                        <a target="_blank"
                                           href="{{ asset('uploads/settings/'.$Setting->style_bg_image) }}"><img
                                                src="{{ asset('uploads/settings/'.$Setting->style_bg_image) }}"
                                                class="img-responsive"
                                                style="max-height: 200px;width: auto">
                                            <br>
                                            <small>{{ $Setting->style_bg_image }}</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {!! Form::file('style_bg_image', array('class' => 'form-control','id'=>'style_bg_image','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i> {!!  __('backend.imagesTypes') !!}
                        </small>
                    </div>
                </div>


            </div>
        </div>
        <hr>
        <div class="form-group">
            <label>{{ __('backend.fixedHeader') }} : </label>
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_header','1',$Setting->style_header ? true : false , array('id' => 'style_header1','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.active') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_header','0',$Setting->style_header ? false : true , array('id' => 'style_header2','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.notActive') }}
                </label>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label>{{ __('backend.footerStyle') }} : </label>
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_footer','1',($Setting->style_footer ==1) ? true : false , array('id' => 'style_footer1','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.footerStyle') }} #1
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_footer','2',($Setting->style_footer ==2) ? true : false , array('id' => 'style_footer2','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.footerStyle') }} #2
                </label>
            </div>

            <label>{{ __('backend.footerStyleBg') }} : </label>
            <div class="row">
                <div class="col-sm-6">
                    @if($Setting->style_footer_bg!="")
                        <div>
                            <div>
                                <div id="footer_bg" class="col-sm-8 box p-a-xs">
                                    <a target="_blank"
                                       href="{{ asset('uploads/settings/'.$Setting->style_footer_bg) }}"><img
                                            src="{{ asset('uploads/settings/'.$Setting->style_footer_bg) }}"
                                            class="img-responsive">
                                        {{ $Setting->style_footer_bg }}
                                    </a>
                                    <br>
                                    <a onclick="document.getElementById('footer_bg').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                       class="btn btn-sm btn-default">{!!  __('backend.delete') !!}</a>
                                </div>
                                <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                    <a onclick="document.getElementById('footer_bg').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                        <i class="material-icons">
                                            &#xe166;</i> {!!  __('backend.undoDelete') !!}</a>
                                </div>

                                {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                            </div>
                        </div>

                    @endif
                    {!! Form::file('style_footer_bg', array('class' => 'form-control','id'=>'style_footer_bg','accept'=>'image/*')) !!}
                    <small>
                        <i class="material-icons">&#xe8fd;</i>( 260x60 px ) -
                        {!!  __('backend.imagesTypes') !!}
                    </small>
                </div>
            </div>

        </div>
        <hr>
        <div class="form-group">
            <label>{{ __('backend.newsletterSubscribe') }} : </label>
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_subscribe','1',$Setting->style_subscribe ? true : false , array('id' => 'style_subscribe1','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.active') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_subscribe','0',$Setting->style_subscribe ? false : true , array('id' => 'style_subscribe2','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.notActive') }}
                </label>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label>{{ __('backend.preLoad') }} : </label>
            <div class="radio">
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_preload','1',$Setting->style_preload ? true : false , array('id' => 'style_preload1','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.active') }}
                </label>
                &nbsp; &nbsp;
                <label class="ui-check ui-check-md">
                    {!! Form::radio('style_preload','0',$Setting->style_preload ? false : true , array('id' => 'style_preload2','class'=>'has-value')) !!}
                    <i class="dark-white"></i>
                    {{ __('backend.notActive') }}
                </label>
            </div>
        </div>
    </div>
</div>
