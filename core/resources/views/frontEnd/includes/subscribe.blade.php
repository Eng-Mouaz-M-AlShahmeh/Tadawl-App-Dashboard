@if(Helper::GeneralSiteSettings("style_subscribe"))
    <div class="col-lg-{{$bx4w}}">
        <div class="widget">
            <h4 class="widgetheading"><i class="fa fa-mobile"></i>&nbsp; {{ __('frontend.newsletter') }}</h4>
            <p>{{ __('frontend.subscribeToOurNewsletter') }}</p>
            
            
            <div class="p-2" style="margin: 2px;">
                
                <a href="https://apps.apple.com/sa/app/%D8%AA%D8%B7%D8%A8%D9%8A%D9%82-%D8%AA%D8%AF%D8%A7%D9%88%D9%84-%D8%A7%D9%84%D8%B9%D9%82%D8%A7%D8%B1%D9%8A/id1569963764">
             <img width="170" src="https://tadawl.com.sa/API/assets/images/apple-store.png" >
             </a>
             
            </div>
        
            <div class="p-2" style="margin: 10px;">
                
                <a href="https://play.google.com/store/apps/details?id=com.tadawlapp.tadawl_app">
              <img width="150" src="https://tadawl.com.sa/API/assets/images/google-play.png" >
              </a>
              
            </div>
            
            <div class="p-2" style="margin: 10px;">
                
                <a href="https://store.tadawl.com.sa/assets/frontend/img/vat-tadawl.pdf">
              <img width="70" src="https://tadawl.com.sa/API/assets/images/vat.png" >
              </a>
              
            </div>
                
            <!--
            <div id="subscribesendmessage"><i class="fa fa-check-circle"></i> &nbsp;{{ __('frontend.subscribeToOurNewsletterDone') }}</div>
            <div id="subscribeerrormessage">{{ __('frontend.youMessageNotSent') }}</div>

            {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'subscribeForm'])}}
            <div class="form-group">
                {!! Form::text('subscribe_name',"", array('placeholder' => __('frontend.yourName'),'class' => 'form-control','id'=>'subscribe_name', 'data-msg'=> __('frontend.enterYourName'),'data-rule'=>'minlen:4')) !!}
                <div class="alert alert-warning validation"></div>
            </div>
            <div class="form-group">
                {!! Form::email('subscribe_email',"", array('placeholder' => __('frontend.yourEmail'),'class' => 'form-control','id'=>'subscribe_email', 'data-msg'=> __('frontend.enterYourEmail'),'data-rule'=>'email')) !!}
                <div class="validation"></div>
            </div>
            <button type="submit" class="btn btn-info">{{ __('frontend.subscribe') }}</button>
            {{Form::close()}}
            -->
            
            
        </div>
    </div>
@endif
