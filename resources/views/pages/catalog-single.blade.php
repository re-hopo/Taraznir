@section('title', ' تارازنیر | کاتالوگ‌ها')

@php
    $meta = $catalog->meta->pluck('value','key')->toArray();
@endphp

@section('seo')
    @php
        echo socialsTagGenerator( 'page' ,(object)[
            'title'       => 'کاتالوگ‌ها ',
            'url'         => url()->current() ,
            'keywords'    => indexChecker( $meta ,'keywords'),
            'description' => indexChecker( $meta ,'description')
        ])
    @endphp
@endsection

@section('breadcrumbs')
    @include('layouts.breadcrumbs' ,['routes' => ['Resource' => '' ] ,'pageName' => 'Resource' ])
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/resource.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/resource.js') }}" defer></script>
@endsection


@section('sidebar','sidebar-right')


<div id="main-content" class="site-main clearfix pt-5">
    <div id="content-wrap" class="container">
        <div id="site-content" class="site-content clearfix">
            <div class="detail-gallery">
                <div class="themesflat-spacer clearfix" data-desktop="21" data-mobile="21" data-smobile="21"></div>
                <div class="flat-content-wrap style-3 clearfix" dir="rtl">
                    <img src="{{ $catalog->images() }}" alt="{{$catalog->slug}}">
                </div>

                <div class="themesflat-spacer clearfix" data-desktop="40" data-mobile="40" data-smobile="40"></div>
                <div class="flat-content-wrap style-3 clearfix" dir="rtl">
                    <h5 class="title">توضیحات </h5>
                    <div class="sep has-width w60 accent-bg margin-top-18 clearfix"></div>
                    <div class="content text-right mt-5">
                        {{ $catalog->summary }}
                    </div>
                </div>

                <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                <livewire:components.related-posts :posts="$related" :path="'catalog'" :title="'کاتالوگ‌های مرتبط'"/>
            </div>
        </div>

        <div id="sidebar" style="min-width: 270px">
            <div class="themesflat-spacer clearfix" data-desktop="0" data-mobile="60" data-smobile="60"></div>
            <div id="inner-sidebar" class="inner-content-wrap">
                <div class="detail-inner-wrap">
                    <div class="content-info" dir="rtl">
                        <div class="themesflat-headings style-2 clearfix">
                            <h2 class="heading line-height-62">جزئیات استاندارد</h2>
                            <div class="sep has-width w80 accent-bg clearfix">
                            </div>
                        </div>
                        <ul class="list-info has-icon icon-left">
                            <li dir="rtl"><span class="text">موضوع: <span class="icon"><i class="fa fa-user"></i></span></span><span class="right">{{indexChecker( $meta ,'client' )}}</span></li>
                            <li><span class="text">فرمت: <span class="icon"><i class="fa fa-search"></i></span></span><span class="right">{{indexChecker( $meta ,'location')}} </span></li>
                            <li><span class="text"> استاندارد:<span class="icon"><i class="fa fa-calendar"></i></span></span><span class="right">{{indexChecker( $meta ,'designer')}}</span></li>
                            <li><span class="text">دسته‌بندی: <span class="icon"><i class="fa fa-tag"></i></span></span>
                                <span class="right">
                                    @if( !empty( $categories ) )
                                        @foreach( $categories as $cat )
                                            {{ $loop->index > 0 ? '/' : '' }}
                                            <a href="/project/tag/{{$cat->slug}}">{{$cat->title}}</a>
                                        @endforeach
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <livewire:components.attachment :post="$catalog" />
            </div>
        </div>
    </div>
</div>
