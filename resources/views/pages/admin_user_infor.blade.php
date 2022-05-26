<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Họ tên</th>
        <th scope="col">Email</th>
        <th scope="col">SĐT</th>
        <th scope="col">Ngày sinh</th>
        <th scope="col">Giới tính</th>
        <th scope="col">Địa chỉ</th>
        <th scope="col">Webisite</th>
        <th scope="col">Hành động</th>
    </tr>
    </thead>
    <tbody>
        @foreach($user as $val)
            <tr>
                <td class="text-center">{{$val->name}}</td>
                <td class="text-center text-truncate" style="max-width: 200px" title="{{$val->email}}">{{$val->email}}</td>
                <td class="text-center">{{$val->phone}}</td>
                <td class="text-center">{{$val->birthday}}</td>
                <td class="text-center"><?php if($val->gender == 1) echo 'nam';
                    if($val->gender == 2) echo 'khác';
                    if($val->gender == 3) echo 'nữ';
                ?></td>
                <td class="text-center text-truncate" style="max-width: 250px" title="{{$val->address}}">{{$val->address}}</td>
                <td class="text-center">{{$val->webisite}}</td>
                <td class="text-center">
                    <!-- Example single danger button -->
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Hành động
                        </button>
                        <div class="dropdown-menu" id="listBtnUser">
                            @if($val->is_admin == 1)
                                <span class="dropdown-item" data-userId='{{$val->id}}' data-action="un-admin" href="#">Hủy admin</span>
                            @elseif($val->is_admin == 2)
                                <span class="dropdown-item" data-userId='{{$val->id}}' data-action="un-vendor" href="#">Hủy Vendor</span>
                            @else
                                <span class="dropdown-item" data-userId='{{$val->id}}' data-action="is-admin" href="#">Làm Admin</span>
                                <span class="dropdown-item" data-userId='{{$val->id}}' data-action="is-vendor" href="#">Làm Vendor</span>
                            @endif

                            <span class="dropdown-item" data-userId='{{$val->id}}' data-action="reset-pass" href="#">Đặt lại mật khẩu</span>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<script>
    $('#listBtnUser span').ready(()=>{
        $('#listBtnUser span').click((e)=>{
            $action =e.target.dataset['action']
            $id =e.target.dataset['userid']
            console.log(`/user/${$action}/${$id}`)
            $.get(`/user/${$action}/${$id}`, (data)=>{
                console.log(data, `/user/${$action}/${$id}`)
                if(data == 1){
                    if($action == 'is-admin'){
                        e.target.dataset['action'] = 'un-admin'
                        e.target.innerText = "Hủy admin"
                    }
                    if($action == 'un-admin'){
                        e.target.dataset['action'] = 'is-admin'
                        e.target.innerText = "Làm admin"
                    }
                    if($action == 'un-vendor'){
                        e.target.dataset['action'] = 'is-vendor'
                        e.target.innerText = "Làm vendor"
                    }
                    if($action == 'is-vendor'){
                        e.target.dataset['action'] = 'un-vendor'
                        e.target.innerText = "Hủy vendor"
                    }
                }
            })
        })
    })
</script>
