@extends('frontEnd.layout')

@section('content')

    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route("Home") }}"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>
                        </li>
                        @if(@$WebmasterSection!="none")
                            <?php
                            $cf_title_var = "title_" . @Helper::currentLanguage()->code;
                            $cf_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            if (@$WebmasterSection->$title_var != "") {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var;
                            } else {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var2;
                            }
                            ?>
                            <li class="active">{!! $WebmasterSectionTitle !!}</li>
                        @elseif(@$search_word!="")
                            <li class="active">{{ @$search_word }}</li>
                        @else
                            <li class="active">{{ $User->name }}</li>
                        @endif
                        @if($CurrentCategory!="none")
                            @if(!empty($CurrentCategory))
                                <?php
                                $category_title_var = "title_" . @Helper::currentLanguage()->code;
                                ?>
                                <li class="active"><i
                                        class="icon-angle-right"></i>{{ $CurrentCategory->$category_title_var }}
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">

            @foreach($WebmasterSection->customFields as $customField)
                @if($customField->in_statics && ($customField->type==6 || $customField->type==7))
                    <?php
                    $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                    $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                    if ($customField->$cf_details_var != "") {
                        $cf_details = $customField->$cf_details_var;
                    } else {
                        $cf_details = $customField->$cf_details_var2;
                    }
                    $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                    $heigth = count($cf_details_lines) * 12;
                    if ($heigth < 200) {
                        $heigth = 200;
                    }
                    ?>
                    <div id="canvas-holder-{{ $customField->id }}"
                         style="overflow: auto;border: 1px solid #ddd;margin-bottom: 30px;background: #f9f9f9;padding: 20px">
                        <span class="text-muted">{!! $customField->$title_var !!}</span>
                        <canvas id="chart-area-{{ $customField->id }}" width="1000" height="{{ $heigth }}"
                                style="margin: 0 auto"></canvas>
                    </div>
                @endif
            @endforeach
            <div class="row">
                <div class="col-lg-{{(count($Categories)>0)? "8":"12"}}">
                    @if($Topics->total() == 0)
                        <div class="alert alert-warning">
                            <i class="fa fa-info"></i> &nbsp; {{ __('frontend.noData') }}
                        </div>
                    @else
                        @if($Topics->total() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="light">
                                    @if($WebmasterSection->title_status)
                                        <th class="text-left">{{ __('backend.topicName') }}</th>
                                    @endif
                                    @foreach($WebmasterSection->customFields as $customField)
                                        <?php
                                        // check permission
                                        $view_permission_groups = [];
                                        if ($customField->view_permission_groups != "") {
                                            $view_permission_groups = explode(",", $customField->view_permission_groups);
                                        }
                                        if (in_array(@Auth::user()->permissions_id, $view_permission_groups) || in_array(0, $view_permission_groups) || $customField->view_permission_groups == "") {
                                        // have permission & continue
                                        ?>
                                        @if ($customField->in_listing)
                                            @if ($customField->lang_code == "all" || $customField->lang_code == @Helper::currentLanguage()->code)
                                                <?php
                                                if ($customField->$cf_title_var != "") {
                                                    $cf_title = $customField->$cf_title_var;
                                                } else {
                                                    $cf_title = $customField->$cf_title_var2;
                                                }
                                                ?>
                                                <th class="text-center">{{ $cf_title }}</th>
                                            @endif
                                        @endif
                                        <?php
                                        }
                                        ?>
                                    @endforeach
                                    @if($WebmasterSection->date_status)
                                        <th class="text-center">{{ __('backend.topicDate') }}</th>
                                    @endif
                                    @if($WebmasterSection->expire_date_status)
                                        <th class="text-center">{{ __('backend.expireDate') }}</th>
                                    @endif
                                    <th class="text-center">{{ __('backend.viewDetails') }}</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $title_var = "title_" . @Helper::currentLanguage()->code;
                                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                    $details_var = "details_" . @Helper::currentLanguage()->code;
                                    $details_var2 = "details_" . env('DEFAULT_LANGUAGE');
                                    $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
                                    $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
                                    $i = 0;
                                    ?>
                                    @foreach($Topics as $Topic)
                                        <?php
                                        if ($Topic->$title_var != "") {
                                            $title = $Topic->$title_var;
                                        } else {
                                            $title = $Topic->$title_var2;
                                        }
                                        if ($Topic->$details_var != "") {
                                            $details = $details_var;
                                        } else {
                                            $details = $details_var2;
                                        }
                                        $section = "";
                                        try {
                                            if ($Topic->section->$title_var != "") {
                                                $section = $Topic->section->$title_var;
                                            } else {
                                                $section = $Topic->section->$title_var2;
                                            }
                                        } catch (Exception $e) {
                                            $section = "";
                                        }

                                        $topic_link_url = Helper::topicURL($Topic->id);
                                        ?>

                                        <?php
                                        $i++;
                                        ?>
                                        <tr>
                                            @if($WebmasterSection->title_status)
                                                <td>{!! $title !!}</td>
                                            @endif
                                            <?php
                                            foreach (@$Topic->webmasterSection->customFields as $customField) {

                                            // check permission
                                            $view_permission_groups = [];
                                            if ($customField->view_permission_groups != "") {
                                                $view_permission_groups = explode(",", $customField->view_permission_groups);
                                            }
                                            if (in_array(@Auth::user()->permissions_id, $view_permission_groups) || in_array(0, $view_permission_groups) || $customField->view_permission_groups == "") {
                                            // have permission & continue

                                            if ($customField->in_listing) {

                                            $cf_saved_val = "";
                                            $cf_saved_val_array = array();
                                            if (count($Topic->fields) > 0) {
                                                foreach ($Topic->fields as $t_field) {
                                                    if ($t_field->field_id == $customField->id) {
                                                        if ($customField->type == 7) {
                                                            // if multi check
                                                            $cf_saved_val_array = explode(", ", $t_field->field_value);
                                                        } else {
                                                            $cf_saved_val = $t_field->field_value;
                                                        }
                                                    }
                                                }
                                            }
                                            $cf_data = "";
                                            if (($customField->lang_code == "all" || $customField->lang_code == @Helper::currentLanguage()->code)) {
                                            if ($customField->type == 12) {
                                                $CF_Vimeo_id = Helper::Get_vimeo_video_id($cf_saved_val);
                                                $cf_data = "<a target='_blank' href='https://player.vimeo.com/video/$CF_Vimeo_id?title=0&amp;byline=0'><i class='fa fa-play'></i></a>";

                                            } elseif ($customField->type == 11) {
                                                $CF_Youtube_id = Helper::Get_youtube_video_id($cf_saved_val);
                                                $cf_data = "<a target='_blank' href='https://www.youtube.com/embed/$CF_Youtube_id'><i class='fa fa-play'></i></a>";

                                            } elseif ($customField->type == 10) {
                                                $cf_data = "<a target='_blank' href='" . URL::to('uploads/topics/' . $cf_saved_val) . "'><i class='fa fa-play'></i></a>";
                                            } elseif ($customField->type == 9) {
                                                $cf_data = "<a target='_blank' href='" . URL::to('uploads/topics/' . $cf_saved_val) . "'><i class='fa fa-play'></i></a>";
                                            } elseif ($customField->type == 8) {
                                                $cf_data = "<a target='_blank' href='" . URL::to('uploads/topics/' . $cf_saved_val) . "'><i class='fa fa-picture-o'></i></a>";

                                            } elseif ($customField->type == 7) {
                                                $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                                                $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                                                if ($customField->$cf_details_var != "") {
                                                    $cf_details = $customField->$cf_details_var;
                                                } else {
                                                    $cf_details = $customField->$cf_details_var2;
                                                }
                                                $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                $line_num = 1;
                                                foreach ($cf_details_lines as $cf_details_line) {
                                                    if (in_array($line_num, $cf_saved_val_array)) {
                                                        $cf_data .= "<span class=\"badge\">" . $cf_details_line . "</span> ";
                                                    }
                                                    $line_num++;
                                                }
                                            } elseif ($customField->type == 6) {
                                                $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                                                $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                                                if ($customField->$cf_details_var != "") {
                                                    $cf_details = $customField->$cf_details_var;
                                                } else {
                                                    $cf_details = $customField->$cf_details_var2;
                                                }
                                                $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                $line_num = 1;
                                                foreach ($cf_details_lines as $cf_details_line) {
                                                    if ($line_num == $cf_saved_val) {
                                                        $cf_data .= "<span class=\"badge\">" . $cf_details_line . "</span> ";
                                                    }
                                                    $line_num++;
                                                }
                                            } elseif ($customField->type == 5) {
                                                $cf_data = Helper::formatDate($cf_saved_val)." ".date("h:i A", strtotime($cf_saved_val));
                                            } elseif ($customField->type == 4) {
                                                $cf_data = Helper::formatDate($cf_saved_val);
                                            } else {
                                                $cf_data = $cf_saved_val;
                                            }
                                            if($cf_data != ""){
                                            ?>
                                            <td class="text-center {!! $customField->css_class !!}">{!! $cf_data !!}</td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="text-center {!! $customField->css_class !!}"></td>
                                            <?php
                                            }
                                            }
                                            }
                                            }
                                            }
                                            ?>
                                            @if (@$Topic->webmasterSection->date_status)
                                                <td class="text-center">{!! Helper::formatDate($Topic->date) !!}</td>
                                            @endif
                                            @if (@$Topic->webmasterSection->expire_date_status)
                                                <td class="text-center">
                                                    <div {!! (($Topic->expire_date < date("Y-m-d")) ? "style='color:red'" : "") !!}>{!! Helper::formatDate($Topic->expire_date) !!}</div>
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{!! $topic_link_url !!}"
                                                   class="btn btn-theme"><i class="fa fa-file-text-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-8">
                                        {!! $Topics->links() !!}
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <br>
                                        <small>{{ $Topics->firstItem() }}
                                            - {{ $Topics->lastItem() }} {{ __('backend.of') }}
                                            ( {{ $Topics->total()  }} ) {{ __('backend.records') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                @if(count($Categories)>0)
                    @include('frontEnd.includes.side')
                @endif
            </div>
        </div>
    </section>
    <script>
        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
        };

        window.onload = function () {
            @foreach($WebmasterSection->customFields as $customField)
            @if($customField->in_statics && ($customField->type==6 || $customField->type==7))
            <?php
            $cf_details_var = "details_" . @Helper::currentLanguage()->code;
            $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
            if ($customField->$cf_details_var != "") {
                $cf_details = $customField->$cf_details_var;
            } else {
                $cf_details = $customField->$cf_details_var2;
            }
            $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
            ?>
            new Chart(document.getElementById('chart-area-{{ $customField->id }}').getContext('2d'), {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                            {{ (@$statics[$customField->id][$line_num] !="")?@$statics[$customField->id][$line_num]:0 }},
                            <?php
                            $line_num++;
                            ?>
                            @endforeach
                        ],
                        backgroundColor: [
                            <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)

                            dynamicColors(),
                            <?php
                            $line_num++;
                            ?>
                            @endforeach
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        <?php
                            $line_num = 1;
                            ?>
                            @foreach ($cf_details_lines as $cf_details_line)
                        ('{{ $cf_details_line }}').substring(0, 40) + ((('{{ $cf_details_line }}').length > 40) ? '..' : '') + " ( " + '{{ (@$statics[$customField->id][$line_num] !="")?@$statics[$customField->id][$line_num]:0 }}' + ' )',
                        <?php
                        $line_num++;
                        ?>
                        @endforeach
                    ]
                },
                options: {
                    responsive: false,
                    legend: {
                        display: true,
                        position: 'left',
                        labels: {

                            // font size, default is defaultFontSize
                            fontSize: 11,

                            // font color, default is '#fff'
                            fontColor: '#666',

                            // font style, default is defaultFontStyle
                            fontStyle: 'normal',

                            // font family, default is defaultFontFamily
                            fontFamily: "smart4dsTitles, 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif"
                        }
                    }
                }
            });
            @endif
            @endforeach
        };
    </script>
@endsection
