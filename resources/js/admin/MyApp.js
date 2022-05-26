$("#owl-header").ready(function () {
    $("#owl-header").owlCarousel({
        autoPlay: 5000,
        navigation: false,
        slideSpeed: 5,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
        pagination: false
    });

});

$("#owl-latest_product").ready(function () {
    $("#owl-latest_product").owlCarousel({
        autoPlay: 3000,
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        pagination: false,
        stopOnHover: true
    });
});

$(window).ready(() => {
    $alert = $("#alert_admin");
    $(".btn_addcart").click((data) => {
        $id = data.currentTarget.attributes['data-prdid'].value;
        if ($("#name_user").text() != "") {
            $.get("/product/cart/add", {"id": $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-success "]);
                    $alert.text("Added to cart");
                    $("#count_cart").text(data);
                    setTimeout(() => {
                        $alert.removeClass(["show", "alert-danger"]);
                        $alert.text("");
                    }, 2000);
                }
            })
        } else {
            window.location = "/login";
        }

    })
})
$($(".list_images_icon")).ready(() => {
    $(".list_images_icon").click((data) => {
        console.log(data.currentTarget.src);
        $src = data.currentTarget.src;
        $("#images_detail img").attr('src', $src);
        console.log($("#images_list"));
    })
})
$("#addQlt").ready(() => {
    $("#addQlt").click(() => {
        $("#valCountQuality").val(Number($("#valCountQuality").val()) + 1);
    })
    $("#removeQlt").click(() => {
        if (Number($("#valCountQuality").val()) <= 0) {
            $("#valCountQuality").val(0);
        } else {
            $("#valCountQuality").val(Number($("#valCountQuality").val()) - 1);
        }
    })

    $("#valCountQuality").change(() => {
        if ($("#valCountQuality").val() < 0) {
            $("#valCountQuality").val(0);
        }
    })
})

$("#btn_addPrdDt").ready(() => {
    $("#btn_addPrdDt").click((data) => {
        $id = data.currentTarget.attributes['data-prdid'].value;
        $quality = $("#valCountQuality").val();
        if ($("#name_user").text() != "") {
            $.get("/product/cart/add", {"id": $id, 'quality': $quality}, (data) => {
                if (data) {
                    $("#count_cart").text(data);
                }
            })
        } else {
            window.location = "/login";
        }

    })
})

$("#desc_PrdDt").ready(() => {
    $("#desc_PrdDt>div").click(() => {
        if ($("#desc_PrdDt>p").attr('class') == 'show') {
            $("#desc_PrdDt>p").addClass('show');
            $("#desc_PrdDt i").removeClass('fa-chevron-down');
            $("#desc_PrdDt i").addClass('fa-angle-up');
        } else {
            $("#desc_PrdDt>p").removeClass('show');
            $("#desc_PrdDt i").addClass('fa-chevron-down');
            $("#desc_PrdDt i").removeClass('fa-angle-up');
        }
    })
})

$("#shipping_PrdDt").ready(() => {
    $("#shipping_PrdDt>div").click(() => {
        if ($("#shipping_PrdDt>p").attr('class') == 'show') {
            $("#shipping_PrdDt>p").addClass('show');
            $("#shipping_PrdDt i").removeClass('fa-chevron-down');
            $("#shipping_PrdDt i").addClass('fa-angle-up');
        } else {
            $("#shipping_PrdDt>p").removeClass('show');
            $("#shipping_PrdDt i").addClass('fa-chevron-down');
            $("#shipping_PrdDt i").removeClass('fa-angle-up');
        }
    })
})
$(".addQltCart").ready(() => {
    $(".addQltCart").click((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val()) + 1
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    })
    $(".removeQltCart").click((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val()) - 1
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    })

    $(".valCountQualityCart").change((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val())
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    });
    $(".btn_delCart").click((data) => {
        $id = $(data.originalEvent.path[0]).attr('data-idCart');
        $tr = $(data.originalEvent.path[2]);
        $alert = $("#alert_admin");
        $.get("/product/cart/delete", {'id': $id}, (data) => {
            if (data) {
                $alert.addClass(["show", "alert-danger "]);
                $alert.text("Deleted");
                $tr.addClass("d-none");
                $("#sumMoneyCart").text(data);
                $("#sumMoneyPay").text(data)
$("#sumPayment").text(data)
                setTimeout(() => {
                    $alert.removeClass(["show", "alert-danger"]);
                    $alert.text("");
                }, 2000);
            }
        });
    });
});
$offset = 0;
$("#btnSearchMore").ready(() => {
    $("#btnSearchMore").click(() => {
        $keyW = $("#keyWSearch").text();
        $offset += 12;
        $.get("/product/search-more", {
            'keyW': $keyW,
            'offset': $offset
        }, (data) => {
            $("#listSearch").append(data);
        })
    })
})
$("#search_header").ready(() => {
    $ip = $("#search_header");
    $("#search_header").keyup(() => {
        setTimeout(()=>{
            $data = $ip.val();
            $.post("/product/name", {'keyW':$data},(data)=>{
                data = JSON.parse(data);
                console.log(data);
                console.log($ip.val());
                $listHtml = "";
                for($i = 0; $i < data.length; $i++){
                    $listHtml += '<a href="/product/' + data[$i].slug + '" class="list-group-item list-group-item-action">' + data[$i].name +'</a>';
                }
                $("#listDataSearch .list-group").html($listHtml);
            })
        }, 500);
    })
    $("#search_header").focus(()=>{
        $("#listDataSearch").addClass("show");
    })
    $("#search_header").focusout(()=>{
        setTimeout(()=>{
            $("#listDataSearch").removeClass("show");
        }, 500)
    })
})
$("#owl-header").ready(function () {
    $("#owl-header").owlCarousel({
        autoPlay: 5000,
        navigation: false,
        slideSpeed: 5,
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
        pagination: false
    });

});

