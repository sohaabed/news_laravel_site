<x-home-component>

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('home')}}">News</a></li>
                <li class="breadcrumb-item active">News details</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="sn-container">
                        <div class="sn-img">
                            <img src="{{$content->image_url}}" />
                        </div>
                        <div class="sn-content">
                            <h1 class="sn-title">{{$content->short_description}}</h1>

                            {!!$content->new_content!!}

                            @if($content->images!=null)
                            @foreach($content->images as $image)
                            <div>
                                <img style="margin-bottom: 10px !important;" src="{{$image->image_url}}" width="750">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">

                            @foreach($category->contents as $cont)
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{$cont->image_url}}" />
                                    <div class="sn-title">
                                        <a href="{{route('home.show',$cont->id)}}"> {{$cont->short_description}} </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach($category->contents as $cont)
                                <div class="nl-item">
                                    <div class="nl-img">
                                        <img src="{{$cont->image_url}}" />
                                    </div>
                                    <div class="nl-title">
                                        <a href="{{route('home.show',$cont->id)}}">{{$cont->short_description}}</a>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                            </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <div id="popular" class="container tab-pane active">
                                        @foreach($popular as $pop)
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{$pop->image_url}}" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="{{route('home.show',$pop->id)}}">{{$pop->short_description}}</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>


                                        <div id="latest" class="container tab-pane fade">
                                            @foreach($latest as $lat)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{$lat->image_url}}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{route('home.show',$lat->id)}}">{{$lat->short_description}}</a>
                                                </div>
                                            </div>
                                            @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($categories as $category)
                                    <li><a href="{{ route('home')}}/#{{$category->title}}">{{$category->title}}</a><span>{{$category->visitor}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->

</x-home-component>