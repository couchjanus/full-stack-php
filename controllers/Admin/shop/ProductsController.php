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

            if(isset($_FILES['image'])){
              $errors= array();
              $file_name = $_FILES['image']['name'];
              $file_size =$_FILES['image']['size'];
              $file_tmp =$_FILES['image']['tmp_name'];
              $file_type=$_FILES['image']['type'];
              $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

              $expensions= array("jpeg","jpg","png");

              if(in_array($file_ext,$expensions)=== false){
                 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
              }

              if($file_size > 2097152){
                 $errors[]='File size must be excately 2 MB';
              }
              
              // Если 
              
              if(empty($errors)==true){

            //     $dirId = Product::nextId();

            //     $dir = $_SERVER['DOCUMENT_ROOT'] ."/media/products/".$dirId."/";
                    
            //     if (!is_dir($dir)) {
            //             mkdir($dir, 0777, true);
            //     }
                
            //     // Проверим, загружалось ли через форму изображение
            //     if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
            //     // Если загружалось, переместим его в нужную папку, дадим новое имя
            //         move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/media/products/{$dirId}/{$file_name}");
            //     }
                    
            //     $options['picture'] = $file_name;
                    
            //     Product::store($options);
            //     header('Location: /admin/products');
            //   }
            //   else{
            //         if(isset($_SERVER['HTTP_REFERER'])) {
            //             $previous = $_SERVER['HTTP_REFERER'];
            //         }
            //         header("Location: $previous");
            //   }
//

                 move_uploaded_file($file_tmp,"media/".$file_name);
                 $options['picture'] = $file_name;

              }else{
                 print_r($errors);
              }
            }

            Product::store($options);

            header('Location: /admin/products');
        }

        $data['title'] = 'Admin Product Add New Product ';
        $data['categories'] = Category::index();
        $this->_view->render('admin/products/create',$data);
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
            Product::delete($id);
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

        //Получаем информацию о выбранном товаре
        extract($vars);

        $product = Product::getProductById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));
            
            // Проверим, загружалось ли через форму изображение
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                $file_name = $_FILES['image']['name'];
                // Если загружалось, переместим его в нужную папке, дадим новое имя
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/media/products/{$id}/{$file_name}");
                $options['picture'] = $file_name;
            }else{
                $options['picture'] = $product['picture'];
            }
            Product::update($id, $options);
            header('Location: /admin/products');
        }
      
        $data['product'] = Product::getProductById($id);
        $data['categories'] = Category::index();
        $data['title'] = 'Admin Product Edit Page ';
        
        $this->_view->render('admin/products/edit',$data);
        
    }


}
