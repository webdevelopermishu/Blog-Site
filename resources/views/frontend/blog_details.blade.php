@extends('frontend.master')
@section('page_content')
 <!--post-single-->
 <section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image">
                        <img class="w-100" src="{{ asset('uploads/post/cover_photo') }}/{{ $post_details->cover_image }}" alt="">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2>{{$post_details->title}}</h2>
                            <ul class="entry-meta">
                                @if ($post_details->relate_to_auth->photo == null)
                                    <li class="post-author-img"><img src="{{ Avatar::create($post_details->relate_to_auth->username)->toBase64() }}"/></li>
                                @else
                                    <li class="post-author-img"><img src="{{ asset('uploads/author/') }}/{{ $post_details->relate_to_auth->photo }}" alt="profile"></li>
                                @endif
                                <li class="post-author"> <a href="{{ route('author.blog', $post_details->author_id) }}">{{ $post_details->relate_to_auth->username }}</a>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span>{{$post_details->relate_to_cate->category_name}}</a></li>
                                <li class="post-date"> <span class="line"></span>{{$post_details->created_at->format('d-m-y')}}</li>
                                <li class="post-date"> <span class="line"></span>Total Read: {{ $total_read }}</li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            {!! $post_details->desq !!}
                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>

                                @php
                                    $after_explode = explode(',', $post_details->tags);
                                @endphp
                                <ul class="list-inline">
                                    @foreach ($after_explode as $tags)
                                        <li >
                                            <a href="{{ route('tag.blog', $tags) }}">{{ App\Models\Tag::where('id', $tags)->first()->tag_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    {{-- <div class="social-btn-sp">
                                        {!! $shareButtons !!}
                                    </div> --}}
                                    {{-- {!! Share::page(url('/post/'. $post_details->slug))->facebook()->twitter()->linkedin() !!} --}}
                                    <li>
                                        <a href="https://www.facebook.com/sharer/sharer.php?s={{ url()->current() }}">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="http://www.twitter.com/share?url={{ url()->current() }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="" class="image">
                                        @if ($post_details->relate_to_auth->photo == null)
                                            <img width="10" src="{{ Avatar::create($post_details->relate_to_auth->username)->toBase64() }}"/>
                                        @else
                                            <img width="10" src="{{ asset('uploads/author/') }}/{{ $post_details->relate_to_auth->photo }}" alt="profile">
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>{{ $post_details->relate_to_auth->username }}</h4>
                                    <p> Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                                        Quis sem justo nisi varius.
                                    </p>
                                    <div class="social-media">
                                        <ul class="list-inline">
                                            @foreach ($author_social as $social)
                                            <li>
                                                <a href="">
                                                    <i class="{{ $social->media_icon }}" style="font-family:fontawesome; font-style:normal; background:#77b0b3;"></i>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--post-single-comments-->
                        <div class="post-single-comments">
                            <!--Comments-->
                            <h4 >{{ $comments->where('post_id', $post_details->id)->count() }} Comments</h4>
                            <ul class="comments">
                                <!--comment1-->
                                @foreach ($comments as $comment)
                                    <div class="comments-form my-4" style="background:#b8e2e9">
                                        <li class="comment-item pt-0">
                                            @if ($comment->relate_to_author->photo == null)
                                            <img src="{{ Avatar::create($comment->relate_to_author->username)->toBase64() }}"/>
                                            @else
                                            <img src="{{ asset('uploads/author/') }}/{{ $comment->relate_to_author->photo }}" alt="profile">
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a href="#">{{ $comment->relate_to_author->username }}</a> </li>
                                                        <li class="slash"></li>
                                                        <li>{{ $comment->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $comment->comments }}
                                                </p>
                                                <a href="#reply" data-parent="{{ $comment->id }}" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                            </div>
                                        </li>
                                        <div style="padding-left:100px" class="mt-2 mb-5">
                                            @foreach ($comment->replies as $reply)
                                                <li class="comment-item pt-0">
                                                    @if ($reply->relate_to_author->photo == null)
                                                    <img src="{{ Avatar::create($reply->relate_to_author->username)->toBase64() }}"/>
                                                    @else
                                                    <img src="{{ asset('uploads/author/') }}/{{ $reply->relate_to_author->photo }}" alt="profile">
                                                    @endif
                                                    <div class="content">
                                                        <div class="meta">
                                                            <ul class="list-inline">
                                                                <li><a href="#">{{ $reply->relate_to_author->username }}</a> </li>
                                                                <li class="slash"></li>
                                                                <li>{{ $reply->created_at->diffForHumans() }}</li>
                                                            </ul>
                                                        </div>
                                                        <p>{{ $reply->comments }}
                                                        </p>
                                                        <a href="#reply" data-parent="{{ $comment->id }}" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                            <!--Leave-comments-->
                            @auth('author')
                            <div class="comments-form" id="reply">
                                <h4 >Leave a Reply</h4>
                                <!--form-->
                                <form class="form " action="{{ route('comments.store') }}" method="POST" id="main_contact_form">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="name" class="form-control" placeholder="Name*" value="{{ Auth::guard('author')->user()->username }}" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" id="email" class="form-control" placeholder="Email*" value="{{ Auth::guard('author')->user()->email }}" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="comments" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ $post_details->id }}" name="post_id">
                                        <input type="hidden" id="parent_id" name="parent_id">
                                        <div class="col-lg-12">
                                            {{-- <div class="mb-20">
                                                <input name="name" type="checkbox" value="1" required="required">
                                                <label for="name"><span>save my name , email and website in this browser for the next time I comment.</span></label>
                                            </div> --}}
                                            <button type="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                {{-- <div class="my-3">
                                    <a class="btn btn-primary" href="">Exit to Comment</a>
                                </div> --}}
                                <!--/-->
                            </div>
                            @else
                                <div id="reply" class="mb-1">
                                <a id="rrreply" class="btn btn-info" href="{{ route('author.reg') }}">Sign In</a>
                            </div>
                                <p id="ereply">Sign in to Comment or Reply</p>
                            @endauth
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer_script')
@if (session('commented'))
    <script>
       Swal.fire('{{ session('commented') }}')
    </script>
@endif
<script>
    $('.btn-reply').click(function(){
        var parent_id = $(this).attr('data-parent');
        $('#parent_id').attr('value', parent_id);
        $('#reply').attr('class', 'btn btn-info');
        $('#rreply').attr('class', 'btn btn-danger');
        $('#ereply').attr('class', 'text-danger');
    })
</script>
@endsection
