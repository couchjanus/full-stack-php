<?php

/**
 * Контроллер для управления категориями
 */
class PostController extends Controller{

    /**
     * Главная страница управления post
     *
     * @return bool
     */

    public function index()
    {       
        $posts = Post::index();
        $data['title'] = 'Admin Posts Page ';
        $data['posts'] = $posts;
        // print_r($posts);
        $this->_view->render('admin/posts/index',$data);
    }


    public function add () {
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['title'] = trim(strip_tags($_POST['title']));
            $options['content'] = trim($_POST['content']);
            // $options['content'] = trim(strip_tags($_POST['content']));
            $options['status'] = trim(strip_tags($_POST['status']));

            $id = Post::store($options);
            header('Location: /admin/posts');

        }
        $data['title'] = 'Admin Add Post ';
        
        $this->_view->render('admin/posts/add',$data);
        
    }

}
