<section class="px-3">
    <form action="/product/add" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productName">Product's name</label>
                <input type="text" class="form-control" id="productName"
                       placeholder="VD: Áo chống nắng" name="productName">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productPrice">Price</label>
                <input type="text" class="form-control" id="productPrice"
                       placeholder="VD: 60$" name="productPrice">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="productCount">Amount</label>
                <input type="text" class="form-control" id="productCount"
                       placeholder="VD: 60" name="productCount">
            </div>
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productImages">image product</label>
                <input type="file" class="form-control-file" accept="image/*" multiple name="productImages[]" id="productImages">
            </div>
        </div>
        <div class="form-group">
            <label for="listCtgr">Category</label>
            <select class="form-control" id="listCtgr" name="listCtgr">
                @foreach($category as $val)
                    <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="productDesc">Example textarea</label>
            <textarea class="form-control" name="productDesc" id="productDesc" rows="3"></textarea>
        </div>
        <div class="w-100 text-right mb-3">
            <button class="btn btn-primary" type="submit">Upload</button>
        </div>
        @csrf
    </form>
</section>
