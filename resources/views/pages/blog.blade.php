<section class="container">
    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">

            @foreach($blog as $val)
                <div class="card mb-3" style="">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset($val->image)}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8 position-relative">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase fw-bold">{{$val->name}}</h5>
                                <p class="card-text">{{$val->desc}}</p>
                                <?php
                                // date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $time = strtotime(date('Y-m-d H:i:s')) - strtotime($val->updated_at);
                                $i = 1;
                                $day = 0;
                                $vals = 'giây';
                                $check = 0;
                                $checkval = 'giây';
                                while($time > 1){
                                    $time = floor($time);
                                    $check = $time;
                                    $checkval = $vals;
                                    if($i >= 6){
                                        break;
                                    }
                                    if($i <= 2){
                                        if($i == 1){
                                            $vals = "phút";
                                        }
                                        if($i == 2){
                                            $vals = "giờ";
                                        }
                                        $time = $time/60;
                                    }
                                    if($i == 3){
                                        $vals = "ngày";
                                        $time = $time/24;
                                        $day = $time;
                                    }
                                    if($i == 4){
                                        $vals = "tuần";
                                        $time = $day/7;
                                    }

                                    if($i == 5){
                                        $vals = "tháng";
                                        $time = $day/30;
                                    }
                                    $i++;
                                    $time = floor($time);

                                }

                                ?>
                                <p class="card-text"><small class="text-muted">Cập nhật <b>{{$check . " " . $checkval}} trước</b> bởi <b>{{$val->user_name}}</b></small></p>

                            </div>
                            <a href="/tin-tuc/{{$val->slug}}" class="btn btn-primary position-absolute" style="bottom: 15px; right: 15px">Xem thêm</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="w-100 text-center paginationBlog">
                {{$blog->links()}}
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 bg-white">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" type="button" id="button-addon2">Tìm</button>
            </div>

            <div class="mt-3">
                <h4>Bài viết về</h4>
                <ul class="list-group list-group-flush">
                    @foreach($ctgr_blog as $val)
                        <a href="/tin-tuc/category/{{$val->slug}}" class="text-decoration-none text-black"><li class="list-group-item">{{$val->name}}</li></a>
                    @endforeach

                </ul>
            </div>
            <div class="mt-3">
                <h4>Bài viết gần đây</h4>
                @for($j = 0; $j < count($blognew); $j++)
                    <?php
                    $time = strtotime(date('Y-m-d H:i:s')) - strtotime($blognew[$j]->updated_at);
                    $i = 1;
                    $day = 0;
                    $vals = 'giây';
                    $check = 0;
                    $checkval = 'giây';
                    while($time > 1){
                        $time = floor($time);
                        $check = $time;
                        $checkval = $vals;
                        if($i >= 6){
                            break;
                        }
                        if($i <= 2){
                            if($i == 1){
                                $vals = "phút";
                            }
                            if($i == 2){
                                $vals = "giờ";
                            }
                            $time = $time/60;
                        }
                        if($i == 3){
                            $vals = "ngày";
                            $time = $time/24;
                            $day = $time;
                        }
                        if($i == 4){
                            $vals = "tuần";
                            $time = $day/7;
                        }

                        if($i == 5){
                            $vals = "tháng";
                            $time = $day/30;
                        }
                        $i++;
                        $time = floor($time);

                    }

                    ?>
                        <a href="/tin-tuc/{{$blognew[$j]->slug}}" class="text-decoration-none">

                            <div class="card mb-3" style="">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <img src="{{asset($blognew[$j]->image)}}" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title text-black">{{$blognew[$j]->name}}</h5>
                                            <p class="card-text"><small class="text-muted"><i class="bi bi-clock"></i> <span>{{$check . " " . $checkval}}</span> <i class="bi bi-person-fill"></i> <span>{{$blognew[$j]->user_name}}</span></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                @endfor
            </div>
        </div>
    </div>
</section>
