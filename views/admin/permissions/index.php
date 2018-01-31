<?php
include_once VIEWS.'/shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>
       

<article class='large'>
        <a href="/admin/permissions/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить permission
        </a>
        <h4>Список permissions</h4>
        <table>
            <tr>
                <th>ID</th>
                <th>Название permission</th>
            </tr>

            <?php foreach ($permissions as $permission):?>
                <tr>
                    <td><?php echo $permission['id']?></td>
                    <td><?php echo $permission['name']?></td>
                    <td><a title="Редактировать" href="/admin/permissions/edit/<?php echo $permission['id']?>">
                        <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                    </td>
                    <td><a title="Удалить" href="/admin/permissions/delete/<?php echo $permission['id']?>" class="del"><i class="fa fa-times fa-2x" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
</article>

<?php

include_once VIEWS.'/shared/admin/footer.php';

