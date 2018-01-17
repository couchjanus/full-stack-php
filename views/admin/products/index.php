<?php
include_once VIEWS.'shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>
       

<article class='large'>

<div class="container_admin">
    <a href="/admin/product/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить товар
    </a>
    <h4>Список товаров</h4>
    <table>
        <tr>
            <th>id товара</th>
            <th>Название</th>
            <th>Цена</th>
        </tr>

        <?php foreach ($products as $product):?>
        <tr>
            <td><?php echo $product['id']?></td>
            <td><?php echo $product['name']?></td>
            <td><?php echo $product['price']?></td>
            <td><a title="Редактировать" href="" class="del">
                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                </a></td>
            <td><a title="Удалить" href="" class="del">
                <i class="fa fa-times fa-2x" aria-hidden="true"></i>
            </a></td>
        </tr>
        <?php endforeach;?>
    </table>

</div>

</article>


<?php

include_once VIEWS.'shared/admin/footer.php';


