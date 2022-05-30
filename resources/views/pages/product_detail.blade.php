<section class="bg-gray py-2">
    <div class="container">
        <h1 class="mb-0">{{$product->name}}</h1>
        {{ Breadcrumbs::render($breadcrumb, $breadcrumbData) }}
    </div>
</section>
<section class="container my-2">
    <a href="/category" class="text-decoration-none text-dark"><i class="fa-solid fa-angles-left"></i> Trở về danh mục</a>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="w-100" id="images_detail">
                    <img class="w-100" height="450" src="{{ asset($images[0]->path) }}" alt="">
                </div>
                <div class="w-100" id="images_list">
                    <div class="w-auto">
                        @foreach($images as $val)
                            <img class="h-100 list_images_icon" width="120" src="{{ asset($val->path) }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <h3 class="fw-bold">{{$product->name}}</h3>
                <h3 class="fw-bold">{{$product->price}} VNĐ</h3>
                <h5 class="fs-6 fw-bold">
                    Trạng thái: <?php if ($product->count > 0) echo 'Còn hàng'; else echo 'Hết hàng'; ?></h5>
                <div class="d-flex">
                    <span class="d-flex align-items-center ">SỐ LƯỢNG</span>
                    <div class="d-flex ms-2" id="count_quality">
                        <input type="text" style="max-width: 150px !important;"
                               class="form-control px-5 text-center" placeholder=""
                               aria-label="Example text with button addon"
                               value="@if($cart) {{$cart->quality}} @else 0 @endif"
                               aria-describedby="button-addon1"
                               id="valCountQuality">
                        <button type="button" id="removeQlt">-</button>
                        <button type="button" id="addQlt">+</button>
                    </div>
                </div>
                <button id="btn_addPrdDt" class="btn btn-danger mt-3 px-5 py-2" data-prdid="{{$product->id}}">THÊM VÀO GIỎ HÀNG</button>
                <div id="desc_PrdDt" class="border-top border-bottom border-3">
                    <div>
                        <h5>MÔ TẢ SẢN PHẨM</h5>
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                    <p class="show">{{$product->description}}</p>
                </div>

                <div id="shipping_PrdDt" class="border-top border-bottom border-3 mt-2">
                    <div>
                        <h5>VẬN CHUYỂN VÀ HOÀN TRẢ</h5>
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                    <p class="show">
                        
                        <span class="d-inline-block mt-3 fw-bold">Hoàn trả sau 7 ngày</span><br>
                        Giao hàng tận tay <span class="text-danger">3 - 4 NGÀY</span> <br>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
