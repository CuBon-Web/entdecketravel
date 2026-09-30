
@php
$img = json_decode($pro->images);
$itemTagDisplay = null;
if (isset($tagcateContext) && $tagcateContext && $tagcateContext->tags && $tagcateContext->tags->isNotEmpty() && $pro->tags) {
    $productTags = is_array($pro->tags) ? $pro->tags : json_decode($pro->tags, true);
    if (is_array($productTags)) {
        foreach ($tagcateContext->tags as $t) {
            $slug = (string) $t->slug;
            foreach ($productTags as $pt) {
                $pt = (string) $pt;
                if ($pt === $slug || strpos($pt, $slug . '-') === 0) {
                    $itemTagDisplay = languageName($t->name);
                    break 2;
                }
            }
        }
    }
}
@endphp
<div class="trv-popular-tour-st1">
   <div class="trv-media">
       <a href="{{route('detailProduct',['cate'=>$pro->cate_slug,'type'=>$pro->type_slug ? $pro->type_slug : 'type','id'=>$pro->slug])}}"><img src="{{$img[0]}}" alt="Image"></a>
       <div class="trv-tour-duration">
           <i class="bi bi-calendar2-week"></i>
           <span>{{($pro->hang_muc)}}</span>
       </div>
       <div class="trv-tour-title">
           <h3 class="trv-title">
               <a href="{{route('detailProduct',['cate'=>$pro->cate_slug,'type'=>$pro->type_slug ? $pro->type_slug : 'type','id'=>$pro->slug])}}">
                   <i class="bi bi-geo-alt"></i>
                   @if ($itemTagDisplay)
                       {{ $itemTagDisplay }}
                   @else
                       {{ languageName($pro->cate->name) }}
                   @endif
               </a>
           </h3>
       </div>
   </div>
   <div class="trv-content">
       <div class="trv-content-head-section">
         
           <div class="trv-tour-info">
               <h3 href="{{route('detailProduct',['cate'=>$pro->cate_slug,'type'=>$pro->type_slug ? $pro->type_slug : 'type','id'=>$pro->slug])}}">{{($pro->name)}}</h3>
               <p class="line_2">{{languageName($pro->description)}}</p>
            </div>
       </div>
       <div class="trv-content-bottom-section">
           <div class="trv-book">
               <a href="{{route('detailProduct',['cate'=>$pro->cate_slug,'type'=>$pro->type_slug ? $pro->type_slug : 'type','id'=>$pro->slug])}}" class="site-button outline">Book Now</a>
           </div>
           <div class="trv-tour-rating">
               <span class="trv-tour-review-count">Price</span>
               <div class="trv-review-rating">
                   <i>Contact Us</i>
               </div>
           </div>
       </div>
       
   </div>
   
</div>