$("#owl-latest_product").ready(function () {
    $("#owl-latest_product").owlCarousel({
        autoPlay: 3000,
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        pagination: false,
        stopOnHover: true
    });
});

$(window).ready(() => {
    $alert = $("#alert_admin");
    $(".btn_addcart").click((data) => {
        $id = data.currentTarget.attributes['data-prdid'].value;
        if ($("#name_user").text() != "") {
            $.get("/product/cart/add", {"id": $id}, (data) => {
                if (data) {
                    $alert.addClass(["show", "alert-success "]);
                    $alert.text("Added to cart");
                    $("#count_cart").text(data);
                    setTimeout(() => {
                        $alert.removeClass(["show", "alert-danger"]);
                        $alert.text("");
                    }, 2000);
                }
            })
        } else {
            window.location = "/login";
        }

    })
    $("#linkHeaderCtgr").click(()=>{
        localStorage.removeItem('category')
    })
})
$($(".list_images_icon")).ready(() => {
    $(".list_images_icon").click((data) => {
        console.log(data.currentTarget.src);
        $src = data.currentTarget.src;
        $("#images_detail img").attr('src', $src);
        console.log($("#images_list"));
    })
})
$("#addQlt").ready(() => {
    $("#addQlt").click(() => {
        $("#valCountQuality").val(Number($("#valCountQuality").val()) + 1);
    })
    $("#removeQlt").click(() => {
        if (Number($("#valCountQuality").val()) <= 0) {
            $("#valCountQuality").val(0);
        } else {
            $("#valCountQuality").val(Number($("#valCountQuality").val()) - 1);
        }
    })

    $("#valCountQuality").change(() => {
        if ($("#valCountQuality").val() < 0) {
            $("#valCountQuality").val(0);
        }
    })
})

$("#btn_addPrdDt").ready(() => {
    $("#btn_addPrdDt").click((data) => {
        $id = data.currentTarget.attributes['data-prdid'].value;
        $quality = $("#valCountQuality").val();
        if ($("#name_user").text() != "") {
            $.get("/product/cart/add", {"id": $id, 'quality': $quality}, (data) => {
                if (data) {
                    $("#count_cart").text(data);
                }
            })
        } else {
            window.location = "/login";
        }

    })
})

$("#desc_PrdDt").ready(() => {
    $("#desc_PrdDt>div").click(() => {
        if ($("#desc_PrdDt>p").attr('class') != 'show') {
            $("#desc_PrdDt>p").addClass('show');
            $("#desc_PrdDt i").removeClass('fa-chevron-down');
            $("#desc_PrdDt i").addClass('fa-angle-up');
        } else {
            $("#desc_PrdDt>p").removeClass('show');
            $("#desc_PrdDt i").addClass('fa-chevron-down');
            $("#desc_PrdDt i").removeClass('fa-angle-up');
        }
    })
})

