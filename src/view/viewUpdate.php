<form class="form" action="index.php" method="post">
    <table class='table table-bordered table-new'>
        <tr>
            <td><a href="index.php">Retour</a></td>
            <td>Update</td>
        </tr>
        <?php
            $data = $dt->str_update;
            $nbchamp = 0;
            $value = $dt->nameChampbyTable($config['db']['table']);
            echo"<input class='new' type='hidden' name='updateid' value='".$data[0][$value[0]]."'>";
            for ($i=1; $i < count($value); $i++)
            {
                echo "<tr>";
                echo "<td>".$config['champ_title'][$value[$i]]."</td>";
                echo "<td><input class='new' type='text' name='update".$value[$i]."' value='".$data[0][$value[$i]]."'></td>";
                echo "</tr>";
            }
            echo "<tr><td><input class='button' value='Update' type='submit'></td></tr>";
        ?>

    </table>
</form>
