<div class="content" >
           <?php while ($res = $art_res->fetch_assoc()) { ?>
              <div class="video_wrap">
                <div class="video-left">
                    <img src="<?php echo $res['img_url'] ?>" alt="">
                   <?php echo $res['title'] ?>
                </div>
                <div class="video-right">
                    <div class="self_video"><?php echo $res['video'] ;//wtf($res,1 ) ;?></div>
                </div>
              </div>
           <?php } ?>
</div>