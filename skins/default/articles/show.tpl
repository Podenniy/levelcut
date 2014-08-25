<div class="container">
     <div class="row">
           <div class="col-md-10 col-md-offset-1">
                 <div class="page-header art_head  clearfix">
                       <div class = " user_inf pull-left " >
                            <img src="<?php echo $row['avatar'];?>" alt=""><br>
                            <a href="/articles/main/author_id/<?php echo $row['user_id']?>"><?php echo $row['login']?></a><br>
                            <small><?php echo $row['date'];?></small>
                       </div>
                 <div class=' article_name' article_name>
                     <h3> <?php echo $row['title'];?></h3>
                 </div>
                </div>
                <?php echo $row['text'];?>
                <div class="<?php echo $errors['com_class'] ;?> comment_box" >
                     <div class="panel-heading  text-center">
                   <?php if ($row['user_id'] == @$_SESSION['user']['id']) { ?>
                    <a href="/articles/edit/id/<?php echo $row['id'];?>" class="btn btn-warning">Редактировать статью</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target=".bs-modal-sm">Удалить статью</button>

                     <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                         Добавить Коментарии
                    </button>
                   <?php }elseif (isset($_SESSION['user'])) {?>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                         Добавить Коментарии
                    </button>

                         <?php }else { ?>
                               для тго чтоб оставлять коментарии зарегистрируйтесь или авторизируйтесь&nbsp&nbsp&nbsp
                              <a href="/cab/registration" class="btn btn-info">регистрация</a>
                           <?php } ?>

                     </div>

                   <?php while( $com_row = $res_com->fetch_assoc() ){
                       echo "<div class='panel panel-default'>
                                    <div class='panel-body row'>
                                       <div class='ava_comment col-xs-6 col-sm-2'>
                                           <img src=".$com_row['avatar']." alt='' /><br />
                                             <a href='/articles/main/author_id/".$com_row['user_id']."'><strong>".$com_row['login']."</strong></a><br />
                                           <small>".date($com_row['date'])."</small>
                                        </div>
                                        <div class=' well well-lg ava_comment col-xs-6 col-sm-9'>
                                           ".$com_row['comment_text']."
                                        </div>
                                    </div>
                                </div>";
                   }
                    $res->close();
                    $res_com->close();
                   ?>
             </div>
           </div>

           <div class="modal fade bs-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content col-md-6 col-md-offset-3 ">
                         <div class="panel panel-danger ">
                            <div class="panel-heading text-center">Точно удалить?</div>
                            <div class="panel-body">
                                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                     <a href="/articles/destroy/<?php echo $row['id'];?>" class="btn btn-danger">Удалить статью</a>
                            </div>
                         </div>
                      </div>
                   </div>
           </div>
           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="etrue">
                 <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" id="myModalLabel">Напишите свой коментарий</h4>
                       </div>
                       <div class="modal-body row">

                         <form action="" method = 'post' class="form-inline" role="form">
                            <div class="form-group col-md-9">
                               <textarea class="form-control"   name='comment'    rows="3"></textarea>
                            </div>
                              <?php echo @$errors["comment"] ;?>
                            <div class="form-group  col-md-3">
                                <h5>Проголосовать</h5>
                               <div class="radio radio_style">
                                  <input type="radio" name="like" id="vote_like"  value="like" >
                                  <label for="vote_like">
                                  <span class="label label-primary">+</span>
                                  </label>
                               </div>
                               <div class="radio  radio_style ">
                                  <input type="radio" name="like" id="vote_unlike" value="unlike" >
                                  <label for="vote_unlike">
                                  <span class="label label-danger">-</span>
                                  </label>
                               </div>
                            </div>
                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button type=" submit" class="btn btn-primary">Save changes</button>
                        </form>

                       </div>
                   </div>
                 </div>
           </div>
      </div>
     </div>
</div>
