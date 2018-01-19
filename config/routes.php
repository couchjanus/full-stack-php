<?php

return [
    'contact' => 'ContactController@index',
    'about' => 'AboutController@index',
    'blog' => 'BlogController@index',
    'blog/search' => 'BlogController@search',
    'guestbook' => 'GuestbookController@index',

    'admin' => 'Admin\DashboardController@index',

    'admin/categories'=>'Admin\shop\CategoriesController@index',
    'admin/category/add' => 'Admin\shop\CategoriesController@create',

    'admin/products' => 'Admin\shop\ProductsController@index',
    'admin/product/add'=>'Admin\shop\ProductsController@create',

    'admin/posts' => 'Admin\posts\PostController@index',
    'admin/posts/add' => 'Admin\posts\PostController@add',

    //Главаня страница
    'index.php' => 'HomeController@index', 
    '' => 'HomeController@index',  
];
