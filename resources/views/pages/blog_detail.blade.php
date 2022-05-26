<section class="container">
    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">

            <?php
            $time = strtotime(date('Y-m-d H:i:s')) - strtotime($blog->updated_at);
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
            <p class="card-text"><small class="text-muted">Cập nhật <b>{{$check . " " . $checkval}} trước</b> bởi <b>{{$blog->user_name}}</b></small></p>
            <div class="mt-2">
               <h2 class="text-uppercase fw-bold">{{$blog["name"]}}</h2>
               <div id="newsBlog">
                   <?php echo $blog->news; ?>
               </div>
                
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
        </div>
    </div>
</section>
