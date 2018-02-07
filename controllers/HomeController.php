<?php

class HomeController extends Controller
{
    
    public function __construct(){
        parent::__construct();
    }


	public function index($vars)
	{
		$title = 'Our <b>Cat Members</b>';
        $subtitle = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.';

        $page = 1;
        
        extract($vars);
        
        $page = $page? $page:1;

        //Вывод категорий
        $categories = Category::index();

        $products = Product::getLatestProducts($page);

        //Общее кол-во товаров (для пагинации)
        $total = Product::getTotalProducts();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        
        $breadcrumb = new Breadcrumb();

        $data['breadcrumb'] = $breadcrumb->build(array(
        ));

		$data['products'] = $products;
        $data['categories'] = $categories;
        $data['pagination'] = $pagination;
        $data['title'] = $title;
        $data['subtitle'] = $subtitle;
     
        $this->_view->render('home/index', $data);
        
	}


	public function getProduct($vars)
	{
		$products = Product::index();
        
		echo json_encode($products);
	}

}
