<?php

namespace hellokant\query;

use hellokant\connection\ConnectionFactory;

class Query
{
    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    public $sql = '';


    public function __construct($sqltable)
    {
        $this->sqltable = $sqltable;
    }

    public static function table($table)
    {
        $query = new Query($table);
        $query->sqltable = $table;
        return $query;
    }

    public function where($champ, $comparaison, $valeur)
    {
        if (!is_null($this->where)) {
            $this->where .= ' AND ';
        }
        $this->where = $champ . ' ' . $comparaison . ' ' . $valeur;
        $config = parse_ini_file("../connection/conf.ini");
        $connection = ConnectionFactory::makeConnection($config); //\hellokant\connection\ConnectionFactory::makeConnection($config);
        //do the where request on the database
        $sql = "SELECT * FROM $this->sqltable WHERE $this->where";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        var_dump($result);
        return $result;
        //return $this;
    }

    public function get()
    {
        $this->sql = "SELECT {$this->fields} FROM {$this->sqltable}";
        if ($this->where != null) {
            $this->sql .= " WHERE {$this->where}";
            //$this->args[] = $this->where[2];

        }
        return $this->sql;
    }

    public function select($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function delete()
    {
        $this->sql = "DELETE FROM {$this->sqltable}";
        if ($this->where != null) {
            $this->sql .= " WHERE {$this->where}";
            // $this->args[] = $this->where[2];
            //do the delete request on the database
            $config = parse_ini_file("../connection/conf.ini");
            $connection = ConnectionFactory::makeConnection($config);
            $stmt = $connection->prepare($this->sql);
            $stmt->execute();
            echo ("<br>deleted");
        }
    }

    public function insert($values)
    {

        $this->sql = "INSERT INTO {$this->sqltable} ({$this->fields}) VALUES ({$values});";
        var_dump($this->sql);
        var_dump($values);
        $config = parse_ini_file("../connection/conf.ini");
        $connection = ConnectionFactory::makeConnection($config);
        $stmt = $connection->prepare($this->sql);
        $stmt->execute();
        echo ("<br>insertion effectué");
    }

    public function getField()
    {
        return $this->fields;
    }

    public function setField($fields)
    {
        $this->fields = $fields;
    }
}

require_once '../../../vendor/autoload.php';
$query = new Query('test');
//Delete
//$query->where('id', '=', 5);
//$query->delete();

// Insert
//$query->setField('Nom');
//$query->insert('\'David\'');
