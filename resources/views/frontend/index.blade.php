@extends('frontend.master')
@section('page_content')
<!-- blog-slider-->
<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">
                  @foreach ($post_slider as $slider)
                  <div class="blog-item" style="background-image: url('{{ asset('uploads/post/thumbnail') }}/{{ $slider->thumbnail }}')">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="{{ route('category.blog', $slider->category_id) }}" class="category-style-2">{{ $slider->relate_to_cate()->first()->category_name }}</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('blog.details', $slider->slug) }}">{{$slider->title}}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="{{ route('author.blog', $slider->author_id) }}">{{ $slider->relate_to_auth()->first()->username }}</a></li>
                                        <li class="post-date"> <span class="line"></span>{{$slider->created_at->format('M-d-y')}}</li>
                                        <li class="post-date"> <span class="line"></span>{{$slider->created_at->diffForHumans()}}</li>
                                        {{-- <li class="post-timeread"> <span class="line"></span> 15 mins read</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- top categories-->
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">
                        @foreach ($categories as $category)
                        <a class="category-item bg-light text-center" href="{{ route('category.blog', $category->id) }}">
                            <div class="image">
                                <img src="{{ asset('uploads/categories') }}/{{ $category->category_image }}" alt="">
                            </div>
                            <p>{{ $category->category_name }} <span>{{ App\Models\Post::where('category_id', $category->id)->count() }}</span> </p>
                        </a>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent articles-->
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <div class="section-title">
                        <h3>recent Articles </h3>
                        <p>Discover the most outstanding articles in all topics of life.</p>
                    </div>

                    <!--post1-->
                    @foreach ($post_recent as $recent)
                        <div class="post-list post-list-style4">
                            <div class="post-list-image">
                                <a href="{{ route('blog.details', $recent->slug) }}">
                                    <img class="w-100" src="{{ asset('uploads/post/thumbnail') }}/{{ $recent->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <ul class="entry-meta">
                                    <li class="entry-cat">
                                        <a href="{{ route('category.blog', $recent->category_id) }}" class="category-style-1">{{ $recent->relate_to_cate()->first()->category_name }}</a>
                                    </li>
                                    <li class="post-date"> <span class="line"></span>{{$recent->created_at->diffForHumans()}}</li>
                                </ul>
                                <h5 class="entry-title">
                                    <a href="{{ route('blog.details', $recent->slug) }}">{{$recent->title}}</a>
                                </h5>

                                <div class="post-btn">
                                    <a href="{{ route('blog.details', $recent->slug) }}" class="btn-read-more">Continue Reading <i
                                            class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $post_recent->links('vendor.pagination.custom')}}
                    {{-- <div class="my-4">
                        {{ $post_recent->links() }}
                    </div> --}}
                </div>
            </div>
            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <form action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                                    <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                    <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                </form>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>

                            <ul class="widget-popular-posts">
                                <!--post1-->
                                @foreach ($popular_post as $popular)
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="{{ route('blog.details', $popular->relate_to_post->slug) }}">
                                            <img src="{{ asset('uploads/post/thumbnail') }}/{{ $popular->relate_to_post->thumbnail }}" alt="">
                                            <small class="nb">{{ $popular->total_read }}</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="{{ route('blog.details', $popular->relate_to_post->slug) }}">{{ $popular->relate_to_post->title }}</a>
                                        </p>
                                        <small> <span class="slash"></span>{{ $popular->relate_to_post->created_at->diffForHumans() }}</small>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="{{ route('subs.store') }}" class="newslettre-form" method="POST">
                                @csrf
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email Adress">
                                            {{-- required="required"> --}}
                                            @if(session('error'))
                                                <strong class="text-danger">{{ session('error') }}</strong>
                                            @endif
                                    </div>
                                    <button class="btn-custom" type="submit">Subscribe now</button>
                                </div>
                            </form>
                        </div>

                        <!--stay connected-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    @foreach ($socials as $social)
                                    <a href="{{ $social->media_link }}"><div class="item color-facebook">
                                        <a href="{{ $social->media_link }}"><i style="font-family:fontawesome; font-size:24px; font-style:normal; background-color:transparent" class="{{ $social->media_icon }}"></i></a>
                                        <p>{{ $social->media_name }}</p>
                                    </div></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="widget-tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)
                                    <li>
                                        <a href="{{ route('tag.blog', $tag->id) }}">{{ $tag->tag_name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>
@endsection
@section('footer_script')
@if (session('success'))
    <script>
        Swal.fire('{{ session('success') }}')
    </script>
@endif
@endsection
