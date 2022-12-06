@extends('layouts.client.client-master')
@section('title-page', 'Favorites')
@section('content')
<style>
    .loader {
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        padding-top: 19%;
        background-color: #f5f5f5;
        padding-left: 48%;
        margin: 0 auto;
        z-index: 9999;
    }
</style>

<div class="osahan-trending" style="padding-bottom: 500px;">
    <!-- Most popular -->
    <div class="input-group mb-4">
        <input type="text" id="search" class="form-control form-control-lg input_search border-right-0" id="inlineFormInputGroup" placeholder="Tìm kiếm ở đây...">
        <div class="input-group-prepend">
            <div class="btn input-group-text bg-white border_search border-left-0 text-primary"><i class="feather-search"></i></div>
        </div>
    </div>
    <div class="loader">
        <img src="{{asset('images/oval.svg')}}" alt="">
    </div>
    <div class="container">
        <div class="most_popular py-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="font-weight-bold text-dark mb-0">Danh sách sản phẩm</h3>
                <a href="#" data-toggle="modal" data-target="#filters" class="ml-auto btn btn-primary">Bộ lọc</a>
            </div>

            <div class="row" id="innerResult">
                @foreach ($products as $product)
                <div class="col-lg-4 mb-3">
                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">
                        <div class="list-card-image">
                            <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                            <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                            <a href="{{ route('product-detail', $product->id) }}">
                                <img alt="#" src="{{asset($product->thumb)}}" class="img-fluid item-img w-100">
                            </a>
                        </div>
                        <p>{{$product->price}}</p>
                        <div class="p-3 position-relative">
                            <div class="list-card-body">
                                <h6 class="mb-1"><a href="{{ route('product-detail', $product->id) }}" class="text-black">{{$product->name}}
                                    </a>
                                </h6>
                                <p class="text-gray mb-3">{{$product->menu->name}}</p>
                                <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                            </div>
                            <div class="list-card-badge">
                                <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bộ lọc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="osahan-filter">
                    <div class="filter">
                        <!-- SORT BY -->
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">Sắp xếp giá thep</h6>
                        </div>
                        <form action="/list-products" method="get">
                            <div class="custom-control border-bottom px-0  custom-radio">
                                <input type="radio" id="customRadio3" value="0" name="price_low_high" class="custom-control-input">
                                <label class="custom-control-label py-3 w-100 px-3" for="customRadio3">Từ thấp đến cao</label>
                            </div>
                            <div class="custom-control border-bottom px-0  custom-radio">
                                <input type="radio" id="customRadio4" value="1" name="price_low_high" class="custom-control-input">
                                <label class="custom-control-label py-3 w-100 px-3" for="customRadio4">Từ cao đến thấp</label>
                            </div>
                            <div class="px-3 pt-3">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Từ</label>
                                        <input class="form-control" name="price_from" placeholder="Từ" type="number">
                                    </div>
                                    <div class="form-group text-right col-6">
                                        <label>Đến</label>
                                        <input class="form-control" name="price_to" placeholder="Đến" type="number">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <a href="#" class="btn border-top btn-lg btn-block" data-dismiss="modal">Đóng</a>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Lọc</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = 1000; //time in ms, 5 seconds for example
    //on keyup, start the countdown
    $('#search').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $('#search').on('keydown', function() {
        $('.loader').css('display', 'block');
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping() {
        var result = document.querySelector('#search').value;
        $.ajax({
            url: '/search/client',
            type: "GET",
            dataType: "JSON",
            data: {
                result: result
            },
            success: function(data) {
                if (data.result == '') {
                    var string = `
                        <div class="col-4"></div>
                        <div class="row d-flex align-items-center justify-content-center py-5">
                            <div class="col-md-4 py-5">
                                <div class="text-center py-5">
                                    <p class="h4 mb-4"><i class="feather-search bg-primary text-white rounded p-2"></i></p>
                                    <p class="font-weight-bold text-dark h5">Không có kết quả</p>
                                    <p>Chúng tôi không tìm thấy món bạn cần, vui lòng thử lại sau.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4"></div>`;
                        $('.loader').fadeOut(1000);
                    $('#innerResult').html(string);
                } else {
                    $('.loader').fadeOut(1000);
                    $('#innerResult').html(data.result);
                }
            },
        });
    }
</script>
@endsection