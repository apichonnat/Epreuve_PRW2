

<nav>
    <ul class="pagination">
    <li>
        <a href="index.php?p=1" aria-label="Previous"><span aria-hidden="true">Première page</span></a>
    </li>
<?php
    
    for ($i=1; $i <=$info["p"] ; $i++)
    {
        if ($order_url != null)echo "<li><a href=index.php?p=$i&".$order_url."> $i </a></li>";
        else echo "<li><a href=index.php?p=$i> $i </a></li>";
    }
?>
    <li>
        <a href='index.php?p=<?php echo$i-1; ?>' aria-label="Next"><span aria-hidden="true">Dernière page</span></a>
    </li>
    </ul>
</nav>
<?php

    echo "<table class='table table-bordered table-data'><tr>";
    foreach ($info["data"] as $name)
    {
        echo "<td><a href='index.php?order=".$name."&sort=".$_GET['sort']."'>".$config['champ_title'][$name]."</a></td>";
    }
    echo "<td><a href='index.php?new=article'>New</a></td>";
    echo "</tr><tr>";
    echo "<form class= action='index.php' method='get'>";
    for ($i=0; $i < count($info["data"]); $i++)
    {
        echo "<td><input class='search' type='text' name=search[".$info["data"][$i]."]></td>";
    }
    echo "<td><input class='button' value='Search' type='submit'></td>";
    echo "</form>";
    echo "</tr>";

    foreach ($info["result"] as $row)
    {
        echo "<tr>";
        foreach ($row as $name)
        {
            echo "<td>".$name."</td>";
        }
        echo "<td><a href='index.php?del=".$row[DB_ID_NAME]."'>Delete</a><br><a href='index.php?upd=".$row[DB_ID_NAME]."'>Update</a></td>";
        echo "</tr>";
    }

?>
