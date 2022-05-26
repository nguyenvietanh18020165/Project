$ctgr = $("#list_ctgr");
$cnt_admin = $("#content_admin");
function callView(url){
    $.get(url, (data) => {
        $cnt_admin.html(data);
    })
    // get post put delete
    // $.get("url", function(data))
}
$ctgr.click(() => {
    callView('/product/category');
});
$("#allPrdAdm").click(()=>{
    callView('/product/get');
});

$("#show_cart_admin").click(()=>{
    callView("/product/cart/view-admin");
})
$("#admin_all_user").click(()=>{
    callView("/user/");
})

$("#admin_vender_user").click(()=>{
    callView("/user/all-vendor");
})

$("#admin_admin_user").click(()=>{
    callView("/user/all-admin");
})
$("#show_order_admin").click(()=>{
    callView("/user/all-order");
})

$("#list_ctgrBlog").click(()=>{
    callView('/tin-tuc/category')
})
$("#allBlogAdm").click(()=>{
    callView('/tin-tuc/admin-show')
})

