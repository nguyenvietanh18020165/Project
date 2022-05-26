<script>
    $('.listCtgrDetail').ready((e)=>{
        console.log($('.listCtgrDetail')[0]['dataset']['id'])
        $dom = $('.listCtgrDetail');
        for($i = 0; $i < $dom.length; $i++){
            if($dom[$i]['dataset']['id'] == localStorage.getItem('category')){
                $dom[$i].classList.add('active')
            }
        }
        $category = localStorage.getItem('category')
        $.get(`/category/product/${$category !== null ? $category : 'all'}`, data=>{
            $("#showPrdCtgr").html(data);
        })

    })
</script>

<section class="bg-gray py-2">
    <div class="container-fluid">
        <h1 class="mb-0">Danh mục sản phẩm</h1>
        {{ Breadcrumbs::render('category') }}
    </div>
</section>
<div class="container-fluid mt-3">
    <div class="row">
        <aside class="col-12 col-sm-12 col-md-3 col-lg-3">
            <ul class="list-group">
                @foreach($ctgr as $val)
                <li class="list-group-item listCtgrDetail" data-id="{{$val->id}}">{{$val->name}}</li>
                @endforeach
            </ul>
        </aside>
        <section id="showPrdCtgr" class="col-12 col-sm-12 col-md-9 col-lg-9">
            <h3>Không có sản phẩm thích hợp</h3>
        </section>
    </div>
</div>
