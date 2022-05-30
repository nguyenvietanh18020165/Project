<table class="table">
    <thead>
    <tr class="text-center">
        <th scope="col">Tiêu đề</th>
        <th scope="col">danh mục sản phẩm</th>
        <th scope="col">danh mục bài viết</th>
        <th scope="col">Admin</th>
    </tr>
    </thead>
    <tbody>
    @foreach($blog as $key => $val)
        <tr class="text-center">
            <td class="text-truncate" style="max-width: 150px" title="{{$val->name}}">{{$val->name}}</td>
            <td>{{$val->category}}</td>
            <td>{{$val->blog_category}}</td>
            <td>{{$val->user_name}}</td>
            <td>
                <button id="" class="btn btn-danger btn_delBlog" data-blogid="{{$val->id}}" data-name="{{$val->name}}">Xóa</button>
                <a href="/tin-tuc/edit/{{$val->id}}"><button id="" class="btn btn-warning btn_editblog" data-blogid="{{$val->id}}" data-name="{{$val->name}}">Sửa</button></a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>
    $(".btn_delBlog").click(function () {
        console.log($(this));
    })
    $(".btn_delBlog").click((data)=>{
        $id = data.currentTarget.attributes['data-blogid'].value;
        $name = data.currentTarget.attributes['data-name'].value;
        $check = confirm("confirm deletion");
        if ($check) {
            $.get("/tin-tuc/delete", {'id': $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-danger "]);
                    $alert.text("deleted " + $name);
                    $cnt_admin = $("#content_admin");
                    $.get('/tin-tuc/admin-show', (data)=>{
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
