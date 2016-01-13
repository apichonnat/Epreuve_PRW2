<html>
    <head>
        <?php
        require 'src/classes/Db/DataGrid.class.php';
        $config = include("src/config/config.php");
        $dt = new Db\DataGrid($config);
        ?>
        <!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <meta charset="utf-8">
        <title>Epreuve</title>
    </head>
    <body>
        <?php
            $info = $dt->render("articles");
            require 'src/view/view.php';
        ?>

    </body>
</html>
