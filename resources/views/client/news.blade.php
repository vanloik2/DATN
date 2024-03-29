@extends('layouts.client.client-master')
@section('title-page', 'Bài viết')
@section('content')
    <div class="d-none"\>
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <h4 class="font-weight-bold m-0 text-white flex-fill">BeeFood</h4>
            <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
        </div>
    </div>
    <!-- Most popular -->
    <div class="container most_popular py-5">
        <h2 class="font-weight-bold mb-3">Bài viết</h2>
        <div class="row">
            {{-- @dd($news) --}}
            @foreach ($news as $item)
                <div class="col-md-3 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"></div>
                            {{-- <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div> --}}
                            <div class="member-plan position-absolute"><span class="badge badge-dark">News</span></div>
                            <a href="{{ route('news-detail', $item->id) }}">
                                <img alt="#" src="{{ asset($item->image_path) }}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('news-detail', $item->id) }}" class="text-black">{{ $item->title }}
                                    </a>
                                </h6>
                                <p class="mb-3 newsHide">{{ $item->short_desc }}</p>
                                <p class="text-gray mb-3 time">
                                    <span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2">
                                        <i class="feather-user-check"></i>
                                        @foreach ($authors as $auth)
                                            @if ($auth->id == $item->user_id)
                                                {{ $auth->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
