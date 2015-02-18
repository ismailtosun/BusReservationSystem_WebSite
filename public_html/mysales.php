<?php
session_start();
include("functions.php");

if(!isLogged()){
    header("Location: login.php");
}

if(isAdmin()){
    header("Location: admin");
}
?>

<?php include("header.php"); ?>
<div class="pagemid rightsidebar">

    <!-- pagemid -->
    <div class="pagemid rightsidebar">
        <div class="topshadow">
            <div class="inner">

                <div id="mainfull">
				<font color="#000000">
                    <!-- breadcrumb -->
                    <div id="breadcrumbs">
                        <img src="images/home-icon.png" width="16" height="16" class="bread-icon">
                        <div class="breadcrumbs">
                            <a href="index.php">Ana Sayfa</a> »
							<?php if(isEmployee()): ?>
                            <a href="#">Satışlarım</a>
						<?php else: ?>
							<a href="#">Bilet Geçmişim</a>
						<?php endif; ?>
                            
                        </div>
                    </div><!-- breadcrumb -->

                    <div class="content">
                        <div class="post">
						<?php $total=0; ?>
						<?php if(isEmployee()): ?>
                            <h1>Satışlarım</h1>
						<?php else: ?>
							<h1>Bilet Geçmişim</h1>
						<?php endif; ?>
                            <div>
                                <?php if($sales = getMySales()): ?>
                                    <table class="table table-striped" cellspacing="0" rules="all" border="0" style="border-width:0px;border-collapse:collapse;">
                                        <tbody>
                                        <tr><b>
                                            <th align="left" scope="col">Rezervasyon ID</th>
                                            <th align="left" scope="col">Nereden</th>
                                            <th align="left" scope="col">Nereye</th>
                                            <th align="left" scope="col">Adı</th>
                                            <th align="left" scope="col">Soyadı</th>
                                            <th align="left" scope="col">Kalkış Zamanı</th>
                                            <th align="left" scope="col">Rezervasyon Zamanı</th>
                                            <th align="left" scope="col">Ücret</th></b>
                                        </tr>
                                        <?php foreach($sales as $s):?> 
										<?php $total+=$s->fare;?>
                                            <tr style="border-width:0px;"><b>
                                                <td><?=$s->id?></td>
                                                <td><?=$s->from_city_name?></td>
                                                <td><?=$s->to_city_name?></td>
                                                <td><?=$s->first_name?></td>
                                                <td><?=$s->last_name?></td>
                                                <td><?=$s->departure_time?></td>
                                                <td><?=$s->reservation_date?></td>
                                                <td><?=$s->fare?> YTL</td></b>
                                            </tr>
                                        <?php endforeach; ?>
										<tr style="border-width:0px;"><b>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Toplam Ücret</td>
										<td><?=$total?> YTL</td>
                                        </tbody>
                                    </table>
								<?php else: ?>
                                <p><b> Kayıt Bulunamadı.</b>
								<?php endif; ?>
</font>
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
