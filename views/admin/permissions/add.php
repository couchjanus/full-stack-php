<?php
include_once VIEWS.'/shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>

<article class='large'>
        <h1>Добавить новню permission</h1>
        <form action="#" method="post">
            <p>Название permission</p>
            <input required type="text" name="name">
            <input type=submit name="submit" value="Сохранить">
        </form>
</article>

<?php
include_once VIEWS.'/shared/admin/footer.php';

