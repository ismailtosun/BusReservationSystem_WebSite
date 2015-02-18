<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Yönetici Paneli</title>
    <meta name="description" content="">
    <meta name="author" content="Walking Pixels | www.walkingpixels.com">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery Visualize Styles -->
    <link rel='stylesheet' type='text/css' href='css/plugins/jquery.visualize.css'>

    <!-- jQuery jGrowl Styles -->
    <link rel='stylesheet' type='text/css' href='css/plugins/jquery.jgrowl.css'>

    <!-- CSS styles -->
    <link rel='stylesheet' type='text/css' href='css/huraga-red.css'>
    <link rel='stylesheet' type='text/css' href='css/bootstrap-datetimepicker.min.css'>
    <link rel='stylesheet' type='text/css' href='css/validationEngine.jquery.css'>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="img/icons/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/icons/apple-touch-icon-57-precomposed.png">

    <!-- JS Libs -->
    <script src="js/libs/jquery.js"></script>
    <script src="js/libs/modernizr.js"></script>
    <script src="js/libs/selectivizr.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/jquery.validationEngine.js"></script>
    <script src="js/jquery.validationEngine-en.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                language: 'tr-TR'
            });

            $("form").validationEngine();

        });
    </script>
    </head>
<body>

<!-- Main page header -->
<header class="container">

    <!-- Main page logo -->
    <h1><a href="login.html" class="brand">Otobüs Firması</a></h1>

    <!-- Main page headline -->
    <p>Yönetici Paneli</p>

    <!-- Alternative navigation -->
    <nav>
        <ul>
            <li><a href="../login.php?logout=1">Çıkış</a></li>
        </ul>
    </nav>
    <!-- /Alternative navigation -->

</header>
<!-- /Main page header -->
