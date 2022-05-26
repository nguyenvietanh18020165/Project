<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Họ tên</th>
        <th scope="col">Email</th>
        <th scope="col">SĐT</th>
        <th scope="col">Địa chỉ</th>
        <th scope="col">Thanh toán</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Hành động</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $val)
        <tr>
            <td class="text-center">{{$val->user->name}}</td>
            <td class="text-center text-truncate" style="max-width: 200px" title="{{$val->user->email}}">{{$val->user->email}}</td>
            <td class="text-center">{{$val->user->phone}}</td>
            <td class="text-center text-truncate" style="max-width: 250px" title="{{$val->user->address}}">{{$val->user->address}}</td>
            <td class="text-center">{{$val->payment}}</td>
            <td class="text-center">
                @if($val->status == 0)
                    Thành công
                @endif
                @if($val->status == 1)
                    Chờ xác nhận
                @endif
                @if($val->status == 2)
                    Đang giao hàng
                @endif
                @if($val->status == 3)
                    Chờ xác nhận hủy
                @endif
            </td>
            <td class="text-center">
                <!-- Example single danger button -->
                <div class="btn-group dropleft">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Hành động
                    </button>
                    <div class="dropdown-menu" id="listBtnOrder">
                        @if($val->status == 0)
                            <span class="dropdown-item pointer " data-userId='{{$val->user->id}}' data-action="cancel" href="#">Xóa</span>
                        @endif
                        @if($val->status == 1)
                            <span class="dropdown-item pointer " data-userId='{{$val->user->id}}' data-action="active" href="#">Xác nhận đơn</span>
                        @endif
                        @if($val->status == 2)
                            <span class="dropdown-item pointer" data-userId='{{$val->user->id}}' data-action="done" href="#">Đã giao</span>
                        @endif
                        @if($val->status == 3)
                            <span class="dropdown-item pointer" data-userId='{{$val->user->id}}' data-action="cancel" href="#">Xác nhận hủy</span>
                        @endif

                    </div>
                </div>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $('#listBtnOrder span').ready(()=>{
        $('#listBtnOrder span').click((e)=>{
            $action =e.target.dataset['action']
            $id =e.target.dataset['userid']
            console.log(`/payment/admin/${$action}/${$id}`)
            $.get(`/payment/admin/${$action}/${$id}`, (data)=>{
                console.log(data)
            })
        })
    })
</script>
