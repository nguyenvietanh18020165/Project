<section class="px-3">
    <form action="/product/add" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productName">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName"
                       placeholder="VD: Cherry Mỹ" name="productName">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productPrice">Giá</label>
                <input type="text" class="form-control" id="productPrice"
                       placeholder="VD: 200000 VNĐ" name="productPrice">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productCount">Số lượng</label>
                <input type="text" class="form-control" id="productCount"
                       placeholder="VD: 20" name="productCount">
            </div>
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productImages">Hình ảnh</label>
                <input type="file" class="form-control-file" accept="image/*" multiple name="productImages[]" id="productImages">
            </div>
        </div>
        <div class="form-group">
            <label for="listCtgr">Danh mục</label>
            <select class="form-control" id="listCtgr" name="listCtgr">
                @foreach($category as $val)
                    <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="productDesc">Mô tả sản phẩm</label>
            <textarea class="form-control" name="productDesc" id="productDesc" rows="3"></textarea>
        </div>
        <div class="w-100 text-right mb-3">
            <button class="btn btn-primary" type="submit">Tải lên</button>
        </div>
        @csrf
    </form>
</section>
