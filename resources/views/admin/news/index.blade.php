@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Orders List</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                <a class="breadcrumb-item" href="#">Apps</a>
                <a class="breadcrumb-item" href="#">E-commerce</a>
                <span class="breadcrumb-item active">Orders List</span>
            </nav>
        </div>
    </div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        <div class="d-flex align-items-center justify-content-start">
            <span class="alert-icon">
                <i class="anticon anticon-check-o"></i>
            </span>
            <span>{{session()->get('success')}}</span>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-8">
                    <div class="d-md-flex">
                        <div class="m-b-10 m-r-15">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Catergory</option>
                                <option value="all">All</option>
                                <option value="homeDeco">Home Decoration</option>
                                <option value="eletronic">Eletronic</option>
                                <option value="jewellery">Jewellery</option>
                            </select>
                        </div>
                        <div class="m-b-10">
                            <select class="custom-select" style="min-width: 180px;">
                                <option selected>Status</option>
                                <option value="all">All</option>
                                <option value="inStock">In Stock </option>
                                <option value="outOfStock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-right">
                    <a href="{{route('news.create')}}" class="btn btn-primary">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        <span>Add</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Active</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td><img width="100px" src="{{asset('img/news/' . $item->image_path)}}" alt=""></td>
                            @if($item->active === 0)
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="badge badge-danger badge-dot m-r-10"></div>
                                    <div>Private</div>
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="badge badge-success badge-dot m-r-10"></div>
                                    <div>Public</div>
                                </div>
                            </td>
                            @endif
                            <td class="text-right">
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                    <i class="anticon anticon-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection