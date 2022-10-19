<?php
    namespace hellokant\query;
    class Query {
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

        public function where($champ,$comparaison,$valeur)
        {
            if (!is_null($this->where)) {
                $this->where .= ' AND ';
            }
            $this->where = $champ . ' ' . $comparaison .' '. $valeur;
            return $this;
        }

        public function get()
        {
            $this->sql = "SELECT {$this->fields} FROM {$this->sqltable}";
            if($this->where != null)
            {
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
            if($this->where != null)
            {
                $this->sql .= " WHERE {$this->where}";
               // $this->args[] = $this->where[2];
            }
            

        }

        public function insert($values)
        {
            $this->sql = "INSERT INTO {$this->sqltable} ({$this->fields}) VALUES ({$values})";

        }
        

        
    }

    
