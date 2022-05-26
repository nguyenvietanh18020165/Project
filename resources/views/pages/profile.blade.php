<script>
    const handleChangeAvatar = ()=>{
        $file = $("#avatar")[0].files
        document.getElementById('imgAvatar').src = URL.createObjectURL($("#avatar")[0].files[0])
        console.log(document.getElementById('avatar').src)
    }
</script>
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<section class="container mt-2">
    <form class="row g-3" action="/profile/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12 col-sm-6 col-md-4 avatar_pofile">
            <img id="imgAvatar" class="w-100" src="{{$infor? asset($infor->avatar) :'/upload/images/logo.png'}}" alt="">
            <label for="avatar" class="btn btn-outline-info">Thay đổi</label>
            <input id="avatar" name="avatar" type="file" hidden onchange={handleChangeAvatar()}>

        </div>
        <div class="col-12 col-sm-6 col-md-8">
            <div class="row">

                <div class="col-md-6">
                    <label for="name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="birthday" class="form-label">Ngày sinh</label>
                    <input type="text" class="form-control" name="birthday" id="birthday" autocomplete="off" value="{{$infor ? $infor->birthday: ""}}">
                    <script>
                        $( function() {
                            $( "#birthday" ).datepicker({dateFormat: 'yy-mm-dd'});
                        } );
                    </script>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Giới tính</label>
                    <select id="gender" name="gender" class="form-select">
                        @if(isset($infor))
                            <option {{$infor->gender == 1 ? 'selected': ""}} value="1">Nam</option>
                            <option {{$infor->gender == 3 ? 'selected': ""}} value="3">Nữ</option>
                            <option {{$infor->gender == 2 ? 'selected': ""}} value="2">Khác</option>
                        @else
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                            <option value="2">Khác</option>
                        @endif

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$infor ? $infor->phone: ""}}">
                </div>
                <div class="col-md-6">
                    <label for="webisite" class="form-label">Webisite</label>
                    <input type="text" class="form-control" name="webisite" id="webisite" value="{{$infor ? $infor->webisite: ""}}">
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="" value="{{$infor ? $infor->address: ""}}">
                </div>

                <div class="col-12 w-100 text-center mt-3">
                    <button type="submit" class="btn btn-primary px-5 py-2">Lưu</button>
                </div>

            </div>
        </div>
    </form>
</section>
