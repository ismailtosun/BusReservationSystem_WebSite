<?php
session_start();
include("functions.php");

if(!isLogged()){
    header("Location: login.php");
}

if(isAdmin()){
    header("Location: admin");
}

if(check_search_params()){
    $result = search_route($_POST);
    $r = $result[0];
    if(!$result){
        header("Location: index.php?result=0");
    }
}else{
    header("Location: index.php?error=1");
}
?>

<?php include("header.php"); ?>
<div class="pagemid rightsidebar">

    <!-- pagemid -->
    <div class="pagemid rightsidebar">
        <div class="topshadow">
            <div class="inner">

                <div id="mainfull">

                    <!-- breadcrumb -->
                    <div id="breadcrumbs">
                        <img src="images/home-icon.png" width="16" height="16" class="bread-icon">
                        <div class="breadcrumbs">
                            <a href="index.php">Ana Sayfa</a> »
                            <a href="#">Sonuçlar</a>
                        </div>
                    </div><!-- breadcrumb -->

                    <div class="content">
                        <div class="post">
                            <h1>Sonuçlar: <?=$r->from_city_name?> - <?=$r->to_city_name?></h1>
                            <div>
                                <table class="table table-striped" cellspacing="0" rules="all" border="0" id="ctl00_ContentPlaceHolder1_RouteGrid" style="border-width:0px;border-collapse:collapse;">
                                    <tbody>
                                    <tr>
                                        <th align="left" scope="col">Kalkış Zamani</th>
                                        <th align="left" scope="col">Ücret</th>
                                        <th align="left" scope="col">&nbsp;</th>
                                    </tr>
                                    <?php foreach($result as $r): ?>
                                    <tr style="border-width:0px;">
                                        <td><?=$r->departure_time?></td>
                                        <td><?=$r->fare?></td>
                                        <td><a href="reservation.php?route=<?=$r->id?>">Rezervasyon Yap</a></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- pagemid -->

    <div class="clear"></div>


</div>

<?php include("footer.php"); ?>
