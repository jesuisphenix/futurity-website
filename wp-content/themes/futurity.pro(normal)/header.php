<?php include "functions.php"; ?>
<!doctype html>
<html lang="ru-RU">
<head>
    <title>Futurity – сайты для бизнеса</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=cyrillic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css">
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-2.0.2.min.js"></script>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.viewport.js" type="text/javascript"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
   

    <style type="text/css">
        #YMapsID {
            width: 100%;
            height: 200px;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body>
<div class="theme-wrapper">
        <header class="theme-header">
            <section class="theme-box">
                <span class="descriptor">сайты для бизнеса</span>
                <a href="/"><img src="<?php bloginfo('stylesheet_directory'); ?>/i/logo.png" alt="Futurity"></a>
                <div class="call-us">
                    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
                    <div id="SkypeButton_Chat_futurity.pro_1">
                        <script type="text/javascript">
                            Skype.ui({
                                "name": "chat",
                                "element": "SkypeButton_Chat_futurity.pro_1",
                                "participants": ["futurity.pro"],
                                "imageSize": 32
                            });
                        </script>
                    </div>
                </div>
                
                <nav class="menu-main">
                    <? wp_nav_menu(); ?>
                </nav>
            </section>
        </header>
        
    

<div class="theme-box theme-content">