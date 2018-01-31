<?php

/**
 * Модель для работы с категориями
 */
class Category {


   public static function index () {
        $db = Connection::make();
        $db->exec("set names utf8");

        $sql = "SELECT id, name, status FROM categories               
                ORDER BY id ASC";

        $res = $db->query($sql);

        $categories = $res->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    /**
     * Вместо числового статуса категории, отображаем определенную строку
     *
     * @param $status
     * @return string
     */
    public static function getStatusText ($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

     /**
     * Список категорий для админпанели
     * Возвращает массив всех категорий, включая те, у которых статус отображения = 0
     *
     * @return array
     */
    public static function getActiveCategories () {
        $db = Connection::make();
        $db->exec("set names utf8");

        $sql = "SELECT id, name, status FROM categories
                WHERE status = 1
                ORDER BY id ASC";

        $res = $db->query($sql);

        $categories = $res->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

     /**
     * Добавление категории(админка)
     *
     * @param $options массив параметров
     * @return bool
     */
    public static function store ($options) {

        $db = Connection::make();
        $db->exec("set names utf8");

        $sql = "
                INSERT INTO categories(name, status)
                VALUES (:name, :status)
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $res->execute();
    }

        /**
     * Удаление категории(админка)
     *
     * @param $id
     * @return bool
     */
    public static function destroy ($id) {
        $db = Connection::make();

        $sql = "DELETE FROM categories WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }

        /**
     * Возвращаем инфу о категории по ее id
     *
     * @param $id
     * @return mixed
     */
    public static function get ($id) {

        $db = Connection::make();
        $db->exec("set names utf8");

        $sql = "SELECT name, status FROM categories
                WHERE id = :id";

        $res = $db->prepare($sql);

        $res->bindParam(':id', $id);
        $res->execute();

        $catList = $res->fetch(PDO::FETCH_ASSOC);

        return $catList;
    }

    /**
     * Изменение категории(админка)
     *
     * @param $id
     * @param $options - новые параметры
     * @return bool
     */
    public static function update($id, $options) {

        $db = Connection::make();
        $db->exec("set names utf8");

        $sql = "UPDATE categories
                SET
                    name = :name,
                    status = :status
                WHERE id = :id";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);

        return $res->execute();
    }
 
}
