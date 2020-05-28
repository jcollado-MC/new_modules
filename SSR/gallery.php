<?php
include 'class.mySSR2.php';
$ssr = new mySSR2(1, 'GALLERY');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reports Mockup</title>
        <script src="../Jquery/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="ssr_css.css">
        <link rel="stylesheet" type="text/css" href="../columns/styles.css">
        <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
    </head>


    <body>
        <main>
            <div class="content col-12">
                <?php
                echo $ssr->show();
                ?>
            </div>
        </main>
        <script src="ssr_js.js"></script>
        <script src="../columns/scripts.js"></script>
    </body>
</html>
