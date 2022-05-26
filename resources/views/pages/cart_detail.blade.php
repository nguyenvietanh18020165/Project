<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Phương thức thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active list_payment_modal" data-bs-dismiss="modal">Thanh toán khi nhận hàng</button>
                    <button type="button" class="list-group-item list-group-item-action list_payment_modal" data-bs-dismiss="modal">Thanh toán momo</button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="container my-3">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-8">
            <div class="showCart p-3 rounded-3 border bg-gray pb-0">
                <h1>Your Cart</h1>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 300px">Product</th>
                            <th scope="col">Quatity</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product as $val)
                            <tr>
                                <td>
                                    <div class="card mb-3 border-0 me-0" style="width: 300px;background: #fff0">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <img src="{{asset($val->images)}}" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body py-0">
                                                    <h5 class="card-title">{{$val->name}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex ms-2 count_qualityCart align-items-center" style="width: 90px">
                                        <input type="text" style="max-width: 90px !important;"
                                               data-idcart="{{$val->carts_id}}"
                                               class="form-control px-4 text-center valCountQualityCart" placeholder=""
                                               aria-label="Example text with button addon"
                                               value="{{$val->quality}}"
                                               aria-describedby="button-addon1"
                                               {{isset($user_payment->status)? 'disabled' : ''}}
                                        >
                                        @if(!isset($user_payment->status))
                                            <button type="button" class="removeQltCart">-</button>
                                            <button type="button" class="addQltCart">+</button>
                                        @endif

                                    </div>
                                </td>
                                <td></td>
                                <td class="h-100 d-flex align-items-center">${{$val->price}}</td>
                                @if(!isset($user_payment->status))
                                    <td><button class="btn btn-danger btn_delCart" data-idcart="{{$val->carts_id}}">Delete</button></td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="w-100 bg-danger rounded-bottom text-end p-4 text-white">
                <span class="me-2 fw-bold">Total</span>
                <span class=" fw-bold" id="sumMoneyCart">$
                    <?php
                    $sum = 0;
                        foreach ($product as $val){
                            $sum += $val->price*$val->quality;
                        }
                        echo $sum;
                    ?>
                </span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 p-0">
           <div class="w-100 list_info_cart bg-gray p-3">
               <h3>Thông tin thanh toán</h3>
               <div class="row">
                   <div class="col-12 col-sm-4">Họ tên: </div>
                   <div class="col-12 col-sm-8">{{Auth::user()->name}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Số điện thoại: </div>
                   <div class="col-12 col-sm-8">{{isset($user_info->phone) ? $user_info->phone : ""}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Địa chỉ: </div>
                   <div class="col-12 col-sm-8">{{isset($user_info->address) ? $user_info->address : ""}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Ngày sinh: </div>
                   <div class="col-12 col-sm-8">{{isset($user_info->birthday)? $user_info->birthday : ""}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Tổng tiền: </div>
                   <div class="col-12 col-sm-8" id="sumMoneyPay">{{$sum}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Phương thức thanh toán: </div>
                   <div class="col-12 col-sm-8 pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           <span id="btn_modal" class="text-danger text-capitalize" data-typeship="0">Thanh toán khi nhận hàng</span>
                       <i class="bi bi-chevron-double-right"></i>
                   </div>
               </div>
               <h4>Trạng thái</h4>
               <div class="row">
                   <div class="col-12 col-sm-4">Thanh toán: </div>
                   <div class="col-12 col-sm-8" id="sumMoneyPay">{{isset($user_payment->payment) ? $user_payment->payment : 'Chưa thanh toán'}}</div>
               </div>
               <div class="row">
                   <div class="col-12 col-sm-4">Đơn hàng: </div>
                   @if(isset($user_payment->status))
                       @if($user_payment->status == 1)
                           <div class="col-12 col-sm-8" id="sumMoneyPay">Chờ xác nhận</div>
                       @endif
                       @if($user_payment->status == 2)
                           <div class="col-12 col-sm-8" id="sumMoneyPay">Đăng giao hàng</div>
                       @endif
                       @if($user_payment->status == 3)
                           <div class="col-12 col-sm-8" id="sumMoneyPay">Chờ xác nhận hủy đơn</div>
                       @endif
                   @else
                           <div class="col-12 col-sm-8" id="sumMoneyPay">Chưa đặt hàng</div>
                   @endif

               </div>
               <div class="w-100 mt-2">
                   <form action="/payment/momo-atm" class="text-center" method="POST">
                       @csrf
                       <input type="hidden" id="sumPayment" name="total_momo" value="{{$sum}}" />
                       @if(isset($user_payment->status))
                           @if($user_payment->status == 1)
                               <a href="/payment/cancel" class="btn btn-primary px-3" type="button">Hủy đơn</a>
                           @endif
                       @else
                           <button class="btn btn-primary px-3" type="button" id="btnPayment">Đặt hàng</button>
                       @endif

                   </form>
               </div>
           </div>
        </div>
    </div>
</section>
