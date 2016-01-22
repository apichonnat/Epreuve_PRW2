<form class="form" action="" method="get">
    <table class='table table-bordered table-new'>
        <?php
            $nbchamp = 0;
            $value = $dt->nameChampbyTable($config['db']['table']);
            for ($i=1; $i < count($value); $i++)
            //foreach($value as $row)
            {
                echo "<tr>";
                echo "<td>".$config['champ_title'][$value[$i]]."</td>";
                echo "<td><input class='new' type='text' name='insert".$value[$i]."'></td>";
                echo "</tr>";
            }
            echo "<tr><td><input class='button' value='Insert' type='submit'></td></tr>";
        ?>

    </table>
</form>
