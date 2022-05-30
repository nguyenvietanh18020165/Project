<script>
    const handleChangeAvatar = ()=>{
        $file = $("#BlogImage")[0].files
        document.getElementById('imgAvatar').src = URL.createObjectURL($("#BlogImage")[0].files[0])
        console.log(document.getElementById('BlogImage').src)
    }
</script>
<section class="px-3">
    <form action="/tin-tuc/update/{{$blog->id}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-12 col-sm-6 col-md-6">
                <label for="productName">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="BlogName"
                       placeholder="" name="BlogName" value="{{$blog->name}}">
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="listCtgr">Danh mục sản phẩm</label>
                <select class="form-control" id="listCtgr" name="listCtgr">
                    @foreach($ctgr as $val)
                        @if($val->id == $blog->category)
                            <option value="{{$val->id}}" selected>{{$val->name}}</option>
                        @else
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endif

                    @endforeach
                </select>
            </div>
            <div class="form-group col-12 col-sm-3 col-md-3">
                <label for="listCtgrBlog">Danh mục bài viết</label>
                <select class="form-control" id="listCtgrBlog" name="listCtgrBlog">
                    @foreach($ctgr_blog as $val)
                        @if($val->id == $blog->blog_category)
                            <option value="{{$val->id}}" selected>{{$val->name}}</option>
                        @else
                            <option value="{{$val->id}}">{{$val->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 avatar_pofile">
                <h3>Ảnh mô tả</h3>
                <img id="imgAvatar" class="w-100" src="{{asset($blog->image)}}" alt="">
                <label for="BlogImage" class="btn btn-outline-info">Thay đổi</label>
                <input id="BlogImage" name="BlogImage" type="file" hidden onchange={handleChangeAvatar()}>
            </div>
        </div>

        <div class="form-group">
            <label>Bài viết</label>
            <textarea class="form-control" rows="3" id="BlogNews" name="BlogNews">{{$blog->desc}}</textarea>
        </div>
        <script type="text/javascript">
            CKEDITOR.replace( 'BlogNews');
        </script>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" rows="3" id="" name="BlogDesc"></textarea>
        </div>
        <div class="w-100 text-right mb-3">
            <button class="btn btn-primary" type="submit">Tải lên</button>
        </div>
        @csrf
    </form>
</section>
