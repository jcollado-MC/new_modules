<?php
include 'class.ssralex.php';
$ssr = new ssr2(1, 'TABLE');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reports Mockup</title>
        <script src="../Jquery/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="ssr_css.css">
        <link rel="stylesheet" type="text/css" href="../Styles/styles.css">
        <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
    </head>


    <body>
        <main>
            <div class="content col-12">
                <?php
                echo $ssr->sidebar();
                echo $ssr->filter();
                echo $ssr->actions();
                ?>
            </div>
        </main>
        <script src="ssr_js.js"></script>
        <script src="../JS/scripts.js"></script>
    </body>
</html>
