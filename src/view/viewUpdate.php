<form class="form" action="" method="get">
    <table class='table table-bordered table-new'>
        <tr>
            <td><a href="index.php">Retour</a></td>
            <td>Update</td>
        </tr>
        <?php
            $nbchamp = 0;
            $value = $dt->nameChampbyTable($config['db']['table']);
            for ($i=0; $i < count($value); $i++)
            //foreach($value as $row)
            {
                echo "<tr>";
                echo "<td>".$config['champ_title'][$value[$i]]."</td>";
                echo "<td><input class='new' type='text' name='update".$value[$i]."' value=''></td>";
                echo "</tr>";
            }
            echo "<tr><td><input class='button' value='Update' type='submit'></td></tr>";
        ?>

    </table>
</form>
