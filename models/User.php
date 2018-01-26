<?php

/**
 * Модель для работы с пользователями
 */
class User {
   
   private $role;

   public static function index () {
        $con = Connection::make();
        $sql = "SELECT * FROM users ORDER BY id ASC";
        // $con->exec("set names utf8");
        $res = $con->query($sql);
        $users = $res->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function store ($options) {

        $db = Connection::make();

        $sql = "INSERT INTO users(name, email, password, role_id)
                VALUES(:name, :email, :password, :role)";
        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);

        // generate new password
        $hash = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);

        $res->bindParam(':password', $hash, PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Вытягиваем информацию о пользователе по id
     *
     * @param $userId
     * @return mixed
     */
    public static function get($userId) {

        $db = Connection::make();
        $sql = "SELECT *
                  FROM users
                    WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $userId);
        $res->execute();
        $user = $res->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

 
    public static function update ($userId, $options){

        $db = Connection::make();

        $sql = "SELECT password FROM users WHERE id = :userId";

        $res = $db->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->execute();

        $passwordFromDatabase = $res->fetch(PDO::FETCH_ASSOC)['password'];

        $password = $options['password'];

        if(!password_verify($password, $passwordFromDatabase)){
          // update hash from databse - replace old hash $passwordFromDatabase with new hash $newPasswordHash
            $password = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);
        }

        $sql = "UPDATE users
                    SET name = :name, password = :password, email = :email, role_id = :role, status = :status
                      WHERE id = :id
               ";

        $res = $db->prepare($sql);

        $res->bindParam(':password', $password, PDO::PARAM_STR);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);

        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
        
        $status = $options['status']? 1:0;
        $res->bindParam(':status', $status, PDO::PARAM_INT);
        $res->bindParam(':id', $userId, PDO::PARAM_INT);

        return $res->execute();
    }

     public static function destroy ($id) {
        $db = Connection::make();
        $sql = "DELETE FROM users WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Проверяем поле Имя на корректность
     *
     * @param $name
     * @return bool
     */
    public static function checkName ($name) {
        if (strlen($name) > 1) {
            return true;
        }
        return false;
    }


    /**
     * Проверяем поле Пароль на корректность
     *
     * @param $password
     * @return bool
     */
    public static function checkPassword ($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем поле Email на корректность
     *
     * @param $email
     * @return bool
     */
    public static function checkEmail ($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверем email на доступность
     *
     * @param $email
     * @return bool
     */
    public static function checkEmailExists ($email) {

        $db = Connection::make();

        $sql = "SELECT count(*) FROM users
                    WHERE email = :email
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();

        if ($res->fetchColumn())
            return true;
        return false;
    }



}
