<?php
include_once VIEWS.'/shared/head.php';
include_once VIEWS.'/shared/nav.php';
?>

<section class="product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <!-- Jumbotron -->
            <div class="jumbotron">
              <h1><?=$title?></h1>
            </div>

   <div class="row">
     <?php if($data['res']):?>
          <h4 id="edit_thanks">Данные успешно изменены!</h4>
           <h3 id="to_cabinet">Вернуться в <a href="/profile" id="reg_main_a">Кабинет</a></h3>
     <?php else: ?>

      <?php if (isset($data['errors']) && is_array($data['errors'])):?>
                <ul class="errors">
                    <?php foreach($data['errors'] as $error):?>
                        <li> - <?php echo $error;?></li>
                    <?php endforeach;?>
                </ul>
       <?php endif;?>

       <h1><?= $title;?></h1>

       <form action="#" method="post">
            
         <h2>Редактирование данных</h2>
         <div class="form-group">
            <label for="name">User name</label>
            <input  class="form-controll" required type="text" name="name" value="<?= $data['user']['name'] ?>">
         </div>
         <div class="form-group">
           <label for="password">Password</label>
          <input required class="form-control" type="password" name="password" value="<?= $data['user']['password'] ?>">
         </div>
         <div class="form-group">
           <input type=submit name="submit" value="Сохранить" class="btn btn-primary">
         </div>
       </form>
    <?php endif;?>
            
      </div>
    </div>
  </div>
</div>
</section>
<?php

include_once VIEWS.'/shared/footer.php';
