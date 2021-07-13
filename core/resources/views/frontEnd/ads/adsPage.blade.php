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
          <h2>     
             <span class="p-2">{!! @$Ads->categoryAqar->name !!},</span>
             <span class="p-2">{!! @$Ads->description->ads_neighborhood !!}, </span>
             <span class="p-2">{!! @$Ads->description->ads_city !!}</span>

             @if($Ads->id_special == '1')
               <i style="font-size: 35px; color: #ffcc00;" class="fa fa-star"></i>
             @endif
             
           </h2> 
      </div>
   </div>    
   
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
          <h6>     
             <span class="p-2">{!! @$Ads->description->ads_road !!},</span>
             <span class="p-2">{!! @$Ads->description->ads_neighborhood !!}, </span>
             <span class="p-2">{!! @$Ads->description->ads_city !!}</span>

           </h6> 
      </div>
   </div> 


<!-- Photo Grid -->
 <div class="container">
  <div class="col-md-12 col-lg-12 col-sm-12">
       @foreach($Images as $Image)
        <span class="p-2">
          <img width="400" src="https://tadawl.com.sa/API/assets/images/ads/{{ $Image->ads_image }}" class="img-fluid img-thumbnail rounded">
        </span>  
       @endforeach   
  </div>
 </div>

<!-- Price Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
          <h2>     
             <span class="p-2">{!! @$Ads->description->price !!} ريال سعودي {!! @$Ads->description->typeRes->title !!}</span>
           </h2> 
      </div>
   </div>        

<!-- Description Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
          <h3>     
             <span class="p-2">{!! @$Ads->description->description !!}</span>
           </h3> 
      </div>
   </div>        

<!-- Table Info -->
<div class="container">
<table class="table table-bordered">
    
  @if($Ads->description->space != 'null')
  <tr class="odd">
    <td class="dker">
        <h5>     
           <span class="p-2">المساحة</span>
        </h5>
    </td>
    <td class="dker">
        <h5>     
           <span class="p-2">{!! @$Ads->description->space !!} م2</span>
        </h5>
    </td>
  </tr>
  @endif
  
  @if($Ads->description->id_interface != 'null')
  <tr class="even">
    <td class="lter">
        <h5>     
           <span class="p-2">الواجهة</span>
        </h5>
    </td>
    <td class="lter">
        <h5>     
           <span class="p-2">{!! @$Ads->description->interfaceAqar->name !!} </span>
        </h5>
    </td>
  </tr>
  @endif
  
  @if($Ads->description->id_type_aqar != 'null')
  <tr class="odd">
    <td class="dker">
        <h5>     
           <span class="p-2">النوع</span>
        </h5>
    </td>
    <td class="dker">
        <h5>     
           <span class="p-2">{!! @$Ads->description->typeAqar->name !!} </span>
        </h5>
    </td>
  </tr>
  @endif


@for ($i = 0; $i < count($quantityAds); $i++)
  @if($quantityAds[$i]->quantity != 0)
  
  @if($i % 2 == 0)
  <tr class="even">
    <td class="lter">
        <h5>     
           <span class="p-2">{!! @$quantityAds[$i]->translateFA->title !!}</span>
        </h5>
    </td>
    <td class="lter">
        <h5>     
           <span class="p-2">
              
              @if($quantityAds[$i]->id_QFAT == 13) 
               <i style="color:grey; font-size: 25px;" class="fa fa-road"></i>
              @elseif($quantityAds[$i]->id_QFAT == 11) 
               <i style="color:grey; font-size: 25px;" class="fa fa-history"></i>
              @elseif($quantityAds[$i]->id_QFAT == 9) 
               <i style="color:grey; font-size: 25px;" class="fa fa-bed"></i>
              @elseif($quantityAds[$i]->id_QFAT == 8) 
               <i style="color:grey; font-size: 25px;" class="fa fa-bath"></i>
              @elseif($quantityAds[$i]->id_QFAT == 7) 
               <i style="color:grey; font-size: 25px;" class="fa fa-coffee"></i>
              @elseif($quantityAds[$i]->id_QFAT == 16) 
               <i style="color:grey; font-size: 25px;" class="fa fa-shopping-bag"></i>
              @endif 
               
               
               {!! @$quantityAds[$i]->quantity !!}
               
              
               
           @if($quantityAds[$i]->id_QFAT == 13)
           م
           @elseif($quantityAds[$i]->id_QFAT == 11) 
           سنة
           @endif
           </span>
        </h5>
    </td>
  </tr>
  @else
  <tr class="odd">
    <td class="dker">
        <h5>     
           <span class="p-2">{!! @$quantityAds[$i]->translateFA->title !!}</span>
        </h5>
    </td>
    <td class="dker">
        <h5>     
           <span class="p-2">
           
             @if($quantityAds[$i]->id_QFAT == 13) 
               <i style="color:grey; font-size: 25px;" class="fa fa-road"></i>
              @elseif($quantityAds[$i]->id_QFAT == 11) 
               <i style="color:grey; font-size: 25px;" class="fa fa-history"></i>
              @elseif($quantityAds[$i]->id_QFAT == 9) 
               <i style="color:grey; font-size: 25px;" class="fa fa-bed"></i>
              @elseif($quantityAds[$i]->id_QFAT == 8) 
               <i style="color:grey; font-size: 25px;" class="fa fa-bath"></i>
              @elseif($quantityAds[$i]->id_QFAT == 7) 
               <i style="color:grey; font-size: 25px;" class="fa fa-coffee"></i>
              @endif 
               
               
               {!! @$quantityAds[$i]->quantity !!}
               
              
               
           @if($quantityAds[$i]->id_QFAT == 13)
           م
           @elseif($quantityAds[$i]->id_QFAT == 11) 
           سنة
           @endif
           
           </span>
        </h5>
    </td>
  </tr>
  @endif
  
  @endif
