@extends('frontend.master')
@section('page_content')
 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                        <a class="category-item bg-light text-center">
                            <div class="image">
                                <img src="{{ asset('uploads/categories') }}/{{ $category_info->category_image }}" alt="">
                            </div>
                            <span>{{ App\Models\Post::where('category_id', $category_info->id)->count() }}</span>
                        </a>
                         <h1>{{ $category_info->category_name }}</h1>
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
                 @foreach ($category_blogs as $cate_blog)
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="{{ route('blog.details', $cate_blog->slug) }}">
                                <img class="w-100" src="{{ asset('uploads/post/thumbnail') }}/{{ $cate_blog->thumbnail }}" alt="">
                            </a>
                        </div>
                            <div class="post-list-content">
                                    <h3 class="entry-title">
                                    <a href="{{ route('blog.details', $cate_blog->slug) }}">{{ $cate_blog->title }}</a>
                                </h3>
                                <ul class="entry-meta">
                                    @if ($cate_blog->relate_to_auth->photo == null)
                                        <li class="post-author-img"><img width="10" src="{{ Avatar::create($cate_blog->relate_to_auth->username)->toBase64() }}"/></li>
                                    @else
                                        <li class="post-author-img"><img width="10" src="{{ asset('uploads/author/') }}/{{ $cate_blog->relate_to_auth->photo }}" alt="profile"></li>
                                    @endif
                                    <li class="post-author"> <a href="{{ route('author.blog', $cate_blog->author_id) }}">{{ $cate_blog->relate_to_auth->username }}</a></li>
                                    <li class="entry-cat"> <a href="{{ route('category.blog', $cate_blog->category_id) }}" class="category-style-1 "> <span class="line"></span>{{ $category_info->category_name }}</a></li>
                                    <li class="post-date"> <span class="line"></span> {{ $cate_blog->created_at->diffForHumans() }}</li>
                                    </ul>
                                <div class="post-exerpt">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Ut est minus iste in accusantium repellat repudiandae nulla blanditiis iusto dolores!</p>
                                </div>
                                <div class="post-btn">
                                    <a href="{{ route('blog.details', $cate_blog->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                    </div>
                @endforeach
             </div>
         </div>
     </div>
 </section>
@endsection
