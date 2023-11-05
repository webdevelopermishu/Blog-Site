@extends('frontend.master')
@section('page_content')
 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Tag: {{ $tag_info->tag_name }}</h1>
                         <p class="links"><a href="{{ route('index') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>

 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post 1-->
                 @php
                     $flag=true;
                 @endphp
                 @foreach ($posts as $post)
                    @php
                        $after_explode = explode(',', $post->tags);
                    @endphp
                    @if (in_array($tag_info->id, $after_explode))
                        <div class="post-list post-list-style2">
                            <div class="post-list-image">
                                <a href="{{ route('blog.details', $post->slug) }}">
                                    <img class="w-100" src="{{ asset('uploads/post/thumbnail') }}/{{ $post->thumbnail }}" alt="">
                                </a>
                            </div>
                                    <div class="post-list-content">
                                                <h3 class="entry-title">
                                                    <a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a>
                                                </h3>
                                                <ul class="entry-meta">
                                                    @if ($post->relate_to_auth->photo == null)
                                                        <li class="post-author-img"><img width="10" src="{{ Avatar::create($post->relate_to_auth->username)->toBase64() }}"/></li>
                                                    @else
                                                        <li class="post-author-img"><img width="10" src="{{ asset('uploads/author/') }}/{{ $post->relate_to_auth->photo }}" alt="profile"></li>
                                                    @endif
                                                    <li class="post-author"> <a href="{{ route('author.blog', $post->author_id) }}">{{ $post->relate_to_auth->username }}</a></li>
                                                    <li class="entry-cat"> <a href="{{ route('category.blog', $post->category_id) }}" class="category-style-1 "> <span class="line"></span>{{ $post->relate_to_cate->category_name }}</a></li>
                                                    <li class="post-date"> <span class="line"></span> {{ $post->created_at->diffForHumans() }}</li>
                                                </ul>
                                                <div class="post-exerpt">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                        Ut est minus iste in accusantium repellat repudiandae nulla blanditiis iusto dolores!</p>
                                                </div>
                                            <div class="post-btn">
                                                <a href="{{ route('blog.details', $post->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div>
                        </div>
                        @php
                            $flag=false;
                        @endphp
                    @endif
                @endforeach
                @if ($flag)
                <div class="page404 ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <div class="page404-content">
                                   <img width="300" src="{{ asset('frontend') }}/img/other/error404.png" alt="">
                                    <h3>Oops... Post Not Found!</h3>
                                    <p>The category which you are looking for does not exist any post of type. Please return to the homepage.
                                    </p>
                                    <a href="{{ route('index') }}" class="btn-custom">Back to homepage</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
             </div>
         </div>
     </div>
 </section>
@endsection
