<section class="px-3">
    <form action="/product/edit" method="post" enctype="multipart/form-data">
        <input type="text" value="{{$product->id}}" name="productId" hidden>
        <div class="row">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName"
                       placeholder="VD: Cherry Mỹ" name="productName" value="{{$product->name}}">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productPrice">Giá</label>
                <input type="text" class="form-control" id="productPrice"
                       placeholder="VD: 200000 VNĐ" name="productPrice" value="{{$product->price}}">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productCount">Số lượng</label>
                <input type="text" class="form-control" id="productCount"
                       placeholder="VD: 20" name="productCount" value="{{$product->count}}">
            </div>
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productImages">Ảnh sản phẩm</label>
                <input type="file" class="form-control-file" accept="image/*" multiple name="productImages[]"
                       id="productImages">
            </div>
        </div>
        <div class="row">
            @foreach($images as $val)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 mt-3" id="delImg{{$val->id}}">
                    <img src="{{ asset($val->path) }}" alt="" class="w-100">
                    <button class="w-100 btn btn-danger btn_delImages" type="button" data-imagesid="{{$val->id}}">Xóa</button>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="listCtgr">Danh mục</label>
            <select class="form-control" id="listCtgr" name="listCtgr">
                @foreach($category as $val)
                    @if($val->id == $product->category_id)
                        <option value="{{$val->id}}" selected>{{$val->name}}</option>
                    @else
                        <option value="{{$val->id}}">{{$val->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="productDesc">Mô tả sản phẩm</label>
            <textarea class="form-control" name="productDesc" id="productDesc"
                      rows="3">{{$product->description}}</textarea>
        </div>
        <div class="w-100 text-right mb-3">
            <button class="btn btn-primary" type="submit">Cập nhật</button>
        </div>
        @csrf
    </form>
</section>

<script>
    $(".btn_delImages").click((data)=>{
        $id = data.currentTarget.attributes['data-imagesid'].value;
        $obj = data;
        $check = confirm("Note After confirmation will delete immediately and cannot restore");
        if ($check) {
            $.get("/product/images/delete", {'id': $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-danger "]);
                    $alert.text("deleted");
                    $obj.currentTarget.offsetParent.style.display = "none";
                    setTimeout(() => {
                        $alert.removeClass(["show", "alert-danger"]);
                        $alert.text("");
                    }, 2000)
                } else {

                }
            });
        }
    })
</script>
