@extends('dashboard.layouts.master')
@section('title', __('backend.newsletter'))
@section('content')
    <div class="padding">
        <div class="app-body-inner">
            <div class="row-col row-col-xs">
            @include('dashboard.contacts.groups')
            <!-- column -->
                <div class="col-sm-4 col-md-3 bg b-r">
                    <div class="row-col">
                        <div class="p-a-xs b-b">
                            {{Form::open(['route'=>['contactsSearch'],'method'=>'POST'])}}
                            <div class="input-group">
                                <input type="text" style="width: 85%" name="q" required value="{{ $search_word }}"
                                       class="form-control no-border no-bg"
                                       placeholder="{{ __('backend.searchAllContacts') }}">

                                <button type="submit" style="padding-top: 10px;"
                                        class="input-group-addon no-border no-shadow no-bg pull-left"><i
                                        class="fa fa-search"></i>
                                </button>
                            </div>
                            {{Form::close()}}
                        </div>
                        <div class="row-row">
                            <div class="row-body scrollable hover">
                                <div class="row-inner">
                                    <div class="list inset">

                                        @foreach($Contacts as $Contact)

                                            <?php
                                            $active_cls = "";
                                            ?>
                                            @if(Session::has('ContactToEdit'))
                                                @if(Session::get('ContactToEdit')->id == $Contact->id)
                                                    <?php
                                                    $active_cls = "primary";
                                                    ?>
                                                @endif
                                            @endif

                                            <div class="list-item pointer {{$active_cls}}"
                                                 onclick="javascript: location.href='{{ route("contactsEdit",["id"=>$Contact->id]) }}'">
                                                <div class="list-left">
                    <span class="w-40 avatar">
                        <a href="{{ route("contactsEdit",["id"=>$Contact->id]) }}">
                            @if($Contact->photo!="")
                                <img src="{{ asset('uploads/contacts/'.$Contact->photo) }}" class="img-circle">
                            @else
                                <img src="{{ asset('uploads/contacts/profile.jpg') }}" class="img-circle"
                                     style="opacity: 0.5">
                            @endif
                        </a>
                    </span>
                                                </div>
                                                <div class="list-body">
                                                    <a href="{{ route("contactsEdit",["id"=>$Contact->id]) }}">
                                                        @if($Contact->first_name !="" || $Contact->last_name !="")
                                                            {{ $Contact->first_name }} {{ $Contact->last_name }}
                                                        @else
                                                            {{ substr($Contact->email,0, strpos($Contact->email, "@")) }}
                                                        @endif
                                                        <small class="block"><i
                                                                class="fa fa-phone m-r-sm text-muted"></i>
                                                            <span dir="ltr">
                                                                @if($Contact->phone !="")
                                                                    {{ $Contact->phone }}
                                                                @else
                                                                    {{ substr($Contact->email, strpos($Contact->email, "@")) }}
                                                                @endif
                                                            </span>
                                                        </small>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($Contacts->total() > env('BACKEND_PAGINATION'))
                            <div class="p-a b-t text-center">
                                {!! $Contacts->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /column -->

                @if(Session::has('ContactToEdit'))
                    @include('dashboard.contacts.edit')
                @else
                    @include('dashboard.contacts.create')
                @endif

            </div>
        </div>
    </div>
    <style>
        .app-footer {
            display: none;
        }
    </style>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#photo_file").change(function () {
            readURL(this);
            $('#photo_preview').css("opacity", 1);
        });
    </script>
@endpush
