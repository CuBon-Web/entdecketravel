
<figure class="member-avatar text-center">
  <img data-lazyloaded="1" src="{{($pro->image)}}" class="img-circle entered litespeed-loaded">
</figure>
<div class="entry-body">
  <h3 class="member-name text-center">{{($pro->name)}}</h3>
  <div class="text-center mb-20">
     <ul class="list-unstyled">
        <li>
          {{($pro->position)}}
        </li>
     </ul>
  </div>
  <div class="member-desc text-left pd-20">
    {!!($pro->description)!!}
  </div>
</div>