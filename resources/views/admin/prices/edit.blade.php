@extends('layouts.admin.admin-master')
@section('title', ' Sửa giá sản phẩm')
@section('content')
    <div class="main-content">
        <form action="{{ route('prices.update', $prices->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="page-header no-gutters has-tab">
                <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                    <div class="media align-items-center m-b-15">
                    </div>
                    <div class="m-b-15">
                        <button class="btn btn-primary">
                            <i class="anticon anticon-save"></i>
                            <span>Lưu</span>
                        </button>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#product-edit-basic">Thông tin giá</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content m-t-15">
                <div class="tab-pane fade show active" id="product-edit-basic">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productPrice">Giá gốc</label>
                                <input type="text" class="form-control  <?php echo $errors->first('original') ? 'is-invalid' : ''; ?>" id="priceProduct" value="{{ $prices->original }}" name="original">
                                <p>{{$errors->first('original')}}</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold" for="productPrice">Giá giảm</label>
                                <input type="text" class="form-control <?php echo $errors->first('sale') ? 'is-invalid' : ''; ?>"  id="priceProduct" value="{{ $prices->sale }}" name="sale">
                                <p>{{$errors->first('sale')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection