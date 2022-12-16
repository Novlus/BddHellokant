<?php

namespace hellokant\model;

use hellokant\query\Query;

abstract class Model
{

    private $attributes = array();
    protected static $table;
    protected static $query;
    protected static $primaryKey = 'id';
    protected static $config;

    function __construct($attrs = array(), $config = null)
    {
        $this->attributes = $attrs;
        $this->config = $config;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public static function all(): array
    {
        static::$query =  new Query(static::$table, parse_ini_file("../../src/connection/conf.ini"));
        var_dump("query1: " . static::$query);
        $result = static::$query->get();
        $retour = [];
        foreach ($result as $row) {
            $retour[] = new static($row);
        }

        return $retour;
    }

    public static function find(...$args): array
    {
        static::$query =  new Query(static::$table, parse_ini_file("../../src/connection/conf.ini"));
        // var_dump("query2: " . static::$query);
        foreach (static::$query as $q) {
            printf("query2TESST: " . $q);
        }
        $nombreArguments = count($args);
        var_dump("nombreArguments: " . $nombreArguments);
        if ($nombreArguments === 0) {
            return static::all();
        }
        if (($nombreArguments === 1 && is_int($args[0])) || ($nombreArguments === 2 && is_int($args[1]))) {

            static::$query = static::$query->where(static::$primaryKey, '=', ($nombreArguments === 1 ? $args[0] : $args[1]));
        }
        if (($nombreArguments === 1 && is_array($args[0])) || ($nombreArguments === 2 && is_array($args[1]))) {
            static::$query = static::$query->where(...($nombreArguments === 1 ? $args[0] : $args[1]));
        }
        if ($nombreArguments === 2 && is_array($args[0])) {
            static::$query = static::$query->select($args[0]);
        }

        $result = static::$query->get();
        // var_dump("resultat :" . $result);
        $return = [];
        foreach ($result as $row) {
            $return[] = new static($row);
        }
        return $return;
    }

    public function first(...$args): Model
    {
        $result = static::find(...$args);
        return $result[0];
    }

    // public function belongs_to(string $m, string $fk)
    // {
    //     static::$query = Query::table($m::$table)
    //         ->where($m::$primaryKey, '=', $this->$fk);
    //     $result = static::$query->one();
    // }

    // public static function one(int $id)
    // {
    //     static::$query =  new Query(static::$table, parse_ini_file("../../src/connection/conf.ini"));
    //     $result = static::$query->where(static::$primaryKey, '=', $id)->one();
    //     return new static($result);
    // }
}
