<?php
include_once VIEWS.'shared/admin/header.php';
?>
        <main>
            <h1><?= $title;?></h1>
        </main>

<article class='large'>
        <h1>Добавить новый товар</h1>
            <form action="" method="post">
                <p>Название товара</p>
                <input required type="text" name="name">

                <p>Стоимость</p>
                <input required type="text" name="price">

                <p>Категория</p>
                <select name="category">
                    <?php if (is_array($data['categories'])): ?>
                        <?php foreach ($data['categories'] as $category): ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <p>Производитель</p>
                <input required type="text" name="brand">

                <p>Детальное описание</p>
                <textarea id="add_description" name="description"></textarea>

                <p>Новинка</p>
                <select name="is_new">
                    <option value="1" selected>Да</option>
                    <option value="0">Нет</option>
                </select>

                <p>Статус</p>
                <select name="status">
                    <option value="1" selected>Отображается</option>
                    <option value="0">Скрыт</option>
                </select>
                <input type=submit name="submit" value="Сохранить" id="add_btn">
            </form>
</article>

<?php

include_once VIEWS.'shared/admin/footer.php';
