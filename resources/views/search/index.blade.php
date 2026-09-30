@extends('layouts.main.master')
@section('title')
    {{ $title }}
@endsection
@section('description')
    @if ($keyword !== '')
        Tìm tour và tin tức với từ khóa "{{ $keyword }}"
    @else
        Tìm kiếm tour và tin tức
    @endif
@endsection
@section('image')
    {{ isset($banner[0]) ? url('' . $banner[0]->image) : url('' . $setting->logo) }}
@endsection
@section('css')
@endsection
@section('content')
    @php
        $bannerImage = '/frontend/images/banner-tour-package.jpg';
    @endphp
    <div class="page-content">
        <div class="trv-tr-pack-bnr-wrap" style="background-image: url({{ $bannerImage }});">
            <div class="container">
                <div class="trv-search-st5">
                    <h3 class="trv-search-st5-title">Tìm kiếm</h3>
                    <ul class="wt-breadcrumb breadcrumb-style-2">
                        <li><a class="text-white" href="{{ route('home') }}">Home</a></li>
                        <li class="text-white">Tìm kiếm</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="section-full p-t20 p-b20 trv-package-sec-wrap">
            <div class="container">
                <form method="get" action="{{ route('globalSearch') }}" class="m-b30" role="search">
                    <div class="input-group radius-xl" style="max-width: 640px;">
                        <input class="form-control" name="q" type="search" value="{{ $keyword }}"
                            placeholder="Từ khóa tour hoặc tin tức...">
                        <span class="input-group-append">
                            <button type="submit" class="site-button">Tìm kiếm</button>
                        </span>
                    </div>
                </form>

                @if ($keyword === '')
                    <p class="text-muted">Nhập từ khóa và nhấn tìm kiếm để xem tour và bài viết liên quan.</p>
                @else
                    <h4 class="m-b20">Tour ({{ $tours->total() }})</h4>
                    @if ($tours->count() > 0)
                        <div class="row">
                            @foreach ($tours as $item)
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                                    @include('layouts.product.item', ['pro' => $item])
                                </div>
                            @endforeach
                        </div>
                        <div class="m-b40">{{ $tours->links() }}</div>
                    @else
                        <p class="m-b40 text-muted">Không có tour phù hợp.</p>
                    @endif

                    <h4 class="m-b20">Tin tức / Blog ({{ $blogs->total() }})</h4>
                    @if ($blogs->count() > 0)
                        <div class="row">
                            @foreach ($blogs as $item)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
                                    <article class="post-item post-grid post type-post status-publish format-standard has-post-thumbnail">
                                        <div class="post-inner">
                                            <div class="post-thumb">
                                                <a href="{{ route('detailBlog', ['slug' => $item->slug]) }}">
                                                    <img src="{{ $item->image }}" class="img-responsive attachment-370x330 size-370x330"
                                                        alt="{{ languageName($item->title) }}">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-meta">
                                                    <div class="post-comment-icon">
                                                        <a href="{{ route('detailBlog', ['slug' => $item->slug]) }}">
                                                            {{ date_format($item->created_at, 'd/m/Y') }}</a>
                                                    </div>
                                                </div>
                                                <div class="post-info equal-elem">
                                                    <h2 class="post-title">
                                                        <a href="{{ route('detailBlog', ['slug' => $item->slug]) }}">{{ languageName($item->title) }}</a>
                                                    </h2>
                                                    <div class="line_3">{{ languageName($item->description) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                        <div class="m-b20">{{ $blogs->links() }}</div>
                    @else
                        <p class="text-muted">Không có bài viết phù hợp.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
