<?php


class PermissionsController extends Controller{

    public function index (){
            $data['permissions'] = Permission::index();
            $data['title'] = 'Admin Permissions List Page ';
            $this->_view->render('admin/permissions/index',$data);
    }

    public function delete ($vars) {

        extract($vars);

        if (isset($_POST['submit'])) {
            Permission::delete($id);
            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Delete Page ';
        $data['permission_id'] = $id;

        $this->_view->render('admin/permissions/delete', $data);

    }

    public function add () {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));

            Permission::add($options);
            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Add Page ';
       
        $this->_view->render('admin/permissions/add',$data);
        
    }

    public function edit ($vars) {
       
        extract($vars);

        $permission = Permission::get($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
     
            Permission::edit($id, $options);

            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Edit Page ';
        $data['permission'] = $permission;
        
        $this->_view->render('admin/permissions/edit',$data);

    }
}
