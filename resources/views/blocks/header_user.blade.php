<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container text-center d-block py-2">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-2 align-self-sm-center pl-0">
                <a class="navbar-brand text-black w-100 text-lg-start text-center fw-bolder fs-3 h4 m-0 p-0" href="/">{{config("app.name", "Laravel")}}</a>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 text-center">
                <div class="row w-100">
                    <div class="col-12 col-sm-12 col-md-8 box_search position-relative">
                        <form class="d-flex" action="/product/search" method="get">
                            <input style="height: 44px;"
                                   class="form-control w-100 rounded-pill bg-light border-light"
                                   type="search"
                                   name="key"
                                   placeholder="Search on RVM SeaMaf ...."
                                   aria-label="Search" id="search_header"
                                   autocomplete = "off">
                        </form>
                        <div class="w-100" id="listDataSearch">
                            <div class="list-group">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 list_header text-end">
                        <ul class="me-auto mb-2 mb-lg-0 px-0 d-inline-block">
{{--                            <li class="dropdown float-start px-2 align-self-end">--}}
{{--                                <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    Dropdown--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                                    <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                                    <li><hr class="dropdown-divider"></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                            <li class="float-start px-2">
                                <i class="fa-solid fa-heart text-danger"></i>
                                <a class=" d-inline-block px-0" href="/like-product">Yêu thích</a>
                            </li>
                            <li class="float-start px-2">
                                <div class="position-relative d-inline-block">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                    <button id="count_cart" class="rounded-circle position-absolute">
                                        @if(isset($countCart))
                                            {{$countCart}}
                                        @else
                                            0
                                        @endif
                                        </button>
                                </div>
                                <a class=" d-inline-block px-0" href="/product/cart/detail">Giỏ Hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
