<?php

/**
 * Модель для работы с пользователями
 */
class User {

   private $role;

   protected static function encryptPw($password)
    {
        $hash = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);
        return $hash;
    }
    protected static function checkPw($userpassword, $dbpassword)
    {
        $resp = password_verify($userpassword, $dbpassword);
        return $resp;
    }

    public static function index () {
        try {
            $con = Connection::make();
            $sql = "SELECT * FROM users ORDER BY id ASC";
            $res = $con->query($sql);
            $result = $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public static function store ($options) {
        try {
            $db = Connection::make();
            $sql = "INSERT INTO users(name, email, password, role_id)
                VALUES(:name, :email, :password, :role)";

            $res = $db->prepare($sql);
            $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
            $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
            // generate new password
            $hash = self::encryptPw($options['password']);
            $res->bindParam(':password', $hash, PDO::PARAM_STR);
            $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
            $res->execute();
            unset($res);
        } catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        //Determines returned value ('true' or error code)
        if (!isset($err)) {
            $response = true;
        } else {
            $response = $err;
        };
        return $response;
    }

    /**
     * информация о пользователе по id
     *
     * @param $userId
     * @return mixed
     */
    public static function get($userId) {
        try {
            $db = Connection::make();
            $sql = "SELECT * FROM users WHERE id = :id";

            $res = $db->prepare($sql);
            $res->bindParam(':id', $userId);
            $res->execute();
            $result = $res->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }


    public static function getUserById ($userId) {
        try {
            $db = Connection::make();
            $sql = "SELECT * FROM users WHERE id = :id";

            $res = $db->prepare($sql);
            $res->bindParam(':id', $userId);
            $res->execute();
            $result = $res->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }

    private static function getUserPassword($userId)
    {
        $result = array();
        try {
            $db = Connection::make();
            $sql = "SELECT password FROM users WHERE id = :userId";
            $res = $db->prepare($sql);
            $res->bindParam(':userId', $userId, PDO::PARAM_INT);
            $res->execute();
            $result = $res->fetch(PDO::FETCH_ASSOC)['password'];
            } catch (PDOException $e) {
                $result = "Error: " . $e->getMessage();
            }
        return $result;
    }

    public static function update ($userId, $options){
        try {
            $db = Connection::make();
            $passwordFromDatabase = self::getUserPassword($userId);
            $password = $options['password'];

            if(!self::checkPw($options['password'], $passwordFromDatabase)){
                $password = self::encryptPw($options['password']);
            }

            $sql = "UPDATE users
                        SET name = :name, password = :password, email = :email, role_id = :role, status = :status
                        WHERE id = :id";
            $res = $db->prepare($sql);
            $res->bindParam(':password', $password, PDO::PARAM_STR);
            $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
            $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
            $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
            $status = $options['status']? 1:0;
            $res->bindParam(':status', $status, PDO::PARAM_INT);
            $res->bindParam(':id', $userId, PDO::PARAM_INT);
            $result =  $res->execute();
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }

     public static function destroy ($id) {
        try {
            $db = Connection::make();
            $sql = "DELETE FROM users WHERE id = :id";
            $res = $db->prepare($sql);
            $res->bindParam(':id', $id, PDO::PARAM_INT);
            $res->execute();
        } catch (PDOException $e) {
            $err = 'Error: ' . $e->getMessage();
        }
        $resp = ($err == '') ? true : $err;
        return $resp;
    }

    /**
     *Запись пользователя в сессию
     *
     * @param $userId
     */
    public static function auth ($userId) {
        Session::set('userId',$userId);
        Session::set('logged',true);
    }

    /**
     * Проверяем, авторизован ли пользователь при переходе в личный кабинет
     *
     * @return mixed
     */
    public static function checkLog () {
        //Если сессия есть, то возвращаем id пользователя
       if ((Session::get('userId'))) {
           return Session::get('userId');
       }
       header('Location: user/login');
   }

   /**
    * Проверяем наличие открытой сессии у пользователя для
    * отображения на сайте необходимой информации
    *
    * @return bool
    */
   public static function isGuest () {

       if (Session::get('logged') == true) {
           return false;
       }
       return true;
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
     */
    public static function checkEmailExists ($email) {
        try {
            $db = Connection::make();
            $sql = "SELECT count(*) FROM users WHERE email = :email";
            $res = $db->prepare($sql);
            $res->bindParam(':email', $email, PDO::PARAM_STR);
            $res->execute();
            if ($res->fetchColumn()){
                $result = true;
            }
            else {
                $result = false;
            }
        } catch (PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }
    /**
     * Проверка на существовние введенных данных при ааторизации
     *
     * @param $email
     * @param $password
     * @return bool
     */
    public static function checkUserData ($email, $password) {

        $db = Connection::make();
        $sql = "SELECT * FROM users WHERE email = :email";
        $res = $db->prepare($sql);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();
        $user = $res->fetch();

        if(!self::checkPw($password, $user['password'])){
            return $user['id'];
        }
        return false;
    }

    // check if user has a specific privilege

    public function hasPrivilege($perm) {
        if ($this->role->hasPerm($perm)) {
            return true;
        }
        return false;
    }


}
