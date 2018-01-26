<?php

$router->get('', 'HomeController@index');
$router->get('about', 'AboutController@index');
$router->get('contact', 'ContactController@index');

$router->get('guestbook', 'GuestbookController@index');

$router->get('blog', 'BlogController@index');
$router->post('blog/search', 'BlogController@search');
$router->get('blog/{id}', 'BlogController@view');

$router->get('admin', 'Admin\DashboardController@index');

$router->get('admin/products', 'Admin\shop\ProductsController@index');
$router->get('admin/products/add', 'Admin\shop\ProductsController@create');
$router->post('admin/products/add', 'Admin\shop\ProductsController@create');
$router->get('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');
$router->post('admin/products/edit/{id}', 'Admin\shop\ProductsController@edit');

$router->get('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');
$router->post('admin/products/delete/{id}', 'Admin\shop\ProductsController@delete');

$router->get('admin/categories', 'Admin\shop\CategoriesController@index');
$router->get('admin/category/add', 'Admin\shop\CategoriesController@create');
$router->post('admin/category/add', 'Admin\shop\CategoriesController@create');
$router->get('admin/category/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->post('admin/category/edit/{id}', 'Admin\shop\CategoriesController@edit');
$router->get('admin/category/delete/{id}', 'Admin\shop\CategoriesController@delete');
$router->post('admin/category/delete/{id}', 'AdminCategoriesController@delete');

$router->get('admin/posts', 'Admin\posts\PostController@index');
$router->get('admin/posts/add', 'Admin\posts\PostController@add');
$router->get('admin/posts/edit/{id}', 'Admin\posts\PostController@edit');
$router->get('admin/posts/delete/{id}', 'Admin\posts\PostController@delete');
$router->post('admin/posts/add', 'Admin\posts\PostController@add');
$router->post('admin/posts/edit/{id}', 'Admin\posts\PostController@edit');
$router->post('admin/posts/delete/{id}', 'Admin\posts\PostController@delete');


$router->get('admin/roles', 'Admin\acl\RolesController@index');
$router->get('admin/roles/add', 'Admin\acl\RolesController@add');
$router->get('admin/roles/edit/{id}', 'Admin\acl\RolesController@edit');
$router->get('admin/roles/delete/{id}', 'Admin\acl\RolesController@delete');

$router->post('admin/roles/add', 'Admin\acl\RolesController@add');
$router->post('admin/roles/edit/{id}', 'Admin\acl\RolesController@edit');
$router->post('admin/roles/delete/{id}', 'Admin\acl\RolesController@delete');

$router->get('admin/users', 'Admin\users\UsersController@index');
$router->get('admin/users/add', 'Admin\users\UsersController@add');
$router->post('admin/users/add', 'Admin\users\UsersController@add');

$router->get('admin/users/edit/{id}', 'Admin\users\UsersController@edit');
$router->post('admin/users/edit/{id}', 'Admin\users\UsersController@edit');

$router->get('admin/users/delete/{id}', 'Admin\users\UsersController@delete');
$router->post('admin/users/delete/{id}', 'Admin\users\UsersController@delete');
