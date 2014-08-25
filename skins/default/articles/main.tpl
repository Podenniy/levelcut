<div class="container">
   <div class="row">
      <div class="view_from " >
      <?php echo $ct  ;?>
       <?php wtf($_GET,1);?>
       <strong>Отсортировать :</strong>
       <a href="<?php echo $sort_art['rating'];?>" class="btn btn-info">По рейтингу </a>
       <a href="<?php echo $sort_art['date'];?>"class='btn btn-info'>По дате </a>
      </div>


      <?php while ($row = $res->fetch_assoc()) {?>
          <br>
          <div class="col-md-10 col-md-offset-1 art_main">
              <div class="page-header">

              <h4>
              <img src="<?php echo $row['avatar'];?>" alt="">
              <?php echo $row['title'];?><br>

              <a href="/articles/main/author_id/<?php echo $row['user_id']?>"><small><strong>Автор <?php echo $row['login'];?></strong></small></a><br>
              <small><?php echo $row['date'];?></small>
              </h4>
              </div>
                <p><?php echo $row['description'];?></p>

                  <p>
                        <a class="btn btn-default" href="/articles/show/id/<?php echo (int)$row['id'];?>" role="button">View details &raquo;</a>&nbsp&nbsp&nbsp
                       <a href="/articles/main/category/<?php echo (int)$row['cat_id'] ?>"><span class="label label-default"><em>категория  <?php echo $row['name'] ?> </em></a> &nbsp&nbsp&nbsp
                       <span> <em>Кол-во голосов</em>
                           <span class="label label-primary">+&nbsp<?php echo $row['count_like'];?></span>
                        / <span class="label label-danger">-&nbsp<?php echo $row['count_unlike'];?></span>
                        </span>
                  </p>

           </div>
<?php }?>

  <ul class="pagination">
                      <li><a href="#">&laquo;</a></li>
                       <li><a href="#">1</a></li>
                       <li><a href="#">2</a></li>
                       <li><a href="#">3</a></li>
                       <li><a href="#">4</a></li>
                       <li><a href="#">5</a></li>
                       <li><a href="#">&raquo;</a></li>
                </ul>
  </div>
</div>
