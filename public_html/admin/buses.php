<?php
session_start();
include('../functions.php');

if(!isLogged()){
    header("Location: ../login.php");
}

if(!isAdmin()){
    header("Location: ../index.php");
}


if(isset($_POST["edit"]) && $_POST["edit"] == "1"){
    updateBus($_POST);
    header("Location: buses.php?updated=1");
}

if(isset($_POST["add"]) && $_POST["add"] == "1")
{
    $new_name = $_POST['bus_name'];
    $new_seat_count = $_POST['seat_count'];
    $new_type = $_POST['type'];
    $new_plate = $_POST['plate'];

    addBus($new_name,$new_seat_count,$new_type,$new_plate);
    header("Location: buses.php?added=1");

}

if(isset($_GET["a"]) && $_GET["a"] == "delete"){
    deleteBus($_GET["id"]);
    header("Location: buses.php?deleted=1");
}

include('header.php');

?>
    <!-- Main page container -->
    <section class="container" role="main">

        <?php include('sidebar.php'); ?>
        <!-- Right (content) side -->
        <div class="content-block" role="main">
            <!-- MESSAGES -->
            <?php if(isset($_GET["added"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Yeni otobüs eklendi..
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["updated"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Otobüs güncellendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["deleted"])): ?>
                <div class="alert alert-info">
                    <strong>Silindi!</strong> Otobüs silindi.
                </div>
            <?php endif; ?>
            <!-- Grid row -->
            <div class="row">
                <?php if(isset($_GET["a"]) && $_GET["a"] == "edit"): ?>
                    <?php
                    $id = $_GET["id"];
                    $bus = getBus($id);

                    ?>
                    <article class="span12 data-block">

                        <div class="data-container">
                            <header>
                                <h2><span class="awe-star"></span> Otobüsü düzenle</h2>
                            </header>
                            <section>
                                <form class="form-horizontal" action="" method="POST">

                                    <fieldset>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Otobüs Adı</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="bus_name" value="<?=$bus->name?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">koltuk Sayısı</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required, custom[integer]]" type="text" name="seat_count" value="<?=$bus->seat_count?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Türü</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="type" value="<?=$bus->type?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Plakası</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="plate" value="<?=$bus->plate?>">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button class="btn btn-alt btn-large btn-primary" type="submit">Değişiklikleri Kaydet</button>
                                        </div>

                                    </fieldset>

                                    <input type="hidden" name="edit" value="1">
                                    <input type="hidden" name="id" value="<?=$bus->id?>">

                                </form>
                            </section>
                        </div>

                    </article>
                    <!-- /Data block -->

                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "delete"): ?>
                    <?php
                    deleteBus($_GET["id"]);
                    ?>

                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "add"): ?>
                    <?php
                    ?>
                    <article class="span12 data-block">

                        <div class="data-container">
                            <header>
                                <h2><span class="awe-star"></span> Yeni Otobüs Ekle</h2>
                            </header>
                            <section>
                                <form class="form-horizontal" action="" method="POST">

                                    <fieldset>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Otobüs Adı</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="bus_name">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Koltuk Sayısı</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required,custom[integer]]" type="text" name="seat_count">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Türü</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="type">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Plakası</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="plate">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button class="btn btn-alt btn-large btn-primary" type="submit">Ekle</button>
                                        </div>

                                    </fieldset>

                                    <input type="hidden" name="add" value="1">

                                </form>
                            </section>
                        </div>

                    </article>

                <?php else: ?>
                    <!-- Data block -->
                    <article class="span12 data-block">

                        <div class="data-container">
                            <header>
                                <h2><span class="awe-star"></span> Otobüs Listesi</h2>
                                <ul class="data-header-actions">
                                    <li class="active"><a href="buses.php?a=add" class="btn btn-alt btn-inverse">Yeni Otobüs Ekle</a></li>
                                </ul>
                            </header>

                            <section>
                                <?php if($buses = getBuses()): ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Adı</th>
                                            <th>Koltuk Sayısı</th>
                                            <th>Türü</th>
                                            <th>Plakası</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach($buses as $bus): ?>
                                            <tr>

                                                <td><?=$bus->id?></td>
                                                <td><?=$bus->name?></td>
                                                <td><?=$bus->seat_count?></td>
                                                <td><?=$bus->type?></td>
                                                <td><?=$bus->plate?></td>

                                                <td class="toolbar">
                                                    <div class="btn-group">
                                                        <a href="buses.php?a=edit&id=<?=$bus->id?>" class="btn btn-flat"><span class="awe-wrench"></span></a>
                                                        <a href="buses.php?a=delete&id=<?=$bus->id?>" class="btn btn-flat"><span class="awe-remove"></span></a>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="alert alert-info">
                                        <strong>!</strong> Kayıt bulunamadı.
                                    </div>
                                <?php endif; ?>
                            </section>
                        </div>
                    </article>
                    <!-- /Data block -->
                <?php endif; ?>
            </div>
            <!-- /Grid row -->

        </div>
        <!-- /Right (content) side -->

    </section>
    <!-- /Main page container -->

<?php include('footer.php') ?>