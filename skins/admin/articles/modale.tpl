
<div id="<?php echo 'myModal'.$b ;?>"class="modal fade modal-sm" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
             <div class="modal-body">
                 <p>Sind Sie sicher, chtohotite eines Artikels?</p>
                 <p class="text-warning"><small>Wenn Sie den Artikel entfernen wird es verschwunden sein.</small></p>
             </div>
             <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <a class="btn btn-small btn-primary" href="<?php echo '/admin/articles/destroy/'.$_all['id']; ?>" target="_self">
               <i class="icon-ok-sign icon-white"></i> Yes
            </a>
             </div>
       </div>
    </div>
</div>