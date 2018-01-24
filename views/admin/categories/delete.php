<?php
include_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
   <div class="row">
        <div class="col-md-2">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>
        </div>
      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
                <div class="panel-title"><?= $title;?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>
          <form class="form-horizontal" role="form" method="POST">
<input type="hidden" name="id" value="<?php echo $data['category_id']; ?>">
            <div class="panel-body">

                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label"><h4>Удалить category #<?php echo $data['category_id']; ?></h4>
                    <p>Вы действительно хотите удалить this category?</p>
                    </label>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="save btn btn-primary">Удалить</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
