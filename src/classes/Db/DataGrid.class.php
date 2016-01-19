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
        //var_dump($table);
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

        if(isset($_GET['sort']))
        {
            if ($_GET['sort']=="ASC")
            {
                $_GET['sort']= "DESC";
            }
            else
            {
                $_GET['sort']= "ASC";
            }
        }
        else
        {
            $_GET['sort']= "ASC";
        }

        $this->builder = new QueryBuilder();
        $data = $this->database->getFieldsNames($table);
        //var_dump($data);
        //var_dump($this->perPage);

        $sql = $this->builder->select()->from($table)->order($_GET['order'], $_GET['sort'])->limit(($this->cPage-1)*$this->perPage, $this->perPage);

        if (isset($_GET["search"]))
        {
            foreach ($_GET["search"] as $key => $value)
            {
                if ($value!='')
                {
                    //$key = substr($key, 1, -1);
                    //var_dump($key);
                    $arg = $key." LIKE '%".$value."%'";
                    $sql = $sql->where($arg);
                }

            }
        }

        $sql = $sql->GetSQL();
        $result = $this->database->fetch($sql);
        var_dump($sql);
        unset($this->builder);
        return array("result" => $result, "data" =>$data);
    }

    public function ParseURL()
    {
        $file = explode('?', $_SERVER['REQUEST_URI']);
        if (isset($file[1]))
        {
            if (preg_match('#sort#', $file[1]))
            {
                $data = explode('&', $file[1]);
                if (preg_match('#p=[0-9]+#', $file[1]))
                {
                    return $data[1]."&".$data[2];
                }
                return $data[0]."&".$data[1];
            }
        }

    }
}
 ?>
