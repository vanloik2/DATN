@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>;
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Orders List</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <a class="breadcrumb-item" href="#">Apps</a>
                    <a class="breadcrumb-item" href="#">E-commerce</a>
                    <span class="breadcrumb-item active">Comments List</span>
                </nav>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check"></i>
                <span class="alert_success">{{ session('success') }}</span>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-7">
                        <div class="d-md-flex">
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
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <input id="checkAll" type="checkbox" disabled>
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Content</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $index => $comment)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-{{ $index + 1 }}" class="check-item"
                                                onclick="checkBox({{ $comment->id }})" value="{{ $comment->id }}"
                                                name="{{ $comment->id }}" type="checkbox">
                                            <label for="check-item-{{ $index + 1 }}" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $comment->id }}
                                    </td>
                                    <td>
                                        {{ $comment->content }}
                                    </td>
                                    <td>{{ $comment->product->name }}</td>
                                    <td>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')" action="">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex align-items-center" style="cursor: pointer">
                                                @if ($comment->active === 1)
                                                    <div id="icon-active{{ $comment->id }}"
                                                        class="badge badge-success badge-dot m-r-10"></div>
                                                    <input type="hidden" id="is-active{{ $comment->id }}"
                                                        value="{{ $comment->active }}">
                                                    <div class="btn-status btn-active{{ $comment->id }}"
                                                        data-id="{{ $comment->id }}">Actived</div>
                                                @else
                                                    <div id="icon-active{{ $comment->id }}"
                                                        class="badge badge-danger badge-dot m-r-10"></div>
                                                    <input type="hidden" id="is-active{{ $comment->id }}"
                                                        value="{{ $comment->active }}">
                                                    <div class="btn-status btn-active{{ $comment->id }}"
                                                        data-id="{{ $comment->id }}">Deactive
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('comments.edit', $comment->id) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </button>
                                        </a>
                                        <form method="POST" class="inline-block"
                                            onsubmit="return confirm('Xác nhận xóa sản phẩm.')"
                                            action="{{ route('comments.destroy', $comment->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="display: flex; justify-content: center">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/handleGeneral/changeStatus.js') }}"></script>
@endsection