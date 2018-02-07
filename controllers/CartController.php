<?php

/**
 * Контроллер для работы с корзиной
 */

class CartController extends Controller{

   public function __construct(){
                 parent::__construct();
   }

    public function index (){

        //Получаем id пользователя из сессии
        $userId = User::checkLog();

        //Получаем всю информацию о пользователе из БД
        $user = User::getUserById($userId);

        $productsInCart = $_POST['val'];

        $res = Order::save($userId, $productsInCart);

        echo true;
    }


}
