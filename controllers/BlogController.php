<?php

class BlogController extends Controller
{

public function index($vars)
{   
    $page = 1;
        
    extract($vars);

    $page = $page? $page:1;

 
    $posts = Post::getLatestPosts($page);

    //Общее кол-во posts (для пагинации)
    $total = Post::getTotalPosts();
    $pagination = new Pagination($total, $page, Post::SHOW_BY_DEFAULT, 'page-');
        
        
    $data['title'] = 'Blog Page ';
    $data['subtitle'] = 'Posts with pagination';

    $data['posts'] = $posts;
    
    $breadcrumb = new Breadcrumb();
    
    $data['breadcrumb'] = $breadcrumb->build(array(
        'All Blog Posts' => 'blog',
    ));
    
    $data['pagination'] = $pagination;

    $this->_view->render('blog/index',$data);

}

public function search()
{
        //Флаг ошибок
        $data['errors'] = false;
        $result = false;
        
        if (isset($_POST) and !empty($_POST)) {
            
            $query = trim(strip_tags($_POST['query']));

            if (strlen($query) < 3) {
                $data['errors'][] = 'Слишком короткий поисковый запрос.';
            } else if (strlen($query) > 128) {
                $data['errors'][] = 'Слишком длинный поисковый запрос.';
            } else { 
                    $posts = Post::searchPost($query);
                    $num_rows = count($posts);
            
                if ($num_rows > 0) { 
                    $data['num_rows'] = 'По запросу <b>'.$query.'</b> найдено совпадений: '.$num_rows;
                    
                } else {
                    $data['errors'][] = 'По вашему запросу ничего не найдено.';
                    }
                } 
            } else {
                $data['errors'][] = 'Задан пустой поисковый запрос.';
            }

            if ($data['errors'] == false) {
                        $result = true;
                        $data['posts'] = $posts;
                    }
            $data['success'] = $result;
            $data['title'] = 'Search Post Page ';
            $this->_view->render('blog/search',$data);
        
    }
}