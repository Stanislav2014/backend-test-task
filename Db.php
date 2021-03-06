<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.05.19
 * Time: 13:47
 */

namespace App;

class Db
{
    private static $instance = null;

    private const DSN = 'mysql:dbname=test;host=localhost;port=3306';
    private const USER = 'user';
    private const PASS = 'Testuser1!';
    private const OPTIONS = array(
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    );

    private function __construct(){}

    private function __wakeup(){}

    private function __clone(){}



    public static function instance()
    {
        if (self::$instance === null) {

            self::$instance = new \PDO(
                self::DSN,
                self::USER,
                self::PASS,
                self::OPTIONS
            );
        }

        return self::$instance;
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array(array(self::instance(), $method ), $arguments);
    }

    public static function run($sql, $args = [])
    {
        if(!$args)
        {
            return self::instance()->query($sql);
        }

        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }


    public function getDirs($id)
    {


    }

};