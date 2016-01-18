<?php
namespace Db;
require("ConnectPDO.class.php");
require("QueryBuilder.class.php");


class DataGrid
{
    private $database;
    private $builder;
    private $perPage;
    private $cPage;

    function __construct($config)
    {
        if(count($config["db"]) != 4)
        {
			throw new \Exception("Le nombre d'arguments n'est pas valable!");
		}
        $this->database = new ConnectPDO($config["db"]);
    }

    public function pagination($table)
    {
        var_dump($table);
        $this->builder = new QueryBuilder();
        $sql1 = $this->builder->select('count(id) as nbarticle')->from($table)->getSql();
        //var_dump($sql1);
        $resultat = $this->database->fetch($sql1);
        $nbArt = $resultat[0]['nbarticle'];

        $this->perPage = 4; //$perPAge = $_GET['perPage'];

        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $this->perPage)
        {
            $this->cPage = $_GET['p'];
        }
        else
        {
            $this->cPage = 1;
        }
        //var_dump($nbArt);


        $nbPage = ceil($nbArt/$this->perPage);

        return $nbPage;

    }


    public function render($table)
    {


        if(!isset($_GET['order']))$_GET['order'] = "id";
        //var_dump($_GET['order']);

        if(isset($_GET['o']))
        {
            if ($_GET['o']=="ASC")
            {
                $_GET['o']= "DESC";
            }
            else
            {
                $_GET['o']= "ASC";
            }
        }
        else
        {
            $_GET['o']= "ASC";
        }


        $this->builder = new QueryBuilder();
        $data = $this->database->getFieldsNames($table);
        var_dump($data);
        var_dump($this->perPage);
        $sql = $this->builder->select()->from($table)->order($_GET['order'], $_GET['o'])->limit(($this->cPage-1)*$this->perPage, $this->perPage)->getSql();
        $result = $this->database->fetch($sql);



        var_dump($sql);
        var_dump($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        unset($this->builder);
        return array("result" => $result, "data" =>$data);

    }


}
 ?>
