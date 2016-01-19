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

    private $champ;

    function __construct($config)
    {
        if(count($config["db"]) < 4)
        {
			throw new \Exception("Le nombre d'arguments n'est pas valable!");
		}
        $this->database = new ConnectPDO($config["db"]);
    }

    public function pagination($table)
    {
        //var_dump($table);
        $this->builder = new QueryBuilder();
        //$sql1 = $this->builder->select('count(id) as nbarticle')->from($table)->getSql();
        //var_dump($sql1);
        $resultat = $this->database->fetch($table);
        //$nbArt = $resultat[0]['nbarticle'];
        $nbArt = count($resultat);
        $this->perPage = 10; //$perPAge = $_GET['perPage'];

        $nbPage = ceil($nbArt/$this->perPage);
        if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
        {
            $this->cPage = $_GET['p'];
        }
        else
        {
            $this->cPage = 1;
        }
        return $nbPage;
    }

    public function nameChampbyTable($table)
    {
        $this->builder = new QueryBuilder();
        return $this->database->getFieldsNames($table);
    }


    public function render($table)
    {
        if(!isset($_GET['order']))$_GET['order'] = DB_ID_NAME;
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

        $data = $this->nameChampbyTable($table);

        $this->builder = new QueryBuilder();
        //var_dump($data);
        //var_dump($this->perPage);
        $sql = $this->builder->select()->from($table)->order($_GET['order'], $_GET['sort']);

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
        //$p = $this->pagination("articles");
        $sqlpag = $sql->GetSQL();
        $p = $this->pagination($sqlpag);
        $sql = $sql->limit(($this->cPage-1)*$this->perPage, $this->perPage);

        $sql = $sql->GetSQL();
        $result = $this->database->fetch($sql);
        var_dump($sql);
        unset($this->builder);
        return array("result" => $result, "data" => $data, "p" => $p);
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

    public function crud()
    {
        $this->builder = new QueryBuilder($this->database);
        if (isset($_GET['del']))
        {
            $sql = $this->builder->delete('articles', $_GET['del']);
            var_dump($sql);
            $this->database->query($sql);
            return "view.php";
        }
        if (isset($_GET['upd']))
        {
            return "viewUpdate.php";
        }
        if (isset($_GET['new']))
        {
            return "viewNew.php";
        }

        return "view.php";
    }

}
 ?>