@endfor  


@for ($i = 0; $i < count($booleanAds); $i++)
  @if($booleanAds[$i]->state == 'true')
  
  @if($i % 2 == 0)
  <tr class="even">
    <td class="lter">
        <h5>     
           <span class="p-2">{!! @$booleanAds[$i]->translateFA->title !!}</span>
        </h5>
    </td>
    <td class="lter">
        <i style="color:green; font-size: 25px;" class="fa fa-check"></i>
    </td>
  </tr>
  @else
  <tr class="odd">
    <td class="dker">
        <h5>     
           <span class="p-2">{!! @$booleanAds[$i]->translateFA->title !!}</span>
        </h5>
    </td>
    <td class="dker">
        <i style="color:green; font-size: 25px;" class="fa fa-check"></i>
    </td>
  </tr>
  @endif
  
  @endif
@endfor  
   
   

</table>       
</div>



<!-- Other Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">   
     
     <span class="p-2 pull-right"> 
    {!! @$Ads->description->id !!}  # 
     </span>
     
     
     <span class="col-md-9 col-lg-9 col-sm-12"> 
     <h5> 
     <i class="fa fa-eye"></i>
     {!! @$Ads->views !!}
     </h5> 
     </span>
     
     <span class="col-md-9 col-lg-9 col-sm-12"> 
     <h5> 
     <i class="fa fa-clock-o"></i>
     
     <?php
        echo time_elapsed_string($Ads->timeAdded);
     ?>
     </h5> 
     </span>
     
      </div>
   </div>        


<!-- Avatar Info -->
   <div class="container">
      
       <div class="container bottom-article"> 
       
     <div class="col-md-12 col-lg-12 col-sm-12" onclick="location.href='{{route('user.userPage', [$Ads->id_user])}}'">  
    @if($Ads->user->image != '')
    <div class="p-2"> 
       <h4> 
        <span class="p-2">  
            <img width="75" src="https://tadawl.com.sa/API/assets/images/avatar/{{ $Ads->user->image }}" class="img-fluid img-thumbnail rounded" alt="...">  
        </span>
        
        <span class="p-2">{!! @$Ads->user->username !!}</span>
        </h4> 
    </div> 
    @else
    <div class="p-2"> 
       <h4>
        <span class="p-2">  
            <img width="75" src="https://tadawl.com.sa/API/assets/images/avatar/avatar.jpg" class="img-fluid img-thumbnail rounded" alt="..."> 
        </span>
        
        <span class="p-2">{!! @$Ads->user->username !!}</span>
        </h4>
    </div> 
    @endif
    </div>
     
     <div class="col-md-12 col-lg-12 col-sm-12"> 
       <div class="btn btn-info" > 
        
        
        <i class="fa fa-phone"></i> &nbsp;<a href="tel:{ !! @$Ads->user->phone !! }"><span style="color: white;">{!! str_replace('966', '0', @$Ads->user->phone) !!}</span></a>
        
        
        
      <!--  <span id="contentt"> إظهار رقم الجوال </span>  
      onclick="document.getElementById('contentt').innerHTML='{!! str_replace('966', '0', @$Ads->user->phone) !!}';"
      -->
      
       </div>
     </div>

</div> 
   
   </div>        


<!-- Map Info -->
<!--
<div class ="row">
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">      
         <div class="mapouter"><div class="gmap_canvas"><iframe width="708" height="413" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:413px;width:708px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:413px;width:708px;}</style></div></div>
      </div>
   </div>        
</div>
-->


<!-- Navigation Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">  
     
     @if($next != '')
     <span class="p-2 pull-right"> 
           <a href="{{route('ads.adsPage', [$next])}}">     
             <span class="p-2">التالي</span>
           </a> 
     </span>
     @endif
     
     @if($previous != '')
     <span class="p-2 pull-left"> 
           <a href="{{route('ads.adsPage', [$previous])}}">     
             <span class="p-2">السابق</span>
           </a> 
     </span>
     @endif
     

      </div>
   </div>        


<!-- Similar Ads Info -->
   <div class="container">
     <div class="col-md-12 col-lg-12 col-sm-12">  
          <h3>     
             <span class="p-2">إعلانات مشابهة</span>
             
              <span class="p-2">( {!! @count($similarAds) !!} )</span
             
           </h3> 
      </div>
   </div>        

       <div class="container">
           

                   
            @foreach($similarAds as $AdsAll)


            <div onclick="location.href='{{route('ads.adsPage', [$AdsAll->id])}}'"  class="container bottom-article">

                
           <div class="pull-right"> 
           @foreach($ImagesSimilar as $ImagesSimilars)
           <?php
           for($x=0; $x<count($ImagesSimilars); $x++) {
               if($ImagesSimilars[$x]->id_description != $AdsAll->id_description) {
                   continue;
                  
               } else {
           
           ?>
            <span class="p-2">  
            <img width="150" src="https://tadawl.com.sa/API/assets/images/ads/{{ $ImagesSimilars[$x]->ads_image }}" class="img-fluid img-thumbnail rounded" alt="...">  
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
