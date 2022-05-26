{{--{{$user}}--}}
<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">gross product</th>
        <th scope="col">total money</th>
        <th scope="col">Action</th>
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
                        data-cartId="{{$val->id}}">Detail
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
