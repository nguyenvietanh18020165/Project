<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
        <th scope="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCtgr">
                Add Category
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($category as $key => $val)
        <tr>
            <th scope="row">{{$key}}</th>
            <td>{{$val->name}}</td>
            <td>
                <button class="btn btn-danger btn_delCtgr" data-ctgr="{{$val->id}}" data-name="{{$val->name}}">Delete</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<script>

    $(".btn_delCtgr").click((data) => {
        $id = data.currentTarget.attributes['data-ctgr'].value;
        $name = data.currentTarget.attributes['data-name'].value;
        $check = confirm("confirm deletion");
        if ($check) {
            $.get("/product/category/delete", {'id': $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-danger "]);
                    $alert.text("deleted " + $name);
                    $.get("/product/category", (data) => {
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
