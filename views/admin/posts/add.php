<?php
include_once VIEWS.'shared/admin/header.php';
?>
<script src="/js/tinymce/tinymce.min.js"></script>
<!-- script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script-->
<script>
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
</script>
<main>
  <article class=''>

            <h1><?= $title;?></h1>
        

        <h1>Добавить новую публикацию</h1>

        <form action='' method='post'>

            <p><label>Заголовок</label><br />
            <input type='text' name='title' value=''></p>

            <p><label>Контент</label><br />
            <textarea name='content' cols='60' rows='10'></textarea></p>

            <p>Статус отображения</p>
            <select name="status">
                <option value="1" selected>Отображать</option>
                <option value="0">Скрыть</option>
            </select>

            <p><input type='submit' name='submit' value='Сохранить'></p>

        </form>


  </article>
</main>

<?php

include_once VIEWS.'shared/admin/footer.php';

