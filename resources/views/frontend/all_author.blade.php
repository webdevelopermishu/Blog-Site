@extends('frontend.master')
@section('page_content')
<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title ">
                        <h1>All Authors</h1>
                        <p class="links"><a href="{{ route('index') }}">Home <i class="las la-angle-right"></i></a> pages</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--blog-layout-1-->
<div class="authors ">
    <div class="container-fluid">
        <div class="authors-area">
            <div class="row">
                <!--author-1-->
                @foreach ($authors_list as $author_list)
                    <div class="col-md-6 ">
                        <div class="authors-single">
                            <div class="authors-single-image">
                                <a href="{{ route('author.blog', $author_list->id) }}">
                                    @if ($author_list->photo == null)
                                        <img width="10" src="{{ Avatar::create($author_list->username)->toBase64() }}"/>
                                    @else
                                        <img width="10" src="{{ asset('uploads/author/') }}/{{ $author_list->photo }}" alt="profile">
                                    @endif
                                </a>
                            </div>
                            <div class="authors-single-content ">
                                <div class="left">
                                    <h6> <a href="{{ route('author.blog', $author_list->id) }}">{{ $author_list->username }}</a></h6>
                                    <p >{{ App\Models\Post::where('author_id', $author_list->id)->count() }} articles</p>
                                </div>
                                <div class="right">
                                    <a href="{{ route('author.blog', $author_list->id) }}">
                                        <div class="more-icon">
                                            <i class="las la-angle-double-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--pagination-->
<div class="pagination">
    <div class="container-fluid">
        <div class="pagination-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-list">
                        <ul class="list-inline">
                            <li>{{ $authors_list->links('vendor.pagination.custom')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
