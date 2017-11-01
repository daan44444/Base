<?php
require_once '_assets/php/core/init.php';
$lang_class = new Lang();
$current_page = 'home';
$lang = Cookie::get('lang');
$title = $lang_class->xml_lang->$current_page->title->$lang;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="author" content="<?php echo Config::get('meta/author'); ?>">
    <meta name="description" content="<?php echo Config::get('meta/description'); ?>">
    <meta name="keywords" content="<?php echo Config::get('meta/keywords'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='language' content='<?php echo Cookie::get('lang'); ?>'>
    <!-- favico -->
    <!-- default -->
    <link rel="shortcut icon" href="/_assets/img/favico/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="/_assets/img/favico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/_assets/img/favico/favicon-16x16.png">
    <!-- apple -->
    <link rel="apple-touch-icon" sizes="180x180" href="/_assets/img/favico/apple-touch-icon.png">
    <!-- safari -->
    <link rel="mask-icon" href="/_assets/img/favico/safari-pinned-tab.svg" color="<?php echo Config::get('meta/safari-pt-background'); ?>">
    <!-- android chrome -->
    <link rel="manifest" href="/_assets/img/favico/manifest.json">
    <meta name="apple-mobile-web-app-title" content="<?php echo Config::get('meta/web-app-title'); ?>">
    <meta name="application-name" content="<?php echo Config::get('meta/web-app-title'); ?>">
    <meta name="theme-color" content="<?php echo Config::get('meta/theme-color'); ?>">
    <!-- IE/Edge -->
    <meta name="msapplication-config" content="/_assets/img/favico/browserconfig.xml">
    <meta name="msapplication-TileColor" content="<?php echo Config::get('meta/IE-tile-color'); ?>">



    <!-- title -->
    <title><?php echo $title; ?></title>
    <!-- main.css -->
    <link rel="stylesheet" type="text/css" href="/_assets/css/main.css"/>
    <!-- 4-pages -->

</head>
<body>
<div class="content-wrap">
    <div class="content">

    </div>
</div>
<!-- 1-tools -->
<script type="text/javascript" src="/_assets/js/1-tools/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/_assets/js/1-tools/jquery.cookie.js"></script>
<script type="text/javascript" src="/_assets/js/1-tools/materialize.min.js"></script>
<!-- misc -->
<script type="text/javascript" src="/_assets/js/functions.js"></script>
<!-- 2-pages -->

</body>
</html>
