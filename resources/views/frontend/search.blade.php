@extends('frontend.master')
@section('page_content')
 <!--section-heading-->
 <div class="section-heading " >
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title text-left">
                        <h2>Search resultats for : {{ @$_GET['keyword'] }}</h2>
                        <p class="desc">{{ $search_post->count() }} Articles were found for keyword  <strong> {{ @$_GET['keyword'] }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--blog-layout-1-->
<div class="blog-search">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                 <!--Post1-->
                 @foreach ($search_post as $post)
                <div class="post-list post-list-style1 pt-0">
                    <div class="post-list-image">
                        <a href="{{ route('blog.details', $post->slug) }}">
                            <img src="{{ asset('uploads/post/thumbnail') }}/{{ $post->thumbnail }}" alt="">
                        </a>
                    </div>
                    <div class="post-list-title">
                        <div class="entry-title">
                            <h5>
                                <a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }} </a>
                            </h5>
                        </div>
                    </div>
                    <div class="post-list-category">
                        <div class="entry-cat">
                            <a href="{{ route('category.blog', $post->category_id) }}" class="category-style-1">{{ $post->relate_to_cate->category_name }}</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <!--pagination-->
                <div class="pagination">
                    <div class="pagination-area">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination-list">
                                    <ul class="list-inline">
                                        {{-- <li>{{ $search_post->links('vendor.pagination.custom')}}</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/-->
                </div>
            </div>

             <!--sidebar-->
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

                       <!--categories-->
                       <div class="widget ">
                        <div class="widget-title">
                            <h5>Categories</h5>
                        </div>
                        <div class="widget-categories">
                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/1.jpg" alt="">
                                </div>
                                <p>Design   </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/2.jpg" alt="">
                                </div>
                                <p>Branding </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/3.jpg" alt="">
                                </div>
                                <p>marketing </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/4.jpg" alt="">
                                </div>
                                <p>food </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/5.jpg" alt="">
                                </div>
                                <p>technology </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/6.jpg" alt="">
                                </div>
                                <p>fashion </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/7.jpg" alt="">
                                </div>
                                <p>mobile </p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/8.jpg" alt="">
                                </div>
                                <p>livestyle</p>
                            </a>

                            <a class="category-item" href="#">
                                <div class="image">
                                    <img src="assets/img/categories/9.jpg" alt="">
                                </div>
                                <p>healty </p>
                            </a>


                        </div>
                    </div>
                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">
                                    Subscribe now

                                    </button>
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
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="tags">
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">Travel</a>
                                    </li>
                                    <li>
                                        <a href="#">Nature</a>
                                    </li>
                                    <li>
                                        <a href="#">tips</a>
                                    </li>
                                    <li>
                                        <a href="#">forest</a>
                                    </li>
                                    <li>
                                        <a href="#">beach</a>
                                    </li>
                                    <li>
                                        <a href="#">fashion</a>
                                    </li>
                                    <li>
                                        <a href="#">livestyle</a>
                                    </li>
                                    <li>
                                        <a href="#">healty</a>
                                    </li>
                                    <li>
                                        <a href="#">food</a>
                                    </li>
                                    <li>
                                        <a href="#">interior</a>
                                    </li>
                                    <li>
                                        <a href="#">branding</a>
                                    </li>
                                    <li>
                                        <a href="#">web</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>
                            <ul class="widget-popular-posts">
                                <!--post1-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/1.jpg" alt="">
                                            <small class="nb">1</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Everything is designed. Few things are designed well.</a>
                                        </p>
                                        <small> <span class="slash"></span> 3 mounth ago</small>

                                    </div>
                                </li>

                                <!--post2-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/5.jpg" alt="">
                                            <small class="nb">2</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">Brand yourself for the career you want, not the job you </a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>

                                <!--post3-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/13.jpg" alt="">
                                            <small class="nb">3</small>

                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">It’s easier to ask forgiveness than it is to get permission.</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>

                                    </div>
                                </li>

                                <!--post4-->
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="post-single.html">
                                            <img src="assets/img/blog/16.jpg" alt="">
                                            <small class="nb">4</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="post-single.html">All happiness depends on a leisurely breakfast</a>
                                        </p>
                                        <small> <span class="slash"></span>3 mounth ago</small>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--Ads-->
                        <div class="widget">
                            <div class="widget-ads">
                                <img src="assets/img/ads/ads2.jpg" alt="">
                            </div>
                        </div>
                        <!--/-->
                    </div>
               </div>
            </div>
            <!--/-->
        </div>
    </div>
</div>
@endsection
