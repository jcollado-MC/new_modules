<?php
include 'class.myPlanner.php';
$planner = new myPlanner('2020-05-04', '2020-05-10');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Planner Mockup</title>
    <link rel="stylesheet" type="text/css" href="../columns/styles.css">
    <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
    <script src='../Jquery/jquery-3.4.1.min.js'></script>
    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'
                      integrity='sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU='
                      crossorigin='anonymous'></script>
    <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
</head>


<body>
<main>
    <div class="content col-12">
        <?php
        echo $planner->show();
        ?>
    </div>
</main>
</body>
</html>