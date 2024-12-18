@extends('layouts.master')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">Thanh toán</h2>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <!-- breadcrumb-list start -->
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item"><a href="index.php">trang chủ</a></li>
                                <li class="breadcrumb-item active">Thanh toán</li>
                            </ul>
                            <!-- breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{route('client.place')}}"  method="post">
                @csrf
                <input type="hidden" name="sku" value="{{strtoupper(\Str::random(8))}}">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Chi tiết thanh toán </h3>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Tên</label>
                                        <input type="text" name="name" id="" value="{{$user->name}}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="billing-info mb-20px">
                                        <label>Địa chỉ</label>
                                        <input class="billing-address" name="address" required
                                            value="" type="text" />
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Phone</label>
                                        <input type="text" name="phone" required value="" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Email</label>
                                        <input type="text" required value="{{$user->email}}" />
                                    </div>
                                </div>

                            </div>

                            <div class="checkout-account-toggle open-toggle2 mb-30">
                                <input placeholder="Email address" type="email" />
                                <input placeholder="Password" type="password" />
                                <button class="btn-hover checkout-btn" type="submit">register</button>
                            </div>
                            <div class="additional-info-wrap">
                                <h4>Thông tin thêm</h4>
                                <div class="additional-info">
                                    <label>Ghi chú đặt hàng</label>
                                    <textarea
                                        placeholder="Ghi chú về đơn đặt hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng."
                                        name="message"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                        <div class="your-order-area">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>Sản phẩm</li>
                                            <li>Tổng cộng</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach ($cart as $id => $item)
                                            
                                             <input type="hidden" name="product_id[]" value="{{ $item['id'] }}">
                                             <input type="hidden" name="product_quantity[]" value="{{ $item['quantity'] }}">
                                             <input type="hidden" name="product_price[]" value="{{ $item['price'] }}">
                                             
                                            <li>
                                                <span class="order-middle-left">{{ $item['name'] }}</span>
                                                 <span><img src="{{ Storage::url($item['img']) }}" alt="Product" style="height: 50px" /></span>
                                                 x{{ $item['quantity'] }}
                                                <span class="order-price">{{ $item['total'] }}</span>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="discount-code">
                                            <div class="input-group justify-content-end align-items-center">
                                                <div class="ml-2"> -{{ $discount }}đ </div>
                                                <img style="height: 40px; width:40px" class="img-profile rounded-circle" src="{{ asset('theme/client/assets/images/icons/vch.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="your-order-total">
                                        <ul>
                                            <li class="order-total">Tổng cộng</li>
                                            {{-- <li class="order-total">{{ $item['total'] }}-MÃ giảm giá</li> --}}
                                            <li> {{ $totalAll-$discount }}</li>
                                            <input type="hidden" name="total_price" value="{{ $totalAll - $discount }}">

                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <h5 class="boxtitle">PHƯƠNG THỨC THANH TOÁN</h5>
                                        <div class="form-check">
                                            <input class="form-check-input p-0 btn-rounded" type="radio" value="cash" name="payment_method" id="payment1" checked>
                                            <label class="form-check-label" for="payment1">Trả tiền khi nhận hàng</label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input p-0 btn-rounded" type="radio" name="payment_method" value="vnpay" id="payment3">
                                            <label class="form-check-label" for="payment3">Thanh toán qua Vnpay ATM</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="Place-order mt-25">
                                <input type="text" hidden name="tongtien" value="">
                                <input type="submit" class="btn-hover btn-order" id="orderButton" name="dongydathang" value="Đặt hàng">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-lg-12 d-flex justify-content-lg-end py-3">
                <div class="cart-shiping-update-wrapper">
                    <div class="cart-shiping-update">
                        <a href="index.php?act=cart">Quay lại</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- checkout area end -->
@endsection
