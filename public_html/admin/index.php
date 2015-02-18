<?php
session_start();
include('../functions.php');

if(!isLogged()){
    header("Location: ../login.php");
}

if(!isAdmin()){
    header("Location: ../index.php");
}

include('header.php');
?>
<!-- Main page container -->
<section class="container" role="main">
    <?php include('sidebar.php'); ?>
    <!-- Right (content) side -->
    <div class="content-block" role="main">

    <!-- Page header -->
    <article class="page-header">
        <h1>Hoşgeldin, <?=$_SESSION["user_name"]?>!</h1>
    </article>
    <!-- /Page header -->

    <!-- Grid row -->
    <div class="row">

        <!-- Data block -->
        <article class="span12 data-block">
            <div class="data-container">
                <header>
                    <h2><span class="awe-star"></span>Son 10 Rezervasyon</h2>
                </header>

                <section>
                    <?php if(($reservations = getLatestReservations()) != null): ?>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Adı</th>
                                <th>Soyadı</th>
                                <th>Telefonu</th>
                                <th>Buradan</th>
                                <th>Buraya</th>
                                <th>Kalkıs Zamanı</th>
                                <th>Rezervasyon Zamanı</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($reservations as $r): ?>
                                <tr>

                                    <td><?=$r->id?></td>
                                    <td><?=$r->first_name?></td>
                                    <td><?=$r->last_name?></td>
                                    <td><?=$r->phone_number?></td>
                                    <td><?=$r->from_city_name?></td>
                                    <td><?=$r->to_city_name?></td>
                                    <td><?=$r->departure_time?></td>
                                    <td><?=$r->reservation_date?></td>

                                  
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <strong>!</strong> Kayıt Bulunamadı.
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </article>
        <!-- /Data block -->

    </div>
    <!-- /Grid row -->



    </div>
    <!-- /Grid row -->

    </div>
    <!-- /Right (content) side -->

</section>
<!-- /Main page container -->

<?php include('footer.php') ?>