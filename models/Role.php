<?php

class Role {

    public static function index () {
        $db = Connection::make();

        $sql = "SELECT id, name FROM roles
                ORDER BY id ASC";
        $res = $db->query($sql);

        $roles = $res->fetchAll(PDO::FETCH_ASSOC);
        return $roles;
    }
 
    public static function destroy ($id) {
        $db = Connection::make();
        $sql = "DELETE FROM roles WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }


    public static function store ($options) {

        $db = Connection::make();
        // $db->exec("set names utf8");

        $sql = "INSERT INTO roles(name)
                VALUES (:name)";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);

        return $res->execute();
    }

    public static function get ($id) {

        $db = Connection::make();
        $sql = "SELECT name FROM roles
                WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id);
        $res->execute();
        
        $role = $res->fetch(PDO::FETCH_ASSOC);

        return $role;
    }

    public static function update ($id, $options) {

        $db = Connection::make();
        $sql = "UPDATE roles
                SET
                    name = :name
                WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }
}
