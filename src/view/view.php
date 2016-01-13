
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form action="index.php" method="GET">
            <select name="LimitDown" onchange="submit();">
                <option value="10">10
                <option value="20">20
                <option>50
                <option>100
            </select>
        </form>
        <?php
        echo "<table class='table table-bordered'><tr>";
        echo "<td><a href='index.php?order=".$info["data"][0]."&o=".$_GET['o']."'>".$info["data"][0]."</a></td>";
        echo "<td><a href='index.php?order=".$info["data"][1]."&o=".$_GET['o']."'>".$info["data"][1]."</a></td>";
        echo "<td><a href='index.php?order=".$info["data"][2]."&o=".$_GET['o']."'>".$info["data"][2]."</a></td>";
        echo "<td><a href='index.php?order=".$info["data"][3]."&o=".$_GET['o']."'>".$info["data"][3]."</a></td>";
        echo "</tr>";
        foreach ($info["result"] as $row)
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['category_id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "</tr>";
        }

        ?>
    </body>
</html>
