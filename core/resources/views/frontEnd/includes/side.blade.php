<div class="col-lg-4">
    <aside class="right-sidebar">
        <div class="widget">
            {{Form::open(['route'=>['searchTopics'],'method'=>'POST','class'=>'form-search'])}}
            <div class="input-group input-group-sm">
                {!! Form::text('search_word',@$search_word, array('placeholder' => __('frontend.search'),'class' => 'form-control','id'=>'search_word','required'=>'')) !!}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-theme"><i class="fa fa-search"></i></button>
                </span>
            </div>

            {{Form::close()}}
        </div>

        @if(count($Categories)>0)
            <?php
            $title_var = "title_" . @Helper::currentLanguage()->code;
            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            $category_title_var = "title_" . @Helper::currentLanguage()->code;
            $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
            $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
            ?>
            <div class="widget">
                <h5 class="widgetheading">{{ __('frontend.categories') }}</h5>
                <ul class="cat">
                    @foreach($Categories as $Category)
                        <?php $active_cat = ""; ?>
                        @if($CurrentCategory!="none")
                            @if(!empty($CurrentCategory))
                                @if($Category->id == $CurrentCategory->id)
                                    <?php $active_cat = "class=active"; ?>
                                @endif
                            @endif
                        @endif
                        <?php
                        if ($Category->$title_var != "") {
                            $Category_title = $Category->$title_var;
                        } else {
                            $Category_title = $Category->$title_var2;
                        }
                        $ccount = $category_and_topics_count[$Category->id];
                        ?>
                        <li>
                            @if($Category->icon !="")
                                <i class="fa {{$Category->icon}}"></i> &nbsp;
                            @endif
                            <a {{ $active_cat }} href="{{ Helper::categoryURL($Category->id) }}">{{ $Category_title }}</a><span
                                class="pull-right">({{ $ccount }})</span></li>
                        @foreach($Category->fatherSections as $MnuCategory)
                            <?php $active_cat = ""; ?>
                            @if($CurrentCategory!="none")
                                @if(!empty($CurrentCategory))
                                    @if($MnuCategory->id == $CurrentCategory->id)
                                        <?php $active_cat = "class=active"; ?>
                                    @endif
                                @endif
                            @endif
                            <?php
                            if ($MnuCategory->$title_var != "") {
                                $MnuCategory_title = $MnuCategory->$title_var;
                            } else {
                                $MnuCategory_title = $MnuCategory->$title_var2;
                            }
                            $ccount = $category_and_topics_count[$MnuCategory->id];
                            ?>
                            <li> &nbsp; &nbsp; &nbsp;
                                @if($MnuCategory->icon !="")
                                    <i class="fa {{$MnuCategory->icon}}"></i> &nbsp;
                                @endif
                                <a {{ $active_cat }}  href="{{ Helper::categoryURL($MnuCategory->id) }}">{{ $MnuCategory_title }}</a><span
                                    class="pull-right">({{ $ccount }})</span></li>
                        @endforeach

                    @endforeach
                </ul>
            </div>

        @endif
        @if(count($TopicsMostViewed)>0)
            <?php
            $side_title_var = "title_" . @Helper::currentLanguage()->code;
            $side_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
            $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
            ?>
            <div class="widget">
                <h5 class="widgetheading">{{ __('frontend.mostViewed') }}</h5>
                <ul class="recent">
                    @foreach($TopicsMostViewed as $TopicMostViewed)
                        <?php
                        if ($TopicMostViewed->$side_title_var != "") {
                            $side_title = $TopicMostViewed->$side_title_var;
                        } else {
                            $side_title = $TopicMostViewed->$side_title_var2;
                        }
                        $topic_link_url = Helper::topicURL($TopicMostViewed->id);
                        ?>
                        <li>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="{{ $topic_link_url }}">
                                        @if($TopicMostViewed->photo_file !="")
                                            <img src="{{ URL::to('uploads/topics/'.$TopicMostViewed->photo_file) }}"
                                                 class="pull-left" alt="{{ $side_title }}"/>
                                        @elseif($TopicMostViewed->webmasterSection->type==2 && $TopicMostViewed->video_file!="")
                                            @if($TopicMostViewed->video_type ==1)
                                                <?php
                                                $Youtube_id = Helper::Get_youtube_video_id($TopicMostViewed->video_file);
                                                ?>
                                                @if($Youtube_id !="")
                                                    <img src="//img.youtube.com/vi/{{$Youtube_id}}/0.jpg"
                                                         class="pull-left" alt="{{ $side_title }}"/>
                                                @endif
                                            @elseif($TopicMostViewed->video_type ==2)
                                                <?php
                                                $Vimeo_id = Helper::Get_vimeo_video_id($TopicMostViewed->video_file);
                                                ?>
                                                @if($Vimeo_id !="")
                                                    <?php
                                                    $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$Vimeo_id.php"));
                                                    ?>

                                                    <img src="{{ $hash[0]['thumbnail_large'] }}"
                                                         class="pull-left" alt="{{ $side_title }}"/>
                                                @endif
                                            @endif
                                        @endif
                                    </a>
                                    <h6>
                                        <a href="{{ $topic_link_url }}">{{ $side_title }}</a>
                                    </h6>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('frontEnd.includes.banners',["BannersSettingsId"=>Helper::GeneralWebmasterSettings("side_banners_section_id")])

    </aside>
</div>
