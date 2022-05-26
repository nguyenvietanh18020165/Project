<section class="px-3">
    <form action="/tin-tuc/add" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productName">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="BlogName"
                       placeholder="" name="BlogName">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="listCtgr">Danh mục sản phẩm</label>
                <select class="form-control" id="listCtgr" name="listCtgr">
                    @foreach($ctgr as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="listCtgrBlog">Danh mục bài viết</label>
                <select class="form-control" id="listCtgrBlog" name="listCtgrBlog">
                    @foreach($ctgr_blog as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="BlogImage">Ảnh mô tả</label>
                <input type="file" class="form-control-file" accept="image/*" name="BlogImage" id="BlogImage">
            </div>
        </div>

        <div class="form-group">
            <label>Bài viết</label>
            <textarea class="form-control" rows="3" id="BlogNews" name="BlogNews"></textarea>
        </div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogNews');
        </script>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" rows="3" id="" name="BlogDesc"></textarea>
        </div>
        <div class="w-100 text-right mb-3">
            <button class="btn btn-primary" type="submit">Upload</button>
        </div>
        @csrf
    </form>
</section>
