<div
    class="tab-pane {{ ( Session::get('active_tab') == 'infoTab' || Session::get('active_tab') =="") ? 'active' : '' }}"
    id="tab-1">
    <div class="p-a-md"><h5><i class="material-icons">&#xe30c;</i>
            &nbsp; {!!  __('backend.siteInfoSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">
        @foreach(Helper::languagesList() as $ActiveLanguage)
            <div class="form-group">
                <label>{!!  __('backend.websiteTitle') !!}
                </label> {!! @Helper::languageName($ActiveLanguage) !!}
                {!! Form::text('site_title_'.@$ActiveLanguage->code,$Setting->{'site_title_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction)) !!}
            </div>
        @endforeach
        @foreach(Helper::languagesList() as $ActiveLanguage)
            <div class="form-group">
                <label>{!!  __('backend.metaDescription') !!}
                </label> {!! @Helper::languageName($ActiveLanguage) !!}
                {!! Form::textarea('site_desc_'.@$ActiveLanguage->code,$Setting->{'site_desc_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction,'rows'=>'2')) !!}
            </div>
        @endforeach
        @foreach(Helper::languagesList() as $ActiveLanguage)
            <div class="form-group">
                <label>{!!  __('backend.metaKeywords') !!}
                </label> {!! @Helper::languageName($ActiveLanguage) !!}
                {!! Form::textarea('site_keywords_'.@$ActiveLanguage->code,$Setting->{'site_keywords_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction,'rows'=>'2')) !!}
            </div>
        @endforeach
        <div class="form-group">
            <label>{!!  __('backend.websiteUrl') !!}</label>
            {!! Form::text('site_url',$Setting->site_url, array('placeholder' => 'http//:www.sitename.com/','class' => 'form-control', 'dir'=>'ltr')) !!}
        </div>
    </div>

</div>
