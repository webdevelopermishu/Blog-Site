@extends('admin.Author.main')
@section('page_content')
<div class="row">
    <div class="col-lg-12 m-auto bg-primary">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-center">Add Post</h3>
            </div>
            <div class="card-body">
                <div class="mb-2" align="right">
                    <a href="{{ route('post.list') }}" class="btn btn-success btn-lg">Post List</a>
                </div>
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id  }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title">
                                @error('title')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea id="summernote" name="desq" cols="30" rows="10" class="form-control"></textarea>
                                @error('desq')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Thumbnail</label>
                                <input type="file" name="thumb" class="form-control">
                                @error('thumb')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Cover Image</label>
                                <input type="file" name="cover_image" class="form-control">
                                @error('cover_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Tags</label>
                                <select id="select-tags" name="tags[]" class="demo-default" multiple placeholder="Select tags...">
                                    <option value="">Select tags...</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                  </select>
                                @error('tags')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                            <div class="mb-3 m-auto">
                                <button type="submit" class="btn btn-info btn-lg">Add Post</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
@if (session('posted'))
    <script>
        Swal.fire(
            'Done',
            '{{ session('posted') }}',
            'success'
        )
    </script>
@endif
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#select-tags').selectize({ sortField: 'text' })
        });
</script>
@endsection
