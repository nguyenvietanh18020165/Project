<section class="bg-dark pt-2 mt-4">
    <div class="container">
        <div class="row text-secondary">
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <h3 class="text-white">FRUIT&HEALTH</h3>
                <p>Cửa hàng hoa quả trực tuyến với các loại hoa quả và nguồn cung cấp tốt nhất ở trong nước ✓ 
                    Hơn 9000 sản phẩm sạch ✓ Đạt tiêu chuẩn ✓ Giá cả phù hợp và nhiều hơn nữa!</p>
                <img src="{{ asset("upload/images/cards.png") }}" alt="">
                <div class="input-group mt-2 ">
                    <input type="text" class="form-control" placeholder="Enter e-mail" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-secondary" type="button" id="button-addon2">Đăng ký</button>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <h3 class="text-white">LIÊN KẾT HỮU ÍCH</h3>
                <ul class="row">
                    <li class="col-6">Về chúng tôi</li>
                    <li class="col-6">Hỗ trợ</li>
                    <li class="col-6">Sản phẩm mới</li>
                    <li class="col-6">Điều khoản sử dụng</li>
                    <li class="col-6">Vận chuyển</li>
                    <li class="col-6">Chính sách bảo mật</li>
                    <li class="col-6">Liên hệ</li>
                    <li class="col-6">Dịch vụ</li>
                    <li class="col-6">Đơn hàng</li>
                    <li class="col-6">Blog</li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                
                <h3 class="text-white">BLOG</h3>
                <div class="card mb-3 bg-dark border-0">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img id="imagesBlog1" src="{{ asset("upload/images/sp1.webp") }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body py-0 pe-0">
                                <a href="#" id="linkToBlog1" class="text-decoration-none">
                                    <h5 class="card-title text-white" id="descBlog1">BOHE MIAN WEDDING THEME</h5>
                                </a>
                                {{-- <p class="card-text"><small class="text-muted">1 year ago</small></p> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card mb-3 bg-dark border-0">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img id="imagesBlog2" src="{{ asset("upload/images/sp1.webp") }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body py-0 pe-0">
                                <a href="#" id="linkToBlog2" class="text-decoration-none">
                                    <h5 id="descBlog2" class="card-title text-white">BOHE MIAN WEDDING THEME</h5>
                                </a>
                                {{-- <p class="card-text"><small class="text-muted">1 year ago</small></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $.get("/tin-tuc/api-allblog", function(data){
                        $result = JSON.parse(data).data;
                        $("#descBlog1").text($result[0].desc);
                        $("#imagesBlog1").attr("src", "http://127.0.0.1:8000/" + $result[0].image);
                        $("#linkToBlog1").attr("href", "http://127.0.0.1:8000/tin-tuc/" + $result[0].slug);
                        $("#descBlog2").text($result[1].desc);
                        $("#imagesBlog2").attr("src", "http://127.0.0.1:8000/" + $result[1].image);
                        $("#linkToBlog2").attr("href", "http://127.0.0.1:8000/tin-tuc/" + $result[1].slug);
                    });
                </script>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <h3 class="text-white">LIÊN HỆ</h3>
                <p class="d-flex">
                    <span class="text-danger pe-1 d-inline-block">C.</span>
                    <span class="d-inline-block">FRUIT&HEALTH</span>
                </p>
                <p class="d-flex">
                    <span class="text-danger pe-1 d-inline-block">B.</span>
                    <span class="d-inline-block">144 Xuân Thủy, Cầu Giấy, Hà Nội, Việt Nam</span>
                </p>
                <p class="d-flex">
                    <span class="text-danger pe-1 d-inline-block">T.</span>
                    <span class="d-inline-block">+84338990478</span>
                </p>
                <p class="d-flex">
                    <span class="text-danger pe-1 d-inline-block">E.</span>
                    <span class="d-inline-block">fruit&health@gmail.com</span>
                </p>
            </div>
        </div>
    </div>
    <hr class="text-secondary">
    <div class="container d-flex text-secondary">
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-instagram"></i>
            <span class="text-uppercase">Instagram</span>
        </div>
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-pinterest"></i>
            <span class="text-uppercase">Pinterest</span>
        </div>
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-facebook-f"></i>
            <span class="text-uppercase">facebook</span>
        </div>
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-twitter"></i>
            <span class="text-uppercase">twitter</span>
        </div>
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-youtube"></i>
            <span class="text-uppercase">youtube</span>
        </div>
        <div class="me-3">
            <i class="fa-brands me-3 fs-3 fa-linkedin-in"></i>
            <span class="text-uppercase">linkedin</span>
        </div>
    </div>

</section>
