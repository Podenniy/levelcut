  <div class="content" id="gal">
      <div class="gal_wrap">
        <?php while ($res = $art_res->fetch_assoc()) { ?>
        <img src="<?php echo $res['img_url'] ?>" alt="">
          <?php }
          $art_res->close();
          ?>
      </div>
  </div>