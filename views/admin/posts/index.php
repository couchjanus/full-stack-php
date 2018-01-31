<?php
include_once VIEWS.'shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>
       

<article class='large'>
        <a href="/admin/posts/add" class="add_item"><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Добавить пост
        </a>
        <h4>Список публикаций</h4>
        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Статус</th>
                <th colspan="2">Action</th>
            </tr>

            <?php foreach ($data['posts'] as $post):?>
                <tr>
                    <td><?php echo $post['id']?></td>
                    <td><?php echo $post['title']?></td>

                    <td>
                        <?php echo Post::getStatusText($post['status']);?>
                    </td>

                    <td><a title="Редактировать" href="" class="del">
                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                        </a></td>
                    <td><a title="Удалить" href="" class="del">
                            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                        </a></td>
                </tr>
            <?php endforeach;?>
        </table>
</article>
<?php

include_once VIEWS.'shared/admin/footer.php';

