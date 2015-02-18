
<html>
<head>
    <title>Otobüs Firması</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/colorscheme.css" />
    <link rel='stylesheet' href='css/nivo-slider.css' type='text/css' media='all' />

    <link href="css/start/jquery-ui-1.9.2.custom.css" rel="stylesheet" />
    <script type='text/javascript' src="js/jquery-1.8.3.js"></script>
    <script type='text/javascript' src="js/jquery-ui-1.9.2.custom.js"></script>
    <script type='text/javascript' src='js/jquery.easing.1.3.js'></script>
    <script type='text/javascript' src='js/jquery.tools.min.js'></script>
    <script type='text/javascript' src='js/jquery.preloadify.min.js'></script>
    <script type='text/javascript' src='js/src/galleria.js'></script>
    <script type='text/javascript' src='js/src/themes/classic/galleria.classic.js'></script>
    <script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
    <script type='text/javascript' src='js/sys_custom.js'></script>

    <script type='text/javascript' src='js/nivo/nivo.slider.js'></script>
    <script type='text/javascript' src='js/sys_slider.js'></script>
    <script type='text/javascript' src='js/app.js'></script>

    <script type='text/javascript' src='js/cufon-yui.js'></script>
    <script type='text/javascript' src='js/cufon/Segan.js'></script>
    <script type='text/javascript'>/* <![CDATA[ */Cufon.replace('h1, h2, h3, h4, h5, .infobox h1, .infobox h2, .logo, .dropcap1, .dropcap2, .dropcap3, .dropcap4, .infobox h3, .bigtitle, .infobox p, .subtitle, .subdesc, .subhtml,', { hover: true, fontFamily: 'Segan' });
        /* ]]> */
    </script>


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE 6]>
    <script src="DD_belatedPNG.js" type="text/javascript"></script>
    <script>
        /* EXAMPLE */
        DD_belatedPNG.fix('*');
        /* string argument can be any CSS selector */
        /* .png_bg example is unnecessary */
        /* change it to what suits you! */
    </script>
    <![endif]-->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".datepicker").datepicker();
            $(".datepicker").datepicker("option", "dateFormat", "dd.mm.yy");

            $(".datepicker_birth").datepicker(
                {
                    changeMonth: true,
                    changeYear: true
                });
            $(".datepicker_birth").datepicker("option", "dateFormat", "dd.mm.yy");

        });
    </script>
</head>
<body id="stretched">
    <header id="header">
        <!-- topbar -->
        <div id="topbar">
            <div class="inner">

                <!-- logo -->
                <div class="logo">
                    <a href="index.php">
                        <img src="images/logo.png" alt="logo" />
                    </a>
                </div>
                <!-- logo -->

                <!-- topmenu -->
                <div class="topmenu">
                    <ul class="nav">
                        <li><a href="index.php">Ana Sayfa</a></li>
                        <?php if(isLogged()): ?>
                        	<?php if(isEmployee()): ?>
                            <li><a href="mysales.php">İşlem Geçmişi</a></li>
                            <?php endif; ?>
                            <li><a href="login.php?logout=1">Cıkış Yap</a></li>
                            <li>
                                <a href="#">Hoşgeldin, <?=$_SESSION["user_name"]?></a>
                            </li>
                        <?php else: ?>
                            <li><a href="login.php">Giriş Yap</a></li>
							<li><a href="register.php">Kayıt Ol</a></li>
                        <?php endif; ?>


                    </ul>
                </div>
                <!-- topmenu -->

            </div><!-- inner -->
        </div><!-- topbar -->

        <div class="clear"></div>
        <!--featured slider-->
        <div id="featured_slider">
            <div class="inner">
                <div id="slider">
                    <a href=""><img src="images/slide/1.jpg" alt="" height="300" ></a>
                    <a href=""><img src="images/slide/2.jpg" alt="" height="300" /></a>
                    <a href=""><img src="images/slide/3.jpg" alt="" height="300"/></a>
                </div>
                <!-- Start: Highlight-->
                <div class="header_highlight" style="height: 220px">
                    <?php if(isset($_GET["error"])): ?>
                        <div class="alert alert-warning" style="margin-top: -10px">
                            <strong>Uyari: </strong> Degerler dolu olmali.
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_GET["result"])): ?>
                        <div class="alert alert-warning" style="margin-top: -10px">
                            <strong>Uyari: </strong> Sonuc bulunamadi.
                        </div>
                    <?php endif; ?>
                    <div class="fancybox">
                        <h4 class="fancytitle" style="background-color: #3b8ed4; color: white">Rezervasyon</h4>
                        <div class="boxcontent">
                            <form action="search.php" method="POST" id="search-form">
                                Nereden: <select name="from_city">
                                    <option value="">Seciniz</option>
                                    <?php foreach(getCities() as $city): ?>
                                        <option value="<?=$city->id?>"><?=$city->name?></option>
                                    <?php endforeach; ?>
                                </select><br>
                                Nereye &nbsp; :  <select name="to_city">
                                    <option value="">Seciniz</option>
                                    <?php foreach(getCities() as $city): ?>
                                        <option value="<?=$city->id?>"><?=$city->name?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br />
                                <br />
                                Kalkış Zamanı:<input type="text" class="datepicker" name="date"><br />
                                <p class="center">
                                    <a id="send-search-form" class="center button large full" ><span>Ara</span></a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div><!-- End: Highlight-->
            </div>
        </div>
        <!--featured slider-->
    </header>