$("#shipping_PrdDt").ready(() => {
    $("#shipping_PrdDt>div").click(() => {
        if ($("#shipping_PrdDt>p").attr('class') != 'show') {
            $("#shipping_PrdDt>p").addClass('show');
            $("#shipping_PrdDt i").removeClass('fa-chevron-down');
            $("#shipping_PrdDt i").addClass('fa-angle-up');
        } else {
            $("#shipping_PrdDt>p").removeClass('show');
            $("#shipping_PrdDt i").addClass('fa-chevron-down');
            $("#shipping_PrdDt i").removeClass('fa-angle-up');
        }
    })
})
$(".addQltCart").ready(() => {
    $(".addQltCart").click((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val()) + 1
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    })
    $(".removeQltCart").click((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val()) - 1
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    })

    $(".valCountQualityCart").change((data) => {
        $ip = $($(data.originalEvent.path[1])[0].children[0]);
        $id = $ip[0].attributes[2].value;
        $.get("/product/cart/quality/get",
            {
                'id': $id,
                'quality': Number($ip.val())
            }, (data) => {
                data = JSON.parse(data);
                $ip.val(data.quality);
                $("#sumMoneyCart").text(data.money)
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
            });
    });
    $(".btn_delCart").click((data) => {
        $id = $(data.originalEvent.path[0]).attr('data-idCart');
        $tr = $(data.originalEvent.path[2]);
        $alert = $("#alert_admin");
        $.get("/product/cart/delete", {'id': $id}, (data) => {
            if (data) {
                $alert.addClass(["show", "alert-danger "]);
                $alert.text("Deleted");
                $tr.addClass("d-none");
                $("#sumMoneyCart").text(data);
                $("#sumMoneyPay").text(data.money)
$("#sumPayment").text(data.money)
                setTimeout(() => {
                    $alert.removeClass(["show", "alert-danger"]);
                    $alert.text("");
                }, 2000);
            }
        });
    });
});
$offset = 0;
$("#btnSearchMore").ready(() => {
    $("#btnSearchMore").click(() => {
        $keyW = $("#keyWSearch").text();
        $offset += 12;
        $.get("/product/search-more", {
            'keyW': $keyW,
            'offset': $offset
        }, (data) => {
            $("#listSearch").append(data);
        })
    })
})

$('.listCtgrDetail').ready(()=>{
    $('.listCtgrDetail').click((e)=>{
        $.get(`/category/product/${e.currentTarget.dataset.id}`, data=>{
            $("#showPrdCtgr").html(data);
            $('.listCtgrDetail').removeClass('active')
            e.currentTarget.classList.add('active')
        })
    })
})

$('.btn_icon .like').ready(()=>{
    $btnLike = $('.btn_icon .like');
    $.get('/like-product/user')
        .done(data=>{
            for($i = 0; $i < $btnLike.length; $i++){
                for($j = 0; $j < data.length; $j++){
                    $dom = $btnLike[$i].offsetParent.children[0].dataset['prdid']
                    if($dom == data[$j]['id']){
                        $btnLike[$i].children[0].classList.add('text-danger')
                    }
                }
            }
        })
        // .fail(()=>{
        //     window.location = '/login'
        // })
    $('.btn_icon .like').click(e=>{
        $dom = e.currentTarget.offsetParent.children[0].dataset['prdid']
        $.get(`/like-product/${$dom}`,)
            .done((data)=>{
                if(data == 1){
                    e.target.classList.add('text-danger')
                    for($i = 0; $i < $btnLike.length; $i++){
                        $check = $btnLike[$i].offsetParent.children[0].dataset['prdid']
                        if($dom == $check){
                            $btnLike[$i].children[0].classList.add('text-danger')
                        }
                    }
                }
                if(data == 0){
                    e.target.classList.remove('text-danger')
                    for($i = 0; $i < $btnLike.length; $i++){
                        $check = $btnLike[$i].offsetParent.children[0].dataset['prdid']
                        if($dom == $check){
                            $btnLike[$i].children[0].classList.remove('text-danger')
                        }
                    }
                }
            })
            .fail(()=>{
                // window.location = "/login"
            })
    })
})
$('.list_payment_modal').ready(()=>{
    $('.list_payment_modal').click((e)=>{
        e.target.classList.remove('avtive')
        for($i = 0; $i < $('.list_payment_modal').length; $i++){
            if(e.target != $('.list_payment_modal')[$i]){
                $('.list_payment_modal')[$i].classList.remove('active')
            }else{
                $('.list_payment_modal')[$i].classList.add('active')
                $("#btn_modal")[0].dataset['typeship'] = $i
                $("#btn_modal").text(e.target.innerText)
                if($i == 0){
                    $("#btnPayment")[0].attributes['type'].value = 'button'
                }
                if($i == 1){
                    $("#btnPayment")[0].attributes['type'].value = 'submit'
                }
            }
        }
    })
    $("#btnPayment").click(()=>{
        $action = $("#btn_modal")[0].dataset['typeship']
        if($action == 0){
            alert('đặt hàng thành công vui lòng đợi xác nhận từ admin')
            location.href = 'http://127.0.0.1:8000/payment/order'
        }
    })
})
$("#rpassword").ready(()=>{
    $("#rpassword").click(()=>{
        $check = 0;
        $pwNow = $("#pwNow").val();
        $pwNew = $("#pwNew").val();
        $rpwNew = $("#rpwNew").val();
        if($pwNew != $rpwNew){
            alert("Xác nhận mật khẩu không chính xác");
            $check++;
        }
        if($pwNow == "" || $pwNew == "" || $rpwNew == ""){
            alert("Không được để truống");
            $check++;
        }
        if($check == 0){
            $.get(`/user/reset/` + $pwNew + "/" + $pwNow, (data)=>{
                if(data == 1){
                    alert("Thay đổi mật khẩu thành công");
                }else{
                    alert("Mật khẩu không chính xác");
                }
            });
        }
        console.log($pwNow, $pwNew, $rpwNew);
    })
})