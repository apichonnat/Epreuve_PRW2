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
    public $str_update;
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
        $this->builder = new QueryBuilder();
        $resultat = $this->database->fetch($table);
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

        $sql = $this->builder->select()->from($table)->order($_GET['order'], $_GET['sort']);

        if (isset($_GET["search"]))
        {
            foreach ($_GET["search"] as $key => $value)
            {
                if ($value!='')
                {
                    $arg = $key." LIKE '%".addslashes($value)."%'";
                    $sql = $sql->where($arg);
                }
            }
        }
        $sqlpag = $sql->GetSQL();
        $p = $this->pagination($sqlpag);
        $sql = $sql->limit(($this->cPage-1)*$this->perPage, $this->perPage);
        $sql = $sql->GetSQL();
        $result = $this->database->fetch($sql);
        //var_dump($sql);
        unset($this->builder);
        return array("result" => $result, "data" => $data, "p" => $p);
    }

    public function ParseURL()
    {
        $file = explode('?', $_SERVER['REQUEST_URI']);
        if (isset($file[1]))
        {
            $result = "";
            if (preg_match('#sort#', $file[1]))
            {
                $data = explode('&', $file[1]);
                if (preg_match('#p=[0-9]+#', $file[1]))
                {
                    $result = $data[1]."&".$data[2];
                }
                $result = $data[0]."&".$data[1];
            }

            if (preg_match('#search#', $file[1]))
            {
                $data = explode('&', $file[1]);
                for ($i=3; $i < count($data); $i++)
                {
                    $result .= $data[$i];
                }
            }
            return $result;
        }

    }

    public function crud($table)
    {
        $this->builder = new QueryBuilder($this->database);
        if (isset($_GET['del']))
        {
            $sql = $this->builder->delete($table, $_GET['del']);
            $this->database->query($sql);
            return "view.php";
        }
        if (isset($_GET['upd']))
        {
            $this->str_update = $this->getDataById($table, $_GET['upd']);
            return "viewUpdate.php";
        }
        if (isset($_GET['new']))
        {
            return "viewNew.php";
        }
        return "view.php";
    }

    public function newdata($table)
    {
        $value = $this->nameChampbyTable($table);
        if (!isset($_GET['insert'.$value[1]]))return;
        $set = false;
        for($i=1; $i < count($value) ; $i++)
        {
            if ($_GET['insert'.$value[$i]]=='')$set = true;
        }
        if ($set)
        {
            ?><script type="text/javascript"> alert("tous les champs doivent être rempli !!!!!!!"); </script><?php
            return;
        }
        $builder = new QueryBuilder($this->database);


        for ($i=1; $i < count($value) ; $i++)
        {
                $datainsert[$value[$i]]=addslashes($_GET["insert".$value[$i]]);
        }
        $sql = $builder->insert($table, $datainsert);
        $this->database->query($sql);
        return;
    }

    public function getDataById($table, $id)
    {
        $builder = new QueryBuilder();
        $sql = $builder->select()->from($table)->where(DB_ID_NAME.' = '.$id)->GetSQL();
        $result = $this->database->fetch($sql);
        return $result;

    }

    public function UpdateData($table)
    {
        $value = $this->nameChampbyTable($table);

        if (!isset($_POST['update'.$value[2]]))return;
        $this->builder = new QueryBuilder($this->database);

        for ($i=1 ; $i < count($value) ; $i++)
        {
            $attribu[$value[$i]] = addslashes($_POST["update".$value[$i]]);
        }

        $sql = $this->builder->update($table, $_POST ['updateid'], $attribu);

        $this->database->query($sql);
        print_r($sql);
        return;

    }


}
 ?>
