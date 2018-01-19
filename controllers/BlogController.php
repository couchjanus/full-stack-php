<?php

class BlogController extends Controller
{

public function index()
    {   
        $posts = Post::index();
        $data['title'] = 'Blog Page ';
        $data['posts'] = $posts;
        // print_r($posts);
        $this->_view->render('blog/index',$data);

    }
}