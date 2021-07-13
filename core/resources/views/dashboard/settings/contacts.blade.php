<div class="tab-pane {{  ( Session::get('active_tab') == 'contactsTab') ? 'active' : '' }}"
     id="tab-2">
    <div class="p-a-md"><h5><i class="material-icons">&#xe0ba;</i>
            &nbsp; {!!  __('backend.siteContactsSettings') !!}</h5></div>
    <div class="p-a-md col-md-12">
        @foreach(Helper::languagesList() as $ActiveLanguage)
            <div class="form-group">
                <label>{!!  __('backend.contactAddress') !!}
                </label> {!! @Helper::languageName($ActiveLanguage) !!}
                {!! Form::text('contact_t1_'.@$ActiveLanguage->code,$Setting->{'contact_t1_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction)) !!}
            </div>
        @endforeach
        <div class="form-group">
            <label>{!!  __('backend.contactPhone') !!}</label>
            {!! Form::text('contact_t3',$Setting->contact_t3, array('placeholder' => __('backend.contactPhone'),'class' => 'form-control', 'dir'=>'ltr')) !!}
        </div>
        <div class="form-group">
            <label>{!!  __('backend.contactFax') !!}</label>
            {!! Form::text('contact_t4',$Setting->contact_t4, array('placeholder' => __('backend.contactFax'),'class' => 'form-control', 'dir'=>'ltr')) !!}
        </div>
        <div class="form-group">
            <label>{!!  __('backend.contactMobile') !!}</label>
            {!! Form::text('contact_t5',$Setting->contact_t5, array('placeholder' => __('backend.contactMobile'),'class' => 'form-control', 'dir'=>'ltr')) !!}
        </div>
        <div class="form-group">
            <label>{!!  __('backend.contactEmail') !!}</label>
            {!! Form::text('contact_t6',$Setting->contact_t6, array('placeholder' => __('backend.contactEmail'),'class' => 'form-control', 'dir'=>'ltr')) !!}
        </div>
        @foreach(Helper::languagesList() as $ActiveLanguage)
            <div class="form-group">
                <label>{!!  __('backend.worksTime') !!}
                </label> {!! @Helper::languageName($ActiveLanguage) !!}
                {!! Form::text('contact_t7_'.@$ActiveLanguage->code,$Setting->{'contact_t7_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction)) !!}
            </div>
        @endforeach
    </div>
</div>
