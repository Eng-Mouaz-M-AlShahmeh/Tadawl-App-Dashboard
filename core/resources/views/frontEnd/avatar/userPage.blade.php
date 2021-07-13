<?php
  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'سنة',
        'm' => 'شهر',
        'w' => 'أسبوع',
        'd' => 'يوم',
        'h' => 'ساعة',
        'i' => 'دقيقة',
        's' => 'ثانية',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? ' منذ ' . implode(', ', $string)  : 'الآن';
}
?>


@extends('frontEnd.layout')

@section('content')

    <!-- start Home Slider -->
    @include('frontEnd.includes.slider')
    <!-- end Home Slider -->


<!-- Main Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
          <h4>     
             <span class="p-2">الملف الشخصي</span>
           </h4> 
      </div>
   </div>        


<!-- Avatar Info -->
   <div class="container">
      
       <div class="container bottom-article"> 
       
     <div class="col-md-12 col-lg-12 col-sm-12">  
    @if($user->image != '')
    <div class="p-2"> 
       <h4> 
        <span class="p-2">  
            <img width="150" src="https://tadawl.com.sa/API/assets/images/avatar/{{ $user->image }}" class="img-fluid img-thumbnail rounded" alt="...">  
        </span>
        
        <span class="p-2">{!! @$user->username !!}</span>
        </h4> 
    </div> 
    @else
    <div class="p-2"> 
       <h4>
        <span class="p-2">  
            <img width="150" src="https://tadawl.com.sa/API/assets/images/avatar/avatar.jpg" class="img-fluid img-thumbnail rounded" alt="..."> 
        </span>
        
        <span class="p-2">{!! @$user->username !!}</span>
        </h4>
    </div> 
    @endif
    </div>
    
    <!-- onclick="document.getElementById('contentt').innerHTML='{!! str_replace('966', '0', @$user->phone) !!}';" -->
    
     <div class="col-md-12 col-lg-12 col-sm-12"> 
       <div class="btn btn-info" > 
       <!-- <span id="contentt"> إظهار رقم الجوال </span>  -->
       
       
       <i class="fa fa-phone"></i> &nbsp;<a href="tel:{ !! @$user->phone !! }"><span style="color: white;">{!! str_replace('966', '0', @$user->phone) !!}</span></a>
                                
       
     
       </div>
     </div>

</div> 
      
   </div>        



<!-- User Ads Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
          <h3>     
             <span class="p-2">إعلانات الحساب  ( {!! @count($Ads) !!} ) </span>
           </h3> 
      </div>
   </div>        




       <div class="container">
           

                   
            @foreach($Ads as $AdsAll)


            <div onclick="location.href='{{route('ads.adsPage', [$AdsAll->id])}}'"  class="container bottom-article">

                
           <div class="pull-right"> 
           @foreach($Images as $Imagess)
           
           <?php
           for($x=0; $x<count($Imagess); $x++) {
               if($Imagess[$x]->id_description != $AdsAll->id_description) {
                   continue;
                  
               } else {
           
           ?>
            <span class="p-2">  
            <img width="150" src="https://tadawl.com.sa/API/assets/images/ads/{{ $Imagess[$x]->ads_image }}" class="img-fluid img-thumbnail rounded" alt="...">  
            </span>
            
            <?php
               } 
               break;
           }
            ?>
            
            @endforeach
            </div> 
            
            
            
            
            
         <div class="col-md-9 col-lg-9 col-sm-12">      
          <h4>     
             <span class="p-2">{!! @$AdsAll->categoryAqar->name !!},</span>
             <span class="p-2">{!! @$AdsAll->description->ads_road !!},</span>
             <span class="p-2">{!! @$AdsAll->description->ads_neighborhood !!},</span>
             <span class="p-2">{!! @$AdsAll->description->ads_city !!}</span>
           </h4> 
         </div>
         
         <div class="col-md-9 col-lg-9 col-sm-12">      
          <h5>     
             <span class="p-2">{!! @$AdsAll->description->price !!} ريال</span>
             
             <span class="p-2 pull-right"> 
             <i class="fa fa-clock-o"></i>
             
             
             <?php
             echo time_elapsed_string($AdsAll->timeAdded);
               ?>

             
             </span>
             
            
           </h5> 
         </div>
         
         <div class="col-md-9 col-lg-9 col-sm-12">      
          <h6>     
             <span class="p-2">{!! @$AdsAll->description->space !!} م2</span>
            
           </h6> 
         </div>
         
          <div class="col-md-9 col-lg-9 col-sm-12">      
          <h6>     
             <span class="p-2">{!! @$AdsAll->description->description !!} </span>
            
           </h6> 
         </div>
         
            
            </div>
  
           @endforeach
           
    </div>
    
<div class="container"><br></div>

 
    


@endsection
