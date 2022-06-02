<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Mã</th>
        <th scope="col">Tên</th>
        <th scope="col">Danh mục</th>
        <th scope="col">Giá</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Nổi bật</th>
    </tr>
    </thead>
    <tbody>
    @foreach($product as $key => $val)
        <tr class="text-center">
            <th scope="row">{{$val->code}}</th>
            <td class="text-truncate" style="max-width: 150px" title="{{$val->name}}">{{$val->name}}</td>
            <td>{{$val->ctgr_name}}</td>
            <td>{{$val->price}}</td>
            <td>{{$val->count}}</td>
            <td>
                <input type="checkbox" class="listCkbPrdA" data-idPrd="{{$val->id}}" <?php if($val->is_top == 1) echo "checked"; ?> >
            </td>
            <td>
                <button id="" class="btn btn-danger btn_delPrd" data-prdid="{{$val->id}}" data-name="{{$val->name}}">Xóa</button>
                <a href="/product/edit/{{$val->id}}"><button id="" class="btn btn-warning btn_editPrd" data-prdid="{{$val->id}}" data-name="{{$val->name}}">Sửa</button></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $(".btn_delPrd").click(function () {
        console.log($(this));
    })
    $(".btn_delPrd").click((data)=>{
        $id = data.currentTarget.attributes['data-prdid'].value;
        $name = data.currentTarget.attributes['data-name'].value;
        $check = confirm("confirm deletion");
        if ($check) {
            $.get("/product/delete", {'id': $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-danger "]);
                    $alert.text("deleted " + $name);
                    $cnt_admin = $("#content_admin");
                    $.get('/product/get', (data)=>{
                        $cnt_admin.html(data);
                    })
                    setTimeout(() => {
                        $alert.removeClass(["show", "alert-danger"]);
                        $alert.text("");
                    }, 2000)
                } else {

                }
            });
        }

    });
    $(".listCkbPrdA").ready(()=>{
        $(".listCkbPrdA").click((ip)=>{
            $input = $(ip.originalEvent.path[0]);
            $id = $input[0].dataset.idprd;
            if ($input[0].checked){
                $.get("/product/is_top", {
                    'id' : $id,
                    'action' : 1
                }, (data)=>{
                    if(data){
                        $alert.addClass(["show", "alert-success "]);
                        $alert.text("Featured products");
                        setTimeout(() => {
                            $alert.removeClass(["show", "alert-success"]);
                            $alert.text("");
                        }, 2000)
                    }
                })
            }else{
                $.get("/product/is_top", {
                    'id' : $id,
                    'action' : 0
                }, (data)=>{
                    if(data){
                        $alert.addClass(["show", "alert-danger "]);
                        $alert.text("Featured products");
                        setTimeout(() => {
                            $alert.removeClass(["show", "alert-danger"]);
                            $alert.text("");
                        }, 2000)
                    }
                })
            }
        })
    })
</script>
