@section('seo')
    {!! seo_tags_generator( $item ,null ,"$item->slug تارازنیر | پروژه | " ,true) !!}
@endsection


<x-theme::root :sidebar="false" :breads="[
    'title'  => project_trans('Project detail'),
    'breads' => [
        ['title' => project_trans('Projects') ,'a' => '/project'],
        ['title' => $item->title]
    ],
]">
    <section class="portfolio-detail-section project-detail mt-5 pt-5">
        <div class="auto-container">
            <div class="image d-flex align-items-center">
                <img src="{{$item->images['single']??''}}" alt="{{$item->title}}" />
                <div class="overlay-box">
                    <div class="content">
                        <ul>
                            <li><span>مشتری: </span>{{get_meta_value_by_key($item ,'client')}}</li>
                            <li><span>تاریخ: </span>{{get_meta_value_by_key($item ,'date')}}</li>
                            <li><span>دسته بندی: </span>{{get_meta_value_by_key($item ,'category')}}</li>
                            <li>
                                <x-theme::share-post :links="$this->share"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3>{{$item->title}}</h3>
            <div class="detail-content">
                {!! $item->content !!}
            </div>
        </div>
    </section>
</x-theme::root>
