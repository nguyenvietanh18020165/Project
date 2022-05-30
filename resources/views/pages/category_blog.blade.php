<table class="table">
    <thead>
    <tr>
        <th scope="col"></th>
        <th scope="col">Tên</th>
        <th scope="col"></th>
        <th scope="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCtgrBlog">
                Thêm danh mục
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($ctgr as $key => $val)
        <tr>
            <th scope="row">{{$key}}</th>
            <td>{{$val->name}}</td>
            <td>
                <button class="btn btn-danger btn_delCtgrBlog" data-ctgr="{{$val->id}}" data-name="{{$val->name}}">Xóa</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>

    $(".btn_delCtgrBlog").click((data) => {
        $id = data.currentTarget.attributes['data-ctgr'].value;
        $name = data.currentTarget.attributes['data-name'].value;
        $check = confirm("confirm deletion");
        if ($check) {
            $.get("/tin-tuc/category/delete", {'id': $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-danger "]);
                    $alert.text("deleted " + $name);
                    $.get("/tin-tuc/category", (data) => {
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
</script>
