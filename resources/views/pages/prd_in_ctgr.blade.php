<section class="container">
    <h3 class="text-center mt-3">Danh mục: <span class="fs-3">{{$ctgr}}</span></h3>
    <div class="row latest_product product_hot_home" id="listSearch">
        @foreach($product as $val)
            <div class="col-6 col-sm-4 col-md-4 col-lg-4 mt-2">
                <div class="position-relative">
                    <img class="w-100" height="300" src="{{ asset($val->images) }}" alt="Owl Image">
                    <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    if(strtotime(date('Y-m-d H:i:s')) - strtotime($val->created_at) <= 604800){
                    ?>
                    <span class="card_new bg-success position-absolute rounded-pill">NEW</span>
                    <?php
                    }
                    ?>
                    @if($val->is_top == 1)
                        <span class="card_hot bg-danger position-absolute rounded-pill">HOT </span>
                    @endif
                    <div class="btn_icon position-absolute text-end">
                    <span class="cart d-block btn_addcart" data-prdid="{{$val->id}}">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span>THÊM VÀO GIỎ HÀNG</span>
                    </span>
                        <span class="like mt-2">
                        <i class="fa-solid fa-heart"></i>
                    </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-8"><a href="/product/{{$val->slug}}"
                                                             class="d-inline-block text-truncate text-decoration-none w-100 text-dark">{{$val->name}}</a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 text-end">${{$val->price}}</div>
                </div>
            </div>
        @endforeach
    </div>
{{--    <div class="w-100 text-center mt-2">--}}
{{--        <button class="btn btn-primary px-4 py-2" id="btnCtgrMore">see more</button>--}}
{{--    </div>--}}
</section>
