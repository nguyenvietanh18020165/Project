<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="resetPass" tabindex="-1" aria-labelledby="resetPassLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resetPassLabel">Đổi mật khẩu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                  <label for="pwNow" class="form-label">Mật khẩu hiện tại</label>
                  <input type="password" required class="form-control" id="pwNow" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="pwNew" class="form-label">Mật khẩu mới</label>
                  <input type="password" required class="form-control" id="pwNew">
                </div>
                <div class="mb-3">
                    <label for="rpwNew" class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" required class="form-control" id="rpwNew">
                  </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-primary" id="rpassword">Thay đổi</button>
        </div>
      </div>
    </div>
  </div>
<div class="bg-black menu_header">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Trang chủ</a>
            </li>
            <li class="nav-item menu_our_shop">
                <a class="nav-link" id="linkHeaderCtgr" href="/category">Sản phẩm</a>
                <ul class="list-group menu_our_c2" id="list_category">
                    <li class="list-group-item"><a href="">Không có sản phẩm</a></li>
                </ul>
                <script>
                    const handleClick = (id)=>{
                        localStorage.setItem('category', id);
                        window.location = '/category'
                    }
                    $("#list_category").ready(()=>{

                        $.get('/product/category/name', (data)=>{
                            $ctgr = JSON.parse(data);
                            $list= '';
                            for($i = 0; $i < $ctgr.length; $i++){
                                $list += '<li class="list-group-item" onclick={handleClick('+ $ctgr[$i]['id'] + ')}><a href="#">' + $ctgr[$i]['name'] +'</a></li>'
                            }
                            $("#list_category").html($list)
                        })
                        $('.list_linkCtgr').click((data)=>{
                            console.log('click')
                            console.log(data);
                        })
                    })

                </script>
            </li>
            {{-- <li class="nav-item menu_on_sale">
                <a class="nav-link" href="#">On Sale</a>
                <span class="rounded-pill">SALE</span>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" href="/tin-tuc">Tin tức</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Liên hệ</a>
            </li> --}}
            @guest()
                @if(Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                @endif
                @if(Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="name_user" class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="name_user">
                        <a class="dropdown-item" href="/profile">Hồ sơ</a>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetPass">Đổi mật khẩu</a>
                        @if(Auth::user()->is_admin == 1)
                            <a class="dropdown-item" href="{{ route("admin") }}">Trang quản trị</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Thoát') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest


        </ul>
    </div>

</div>
