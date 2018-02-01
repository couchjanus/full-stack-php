<?php


class RolesController extends Controller{

    public function index (){
            $data['roles'] = Role::index();
            $data['title'] = 'Admin Role List Page ';
            $this->_view->render('admin/roles/index',$data);
    }

    public function delete ($vars) {

        extract($vars);

        if (isset($_POST['submit'])) {
            Role::delete($id);
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Role Delete Page ';
        $data['role_id'] = $id;

        $this->_view->render('admin/roles/delete', $data);

    }

    public function add () {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));

            Role::add($options);
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Role Add Page ';
       
        $this->_view->render('admin/roles/add',$data);
        
    }

    public function edit ($vars) {
       
        extract($vars);

        list($role, $perms) = Role::get($id);
        $permissions = Permission::index();

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
     
            Role::edit($id, $options);
            
            if(!empty($_POST['check_list'])){
                foreach($_POST['check_list'] as $selected){
                Role::insertPerm($id, $selected);
                }
             }
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Category Edit Page ';
        $data['role'] = $role;
        $data['perms'] = $perms;
        $data['permissions'] = $permissions;
        $this->_view->render('admin/roles/edit',$data);

    }
}
