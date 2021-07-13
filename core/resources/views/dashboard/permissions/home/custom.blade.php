{{Form::open(['route'=>['permissionsHomePageUpdate',$Permissions->id],'method'=>'POST'])}}
<div class="form-group row m-t">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <label>{{ __('backend.customHomeSettings') }} : </label>
        <br>
        <label class="ui-check ui-check-md">
            {!! Form::radio('home_status','0',$Permissions->home_status ? false : true , array('id' => 'home_status2','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{ __('backend.defaultPage') }}
        </label>
        &nbsp; &nbsp;
        <label class="ui-check ui-check-md">
            {!! Form::radio('home_status','1',$Permissions->home_status ? true : false , array('id' => 'home_status1','class'=>'has-value')) !!}
            <i class="dark-white"></i>
            {{ __('backend.customPage') }}
        </label>

    </div>
</div>

<div id="home_details_div" {!!  ( !$Permissions->home_status) ? "style='display:none'":"" !!}>
    @foreach(Helper::languagesList() as $ActiveLanguage)
        @if($ActiveLanguage->box_status)
            <div class="form-group row">
                <label
                    class="col-sm-2 form-control-label">{!!  __('backend.welcomeDetails') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                </label>
                <div class="col-sm-10">
                    <div class="box p-a-xs">
                        {!! Form::textarea('home_details_'.@$ActiveLanguage->code,$Permissions->{'home_details_'.@$ActiveLanguage->code}, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote_'.@$ActiveLanguage->code, 'dir'=>@$ActiveLanguage->direction,'ui-options'=>'{height: 200,callbacks: {
    onImageUpload: function(files, editor, welEditable) {
    sendFile(files[0], editor, welEditable,"'.@$ActiveLanguage->code.'");
    }
    }}')) !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <br>

    <div class="form-group row">
        <div class="col-sm-2">
            <label
                class="form-control-label">{!!  __('backend.welcomeLinks') !!}
            </label>
            <br>
            <button type="button" class="btn btn-sm primary w-100" data-toggle="modal" data-target="#link_add"><i
                    class="material-icons">&#xe02e;</i>
                &nbsp; {{ __('backend.addNewLink') }}</button>
        </div>
        <div class="col-sm-10">
            <div class="p-a b-a m-t" id="buttons_list">
                <div class="text-center">
                    <img class="m-b-1"
                         src="{{ asset('assets/dashboard/images/loading.gif') }}"
                         style="height: 35px;"/>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row m-t-md">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary  m-t"><i class="material-icons">
                &#xe31b;</i> {!! __('backend.update') !!}</button>
        <a href="{{route("users")}}"
           class="btn btn-default m-t"><i class="material-icons">
                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
    </div>
</div>
{{Form::close()}}
@include('dashboard.permissions.home.links.create')
<div id="btns-delete" class="modal fade" data-backdrop="true">
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
                <button type="button" id="btns_delete_btn" row-id=""
                        class="btn danger p-x-md"
                        data-dismiss="modal">{{ __('backend.yes') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<div id="link_edit" class="modal black-overlay fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{Form::open(['route'=>['customLinksUpdate'],'method'=>'POST','id'=>'btn_update_form'])}}

            <div class="modal-header">
                <h5 class="modal-title"><i
                        class="fa fa-edit"></i> {{ __('backend.editLink') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-lg p-a">

                <div class="alert alert-danger displayNone" id="btn_edit_errors">
                    <ul></ul>
                </div>
                <div id="buttons_edit_details">
                    <div class="text-center">
                        <img class="m-b-1"
                             src="{{ asset('assets/dashboard/images/loading.gif') }}"
                             style="height: 35px;"/>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn dark-white p-x-md"
                        data-dismiss="modal">{!! __('backend.cancel') !!}
                </button>
                <button type="submit" id="link_update_submit" class="btn info p-x-md"><i
                        class="material-icons">&#xe31b;</i> {!! __('backend.save') !!}
                </button>
            </div>
            {{Form::close()}}
        </div><!-- /.modal-content -->
    </div>
</div>
