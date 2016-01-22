<html>
    <head>
        <?php
        require 'src/classes/Db/DataGrid.class.php';
        $config = include("src/config/config.php");
        $dt = new Db\DataGrid($config);
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <meta charset="utf-8">
        <title>Epreuve</title>
    </head>
    <body>
        <?php
            $info = $dt->render($config['db']['table']);
            $order_url = $dt->ParseURL();
            $dt->newdata($config['db']['table']);
            require("src/view/".$dt->crud());
            //require 'src/view/view.php';
        ?>
    </body>
</html>
