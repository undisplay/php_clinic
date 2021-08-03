<?php namespace Core;


class Model{
    /**
     * @var PDO instance
     */
    private static $client;

    /**
     * @var string model name
     */
    private $name;

    /**
     * @var array model definition
     */
    private $fields_def;


    /**
     * define("client",[
     *  "id"=>"integer",
     *  "name"=>"varchar(255)"
     * ]);
     * @param string $name
     * @param array  $fields_def
     * @param PDO|null    $client
     */
    public function __construct($name,$fields_def=[],$client=null){
        $this->name = $name;
        $this->fields_def = $fields_def;

        if (isset($client)) {
            $this->client = $client;
        }
        else{
            try {
                $this->client = new \PDO("sqlite:./default.db");
                $this->client->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->client->setAttribute(\PDO::ATTR_PERSISTENT,true);
            } catch (\Throwable $th) {
                echo $th;
            }
        }
    }

    /**
     * sync();
     * @return bool
     */
    public function sync()
    {   
        $sql = "";

        foreach ($this->fields_def as $field => $def) {
            $sql = $sql."{$field} {$def} ,";
        }

        $sql = substr($sql, 0, -1);
        $sql = "CREATE TABLE IF NOT EXISTS {$this->name} ({$sql})";
        
        try {
            return $this->client->exec($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    /**
     * create([
     *  "name"=>"Jhon Doe"
     * ]);
     * @return bool
     */
    public function create($data)
    {   
        $fields = "";
        $values = "";

        foreach ($data as $field => $value) {
            $fields = $fields."{$field} ,";
            if (gettype($value)=="string") {
                $values = $values."\"{$value}\" ,";
            }
            else{
                $values = $values."{$value} ,";
            }
        }

        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);

        $sql = "INSERT INTO {$this->name} ({$fields}) VALUES({$values})";
        echo $sql;
        try {
            return $this->client->exec($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    /**
     * get([
     *  "name"=>[
     *      "selector"=>"LIKE", //sql comparator
     *      "value"=>"Jhon",
     *      "linker"=>"AND"
     *  ],
     *  "id"=>[
     *      "selector"=>">=", //sql comparator
     *      "value"=>0
     *  ]
     * ]);
     * @param  array $selectors
     * @return array PDO::FETCH_ASSOC
     */
    public function get($selectors)
    {
        $sql = "";
        
        foreach ($selectors as $field => $selector) {
            $linker="";
            if (isset($selector["linker"])) {
                $linker=$selector["linker"];
            }
            if (gettype($selector["value"])=="string") {
                $value ="\"{$selector["value"]}\" ";
            }
            else{
                $value ="{$selector["value"]} ";
            }
            $sql = $sql."{$field} {$selector["selector"]} {$value} {$linker} ";
        }
        
        $sql = "SELECT * FROM {$this->name} WHERE {$sql}";
        $sql = substr($sql, 0, -1);
        try {
            $statement  = $this->client->query($sql);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    /**
     * update([
     *  "name"=>[
     *      "selector"=>"LIKE", //sql comparator
     *      "value"=>"Jhon",
     *      "linker"=>"AND"
     *  ],
     *  "id"=>[
     *      "selector"=>">=", //sql comparator
     *      "value"=>0
     *  ]
     * ],
     * [
     *  "name"=>"Jhon Snow"
     * ]);
     * @param  array $selectors
     * @param  array $data
     * @return bool
     */
    public function update($selectors,$data)
    {
        $sql = "";
        $sql1 = "";

        foreach ($data as $field => $value) {
            if (gettype($value)=="string") {
                $sql1 = $sql1." {$field} = \"{$value}\",";
            }
            else{
                $sql1 = $sql1." {$field} = {$value},";
            }
        }

        $sql1 = substr($sql1, 0, -1);

        foreach ($selectors as $field => $selector) {
            $linker="";
            if (isset($selector["linker"])) {
                $linker=$selector["linker"];
            }
            if (gettype($selector["value"])=="string") {
                $value ="\"{$selector["value"]}\" ";
            }
            else{
                $value ="{$selector["value"]} ";
            }

            $sql = $sql."{$field} {$selector["selector"]} {$value} {$linker} ";
        }

        $sql = "UPDATE {$this->name} SET {$sql1} WHERE {$sql}";
        echo $sql;
        try {
            $statement  = $this->client->query($sql);
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    /**
     * delete([
     *  "name"=>[
     *      "selector"=>"LIKE", //sql comparator
     *      "value"=>"Jhon",
     *      "linker"=>"AND"
     *  ],
     *  "id"=>[
     *      "selector"=>">=", //sql comparator
     *      "value"=>0
     *  ]
     * ]);
     * @param  array $selectors
     * @return bool
     */
    public function delete($selectors)
    {
        $sql = "";

        foreach ($selectors as $field => $selector) {
            $linker="";
            if (isset($selector["linker"])) {
                $linker=$selector["linker"];
            }
            $sql = $sql."{$field} {$selector["selector"]} {$selector["value"]} {$linker} ";
        }

        $sql = "DELETE FROM {$this->name} WHERE {$sql}";
        try {  
            return $this->client->exec($sql);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

}

?>