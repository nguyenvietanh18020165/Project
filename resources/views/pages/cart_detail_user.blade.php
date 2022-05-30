<section class="container my-3">
    <div class="showCart p-3 rounded-3 border bg-white pb-0">
        <h1>Giỏ hàng của bạn</h1>
        <div class="table-responsive">
            <table class="table table-borderless text-center">
                <thead>
                <tr>
                    <th scope="col" style="width: 300px">Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $val)
                    <tr>
                        <td>
                            <div class="card shadow-none mb-3 border-0 me-0" style="width: 300px;background: #fff0">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="{{asset($val->images)}}" class="img-fluid rounded-start"
                                             alt="...">
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
                            <div class="d-flex ms-2 count_qualityCart align-items-center mx-auto" style="width: 90px">
                                <input type="text" style="max-width: 90px !important;"
                                       data-idcart="{{$val->carts_id}}"
                                       class="form-control px-4 text-center valCountQualityCart" placeholder=""
                                       
                                       value="{{$val->quality}}"
                                       aria-describedby="button-addon1">
                                <button type="button" class="removeQltCart">-</button>
                                <button type="button" class="addQltCart">+</button>
                            </div>
                        </td>
                        
                        <td class="h-100"><span class="w-100 text-center d-inline-block">{{$val->price}} VNĐ</span></td>
                        <td>
                            <button class="btn btn-danger btn_delCart" data-idcart="{{$val->carts_id}}">Xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
    <div class="w-100 bg-danger rounded-bottom text-right p-4 text-white">
        <span class="me-2 fw-bold">Tổng tiền: </span>
        <span class=" fw-bold" id="sumMoneyCart">
                    <?php
            $sum = 0;
            foreach ($product as $val) {
                $sum += $val->price * $val->quality;
            }
            echo $sum;
            ?>
               VNĐ </span>
    </div>
</section>

<script>
    $(".addQltCart").ready(() => {
        $(".addQltCart").click((data) => {
            $ip = $($(data.originalEvent.path[1])[0].children[0]);
            $id = $ip[0].attributes[2].value;
            $.get("/product/cart/quality/get",
                {
                    'id': $id,
                    'quality': Number($ip.val()) + 1
                }, (data) => {
                    data = JSON.parse(data);
                    $ip.val(data.quality);
                    $("#sumMoneyCart").text(data.money)
                });
        })
        $(".removeQltCart").click((data) => {
            $ip = $($(data.originalEvent.path[1])[0].children[0]);
            $id = $ip[0].attributes[2].value;
            $.get("/product/cart/quality/get",
                {
                    'id': $id,
                    'quality': Number($ip.val()) - 1
                }, (data) => {
                    data = JSON.parse(data);
                    $ip.val(data.quality);
                    $("#sumMoneyCart").text(data.money)
                });
        })

        $(".valCountQualityCart").change((data) => {
            $ip = $($(data.originalEvent.path[1])[0].children[0]);
            $id = $ip[0].attributes[2].value;
            $.get("/product/cart/quality/get",
                {
                    'id': $id,
                    'quality': Number($ip.val())
                }, (data) => {
                    data = JSON.parse(data);
                    $ip.val(data.quality);
                    $("#sumMoneyCart").text(data.money)
                });
        });
        $(".btn_delCart").click((data) => {
            $check = confirm("Bạn thự sự muốn xóa");
            if($check){
                $id = $(data.originalEvent.path[0]).attr('data-idCart');
                $tr = $(data.originalEvent.path[2]);
                $alert = $("#alert_admin");
                $.get("/product/cart/delete", {'id': $id}, (data)=>{
                    if(data){
                        $alert.addClass(["show", "alert-danger "]);
                        $alert.text("Deleted");
                        $tr.addClass("d-none");
                        $("#sumMoneyCart").text(data);
                        setTimeout(() => {
                            $alert.removeClass(["show", "alert-danger"]);
                            $alert.text("");
                        }, 2000);
                    }
                });
            }
        });
    });
</script>
