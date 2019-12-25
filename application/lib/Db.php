<?php

namespace application\lib;
use PDO;
class Db
{
    protected $db;
    public function __construct()
    {
        $host = 'localhost';
        $db   = 'blog';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->db = new PDO($dsn, $user, $pass, $opt);


    }
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {

            foreach ($params as $key=>$val)  {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }

            $stmt->bindValue(':'.$key,$val,$type);



            }
        }

       $stmt->execute();
        return $stmt;
    }
    public function row($sql,$params=[]){
        $result=$this->query($sql,$params);

        return $result->fetchAll();

    }

    public function colum($sql,$params=[]){
        $result=$this->query($sql,$params);
        return $result->fetchColumn();
    }
    public function lastId(){

       return $this->db->lastInsertId();
    }

}