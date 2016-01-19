<form class="form" action="" method="get">
    <table class='table table-bordered table-data'>
        <tr>
        <?php
            $nbchamp = 0;
            $value = $dt->nameChampbyTable($config['db']['table']);
            foreach($value as $row)
            {
                echo "<td>".$config['champ_title'][$row]."</td>";
                $nbchamp++;
            }
            echo "<td><input class='button' value='Insert' type='submit'></td></tr><tr>";

            for ($i=0; $i <= $nbchamp ; $i++)
            {
                echo "<td><input class='search' type='text' name='' value=''></td>";
            }

        ?>
        </tr>
    </table>
</form>
