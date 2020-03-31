<?php

/**
 * Model short summary.
 *
 * Model description.
 *
 * @version 1.0
 * @author 79523
 */
namespace Models;

use PDO;
use Config;

class Model
{
    static public $dbh = null;

    public function __construct(){
        $data = Config::get('DB');
        self::$dbh = new PDO('mysql:host=localhost;dbname='.$data['db_name'], $data['user_name'], $data['password']);
    }

    public function select($table, $options){
        $sql = "SELECT * FROM {$table}";
        if (isset($options['where'])){
            $sql .= ' WHERE '.$options['where'];
        }
        return self::$dbh->query($sql);
    }

    public function insert($table, $fields){
        $key = implode(', ', array_keys($fields));
        $value = implode(', ', array_keys($fields));
        $key = str_replace(':', '', $key);

        $sql = "INSERT INTO {$table} ({$key}) VALUES ({$value})";
        $stmt = self::$dbh->prepare($sql);
        $stmt->execute($fields);
    }

    public function update($table, $fields, $options){
        $arrKeys = [];
        foreach($fields as $k=>$v){
            $field = substr($k,1);
            array_push($arrKeys, "{$field}={$k}");
        }
        $key = implode(', ', $arrKeys);

        $sql = "UPDATE {$table} SET {$key}";
        if (isset($options['where'])){
            $sql .= ' WHERE '.$options['where'];
        };
        //$sql = "UPDATE tasks SET content='12345', edit=1, done=1 WHERE id = 13";
        $stmt = self::$dbh->prepare($sql);
        $stmt->execute($fields);
    }
}