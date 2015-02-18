<?php
session_start();
include("functions.php");

if(!isLogged()){
    header("Location: login.php");
}

if(isAdmin()){
    header("Location: admin");
}

if(isset($_GET["route"])){
    $route = getRoute($_GET["route"]);
    if(!$route){
        header("Location: index.php");
    }

    $bus = getBus($route->bus_id);
    $seat_count = intval($bus->seat_count);
    $row_count = floor($seat_count / 4);
    $left_count = $seat_count % 4;
    $reserved_seats = getReservedSeats($route->id);

}elseif(isset($_POST["make_reservation"])){
    $result = processReservation($_POST);
    header("Location: mysales.php");
}else{
    header("Location: index.php");
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
                            <a href="index.php">Ana Sayfa</a> x"»
                            <a href="#">Sonuclar</a>
                        </div>
                    </div><!-- breadcrumb -->

                    <div class="content">
                        <div class="post">
                            <form action="reservation.php" method="POST" id="reservation-form">
                            <h1>Rezervasyon Yap</h1>

                            <table border="0" style="width:400px; float: left;">
                                <?php
                                    $number = 1;
                                    $renk=0;
                                    for($i = 0; $i < $seat_count; $i++): ?>
                                        <?=($i % 4 == 0) ? "<tr>" : "" ?>
                                            <td>
                                                <input type="radio" name="seat_number" value="<?=$i+1?>" <?=(in_array($i+1,$reserved_seats)) ? "disabled='disabled'" : ""?>>
                                                <label><?=$i+1?></label>
                                            </td>
                                        <?=($i % 4 == 3) ? "</tr>" : "" ?>
                                <?php endfor; ?>
                            </table>
                            <div style="width:400px;margin-left: 10px; float: left; border: 1px solid #E7E7E7">

                                <div id="contactform" class="sysform" style="margin: 0 auto">
                                    <h4>Yolcu Bilgileri</h4>
                                    <p>
                                        <label>Adı:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="first_name" type="text" class="input_small txt"></p>
                                    <p>
                                        <label>Soyadı:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input name="last_name" type="text" class="input_small txt"></p>
                                    <p>
                                        <label>Telefon Numarası:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input name="phone_number" type="text"  class="input_small txt"></p>
                                    <p>
                                        <label>Doğum Tarihi:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input name="birth_date" type="text" class="input_small txt datepicker"></p>
                                    <p>
                                        <label>E-Mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input name="email" type="text" class="input_small txt"></p>
                                    <p>
                                        <label>Cinsiyet:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><span id="gender"><input  type="radio" name="gender" value="0"><label>Erkek</label><input type="radio" name="gender" value="1"><label>Kadin</label></span>
                                    </p>

                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <input type="hidden" name="make_reservation" value="1">
                            <input type="hidden" name="route_id" value="<?=$_GET["route"]?>">
                            <a href="#" id="make-reservation" class="center button large full"><span>Rezervasyon Yap</span></a>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- pagemid -->
</div>
    <div class="clear"></div>


</div>

<?php include("footer.php"); ?>
