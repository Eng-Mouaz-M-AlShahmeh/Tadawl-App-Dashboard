<div id="link_add" class="modal black-overlay fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="material-icons">&#xe02e;</i> {{ __('backend.addNewLink') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $Adviser = Auth::user();
            $title_var = "title_" . __('backend.boxCode');
            $title_var2 = "title_" . __('backend.boxCodeOther');
            ?>
            {{Form::open(['route'=>['customLinksStore'],'method'=>'POST','id'=>'btn_add_form'])}}
            <div class="modal-body p-lg p-b-0">
                <div class=" p-a">

                        <div class="alert alert-danger displayNone" id="btn_add_errors">
                            <ul></ul>
                        </div>
                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="form-group row">
                                    <label
                                        class="col-sm-3 form-control-label">{!!  __('backend.topicName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                    </label>
                                    <div class="col-sm-9">
                                        {!! Form::text('btn_title_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">{!!  __('backend.link') !!}
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('link','', array('dir' => 'ltr','class' => 'form-control','required'=>'')) !!}
                            </div>
                        </div>


                    <div class="form-group row">
                        <label for="target0"
                               class="col-sm-3 form-control-label">{!!  __('backend.linkTarget') !!}</label>
                        <div class="col-sm-9">
                            <div class="radio m-t-sm">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('target','0',true, array('id' => 'target0','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {!!  __('backend.linkTargetParent') !!}
                                </label>
                                &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('target','1',false, array('id' => 'target1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {!!  __('backend.linkTargetBlank') !!}
                                </label>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 form-control-label"> CSS Class
                        </label>
                        <div class="col-sm-9">
                            {!! Form::text('btn_class','btn btn-lg primary', array('dir' => 'ltr','class' => 'form-control','required'=>'')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="permission_id" value="{{ $Permissions->id }}">
                <button type="button"
                        class="btn dark-white p-x-md"
                        data-dismiss="modal">{{ __('backend.cancel') }}</button>
                <button type="submit" id="btn_add_form_submit"
                        class="btn btn-primary p-x-md">{!! __('backend.add') !!}</button>
            </div>
            {{Form::close()}}
        </div><!-- /.modal-content -->
    </div>
</div>
