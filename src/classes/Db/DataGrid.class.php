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
        $sql = $this->builder->select()->from('articles')->order($_GET['order'], $_GET['o'])->getSql();
        $result = $this->database->fetch($sql);



        echo "<table class='table table-bordered'><tr>";
        echo "<td><a href='index.php?order=".$data[0]."&o=".$_GET['o']."'>".$data[0]."</a></td>";
        echo "<td><a href='index.php?order=".$data[1]."&o=".$_GET['o']."'>".$data[1]."</a></td>";
        echo "<td><a href='index.php?order=".$data[2]."&o=".$_GET['o']."'>".$data[2]."</a></td>";
        echo "<td><a href='index.php?order=".$data[3]."&o=".$_GET['o']."'>".$data[3]."</a></td>";
        echo "</tr>";
        foreach ($result as $row)
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['category_id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "</tr>";
        }

        //var_dump($result);
        var_dump($sql);

    }


}
 ?>
