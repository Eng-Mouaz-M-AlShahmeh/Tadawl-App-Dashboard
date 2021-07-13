<div>
    @if(count($home_links) >0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="white">
                <th class="text-center">{{__("backend.ordering") }}</th>
                <th class="text-center">{{__("backend.link") }}</th>
                <th class="text-center">{{__("backend.options") }}</th>
                </thead>
                @foreach($home_links as $key=>$home_link)
                    <tr>
                        <td class="text-center">
                            {!! Form::text('row_no_'.@$home_link->btn_id,@$home_link->btn_order, array('class' => 'form-control row_no inline')) !!}
                        </td>
                        <td class="text-center">
                            <a href="{{ @$home_link->btn_link }}" {{ (@$home_link->btn_target)?"target=\"_blank\"":"" }}
                            class="btn-sm w-100 {!! @$home_link->btn_class !!}">{!! @$home_link->{'btn_title_'. @Helper::currentLanguage()->code} !!}</a>
                        </td>
                        <td class="text-center">
                            <button type="button" onclick="setToEditLink('{{ @$home_link->btn_id }}')"
                                    class="btn btn-sm light dk text-primary" data-toggle="tooltip"
                                    data-original-title="{{__('backend.edit') }}">
                                <i class="material-icons">&#xe3c9;</i>
                            </button>
                            <button type="button" onclick="setToDelLink('{{ @$home_link->btn_id }}')"
                                    class="btn btn-sm light dk text-danger" data-toggle="tooltip"
                                    data-original-title="{{__('backend.delete') }}">
                                <small><i class="material-icons">&#xe872;</i>
                                </small>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @else
        <div class="text-muted">
            {!!__("backend.noData") !!}
        </div>
    @endif
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip({html: true, trigger: "hover"});
</script>
