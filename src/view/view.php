

        <?php
        for ($i=1; $i <=$info["p"] ; $i++)
        {
            if ($order_url != null)echo "<a href=index.php?p=$i&".$order_url."> $i </a>/";
            else echo "<a href=index.php?p=$i> $i </a>/";
        }

        echo "<table class='table table-bordered table-data'><tr>";
        foreach ($info["data"] as $name)
        {
            echo "<td><a href='index.php?order=".$name."&sort=".$_GET['sort']."'>".$config['champ_title'][$name]."</a></td>";
        }
        echo "</tr><tr>";
        echo "<form class= action='index.php' method='get'>";
        for ($i=0; $i < count($info["data"]); $i++)
        {
            echo "<td><input class='search' type='text' name=search[".$info["data"][$i]."]></td>";
        }
        echo "<td><input class='button' value='Search' type='submit'</td>";
        echo "</form>";
        echo "</tr>";

        foreach ($info["result"] as $row)
        {
            echo "<tr>";
            foreach ($row as $name)
            {
                echo "<td>".$name."</td>";
            }
            echo "</tr>";
        }

        ?>
