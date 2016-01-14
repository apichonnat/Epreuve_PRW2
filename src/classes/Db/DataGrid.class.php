<?php
namespace Db;
require("ConnectPDO.class.php");
require("QueryBuilder.class.php");


class DataGrid
{
    private $database;
    private $builder;
    function __construct($config)
    {
        if(count($config["db"]) != 4)
        {
			throw new \Exception("Le nombre d'arguments n'est pas valable!");
		}
        $this->database = new ConnectPDO($config["db"]);

        $this->builder = new QueryBuilder();
    }


    public function render($table)
    {
        if(!isset($_GET['limitUp']))$_GET['limitUp']= 10;
        if(!isset($_GET['LimitDown']))$_GET['limitDown'] = 0;
        if(!isset($_GET['order']))$_GET['order'] ="id";
        var_dump($_GET['limitDown']);

        if(isset($_GET['o']))
        {
            if ($_GET['o']=="ASC")
            {
                $_GET['o']= "DESC";
            }
            else {
                $_GET['o']= "ASC";
            }
        }
        else
        {
            $_GET['o']= "DESC";
        }


        $data = $this->database->getFieldsNames($table);
        $sql = $this->builder->select()->from('articles')->order($_GET['order'], $_GET['o'])->limit($_GET['limitDown'], $_GET['limitUp'])->getSql();
        $result = $this->database->fetch($sql);
        var_dump($sql);
        return array("result" => $result, "data" =>$data);

    }


}
 ?>
