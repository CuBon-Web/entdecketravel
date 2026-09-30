@if (count($product) > 0)
    <div class="row">
        @foreach ($product as $item)
            @php
                $images = json_decode($item->images, true);
                $thumb = is_array($images) && isset($images[0]) ? $images[0] : url('/frontend/images/no-image.png');
            @endphp
            <div class="col-xl-4 col-lg-6 m-b30">
                <div class="trv-popular-tour-st1">
                    <div class="trv-media">
                        <a href="{{ route('detailProduct', ['cate' => $item->cate_slug, 'type' => $item->type_slug ? $item->type_slug : 'type', 'id' => $item->slug]) }}"><img src="{{ $thumb }}" alt="{{ languageName($item->name) }}"></a>
                        <div class="trv-tour-duration">
                            <i class="bi bi-calendar2-week"></i>
                            <span>{{ $item->hang_muc }}</span>
                        </div>
                        <div class="trv-tour-title">
                            <h3 class="trv-title">
                                <a href="{{ route('detailProduct', ['cate' => $item->cate_slug, 'type' => $item->type_slug ? $item->type_slug : 'type', 'id' => $item->slug]) }}">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ languageName(optional($item->cate)->name) }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="trv-content">
                        <div class="trv-content-head-section">
                          
                            <div class="trv-tour-info">
                                <h3>
                                    <a href="{{ route('detailProduct', ['cate' => $item->cate_slug, 'type' => $item->type_slug ? $item->type_slug : 'type', 'id' => $item->slug]) }}">{{ languageName($item->name) }}</a>
                                </h3>
                                <p class="line_2">{{ languageName($item->description) }}</p>
                             </div>
                        </div>
                        <div class="trv-content-bottom-section">
                            <div class="trv-book">
                                <a href="{{ route('detailProduct', ['cate' => $item->cate_slug, 'type' => $item->type_slug ? $item->type_slug : 'type', 'id' => $item->slug]) }}" class="site-button outline">Book Now</a>
                            </div>
                            <div class="trv-tour-rating">
                                <span class="trv-tour-review-count">Price</span>
                                <div class="trv-review-rating">
                                    <i>
                                        @if ((int) languageName($item->discount) > 0)
                                            {{ number_format(languageName($item->discount)) }}VND
                                        @elseif ((int) languageName($item->price) > 0)
                                            {{ number_format(languageName($item->price)) }}VND
                                        @else
                                            Contact
                                        @endif
                                    </i>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                 </div>
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {!! $product->links() !!}
    </div>
@else
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h3>Nội dung đang được cập nhật</h3>
        </div>
    </div>
@endif