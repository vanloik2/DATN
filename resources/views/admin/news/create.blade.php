@extends('layouts.admin.admin-master')
@section('title', ' Create News')
@section('content')
<div class="main-content">
    <form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="page-header no-gutters has-tab">
            <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                <div class="media align-items-center m-b-15">
                    <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                        <img id="output" src="" alt="">
                    </div>
                    <div class="m-l-15">
                        <p class="text-muted m-b-0" id="name-thumbnail"></p>
                    </div>
                </div>
                <div class="m-b-15">
                    <button class="btn btn-primary">
                        <i class="anticon anticon-save"></i>
                        <span>Save</span>
                    </button>
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">News Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#product-edit-description">Description</a>
                </li>
            </ul>
        </div>
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="product-edit-basic">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-file">
                                <label class="font-weight-semibold" for="">Thumbnail News</label>
                                <input type="file" name="image_path" onchange="loadFile(event)" class="custom-file-input <?php echo $errors->first('image_path') ? 'is-invalid' : ''; ?>" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @if ($errors->first('image_path'))
                                <div class="invalid-feedback">
                                    {{$errors->first('image_path')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="titleNews">News title</label>
                            <input type="text" name="title" class="form-control <?php echo $errors->first('title') ? 'is-invalid' : ''; ?>" id="titleNews" placeholder="News title" value="{{old('title')}}">
                            @if ($errors->first('title'))
                            <div class="invalid-feedback">
                                {{$errors->first('title')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold" for="short_desc">Short description</label>
                            <textarea value="{{old('short_desc')}}" name="short_desc"></textarea>
                            <script>
                                CKEDITOR.replace('short_desc');
                            </script>
                            @if ($errors->first('short_desc'))
                            <div class="invalid-feedback">
                                {{$errors->first('short_desc')}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-edit-description">
                <div class="form-group">
                    <label class="font-weight-semibold" for="content">Content</label>
                    <textarea name="content" value="{{old('content')}}"></textarea>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    @if ($errors->first('content'))
                    <div class="invalid-feedback">
                        {{$errors->first('content')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection