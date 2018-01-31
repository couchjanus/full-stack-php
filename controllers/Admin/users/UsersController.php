<?php

class UsersController extends Controller{

    public function index (){
            $data['users'] = User::index();
            $data['title'] = 'Admin User List Page ';
            $this->_view->render('admin/users/index',$data);
    }


    public function delete ($vars) {

        extract($vars);

        if (isset($_POST['submit'])) {
            User::destroy($id);
            header('Location: /admin/users');
        }
        $data['title'] = 'Admin User Delete Page ';
        $data['user_id'] = $id;

        $this->_view->render('admin/users/delete', $data);

    }


    public function add () {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['role'] = $_POST['role'];
            $options['password'] = trim(strip_tags($_POST['password']));
            User::store($options);
            header('Location: /admin/users');
        }
        $data['title'] = 'Admin User Add Page ';
        $data['roles'] = Role::index();
        $this->_view->render('admin/users/create',$data);
        
    }

    
    public function edit ($vars) {
        
        extract($vars);

        $user = User::get($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['password'] = trim(strip_tags($_POST['password']));
            $options['role'] = $_POST['role'];
            $options['status'] = $_POST['status'];
            User::update($id, $options);

            header('Location: /admin/users');
        }
        $data['title'] = 'Admin User Edit Page ';
        $data['roles'] = Role::index();
        $data['user'] = $user;
        
        $this->_view->render('admin/users/edit',$data);

    }
}
