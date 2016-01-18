
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <?php
        for ($i=1; $i <=$p ; $i++)
        {

            echo "<a href=index.php?p=$i&> $i </a>/";
        }
        echo "<table class='table table-bordered'><tr>";

        foreach ($info["data"] as $name)
        {
            echo "<td><a href='index.php?order=".$name."&o=".$_GET['o']."'>".$name."</a></td>";
        }
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
    </body>
</html>
