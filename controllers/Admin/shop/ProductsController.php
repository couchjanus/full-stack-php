<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
 */
class ProductsController extends Controller {

    /**
     * Просмотр всех товаров
     * @return bool
     */
    public function index () {
        
        $data['products'] = Product::index();
        $data['title'] = 'Admin Product List Page ';
        $this->_view->render('admin/products/index', $data);
    }

    /**
     * Добавление товара
     *
     * @return bool
     */
    public function create () {
        
        //Принимаем данные из формы
        
        if (isset($_POST) and !empty($_POST)) {
        
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Product::store($options);

            header('Location: /admin/products');
        }

        $data['title'] = 'Admin Product Add New Product ';
        $data['categories'] = Category::index();
        $this->_view->render('admin/products/add',$data);
    }

    /**
     * Удаление конкретного товара
     *
     * @param $id товара
     * @return bool
     */
    public function delete ($vars) {
        extract($vars);
        //Проверяем форму
        if (isset($_POST['submit'])) {
            //Если отправлена, то удаляем нужный товар
            Product::destroy($id);
            //и перенаправляем на страницу товаров
            header('Location: /admin/products');
        }

        $data['product_id'] = $id;
        $data['title'] = 'Admin Product Delete Page ';
        $this->_view->render('admin/products/delete',$data);

    }
    /**
     * Редатирование товара
     *
     * @param $id
     * @return bool
     */
    public function edit ($vars) {
        extract($vars);
        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['code'] = trim(strip_tags($_POST['code']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));

            Product::update($id, $options);
            
            header('Location: /admin/products');
        }

        $data['product'] = Product::getProductById($id);
        
        $data['categories'] = Category::index();
        $data['title'] = 'Admin Product Edit Page ';
        $this->_view->render('admin/products/edit',$data);

    }


}
