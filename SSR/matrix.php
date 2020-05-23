<?php
include 'class.ssr.php';
$ssr = new ssr();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reports Mockup</title>
        <script src="../Jquery/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="ssr_css.css">
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
        <link rel="stylesheet" type="text/css" href="../Styles/dropdown.css">
        <link rel="stylesheet" type="text/css" href="../Styles/toggle_switch.css">
        <link rel="stylesheet" type="text/css" href="../Styles/sidebar.css">
        <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
    </head>


    <body>
        <main>
            <div class="content col-12">
                <?php

                echo ssr::show(2);

                ?>
            </div>
        </main>
        <script src="ssr_js.js"></script>
        <script src="../js/dropdown.js"></script>
    </body>
</html>
