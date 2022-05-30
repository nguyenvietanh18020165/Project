{{--{{$user}}--}}
<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Tên</th>
        <th scope="col">Email</th>
        <th scope="col">Tổng sản phẩm</th>
        <th scope="col">Tổng tiền</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $key => $val)
        <tr class="text-center">
            <th scope="row">{{$val->name}}</th>
            <td class="text-truncate" style="max-width: 150px" title="{{$val->email}}">{{$val->email}}</td>
            <?php
            $sumPrd = 0;
            $sumMoney = 0;
            foreach ($val->carts as $cart) {
                $sumPrd += $cart->quality;
                $sumMoney += $cart->product->price * $cart->quality;
            }
            ?>
            <td>{{$sumPrd}}</td>
            <td>{{$sumMoney}}</td>
            <td>
                <button id="" class="btn btn-danger btn_cartDetail" data-toggle="modal" data-target="#modalCart"
                        data-cartId="{{$val->id}}">Chi tiết
                </button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $(".btn_cartDetail").click((data) => {
        $id = data.currentTarget.attributes['data-cartId'].value;
        $.get("/product/cart/detail-card-of-user", {'id': $id}, (data) => {
            if (data) {
                $("#modalCartBody").html(data);
            } else {

            }
        });
    });
</script>
