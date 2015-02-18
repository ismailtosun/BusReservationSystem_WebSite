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
    updateRoute($_POST);
    header("Location: routes.php?updated=1");
}

if(isset($_POST["add"]) && $_POST["add"] == "1")
{
    $new_city_from = $_POST['from_city'];
    $new_city_to = $_POST['to_city'];
    $new_bus_id = $_POST['bus_id'];
    $new_driver_name = $_POST['driver_name'];
    $new_fare = $_POST['fare'];
    $new_departure_time = $_POST['departure_time'];

    addRoute($new_city_from ,$new_city_to, $new_bus_id, $new_driver_name , $new_fare, $new_departure_time);
    header("Location: routes.php?added=1");

}


if(isset($_GET["a"]) && $_GET["a"] == "delete"){
    deleteRoute($_GET["id"]);
    header("Location: routes.php?deleted=1");
}
include('header.php');

?>
    <!-- Main page container -->
    <section class="container" role="main">

        <?php include('sidebar.php'); ?>
        <!-- Right (content) side -->
        <div class="content-block" role="main">
            <?php if(isset($_GET["added"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Yeni rota eklendi..
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["updated"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Rota güncellendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["deleted"])): ?>
                <div class="alert alert-info">
                    <strong>Silindi!</strong> Rota silindi.
                </div>
            <?php endif; ?>
        <!-- Grid row -->
        <div class="row">
            <?php if(isset($_GET["a"]) && $_GET["a"] == "edit"): ?>
                <?php
                    $id = $_GET["id"];
                    $route = getRoute($id);

                ?>
            <article class="span12 data-block">
                <div class="data-container">
                    <header>
                        <h2><span class="awe-star"></span> Rotayı düzenle</h2>
                    </header>
                    <section>
                        <form class="form-horizontal" action="" method="POST">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="select">Buradan</label>
                                    <div class="controls">
                                        <select name="from_city" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getCities() as $city): ?>
                                                <option value="<?=$city->id?>" <?=($city->id == $route->from_city) ? "selected" : ""?> ><?=$city->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="select">Buraya</label>
                                    <div class="controls">
                                        <select name="to_city" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getCities() as $city): ?>
                                                <option value="<?=$city->id?>" <?=($city->id == $route->to_city) ? "selected" : ""?> ><?=$city->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="select">Otobüs</label>
                                    <div class="controls">
                                        <select name="bus_id" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getBuses() as $bus): ?>
                                                <option value="<?=$bus->id?>" <?=($bus->id == $route->bus_id) ? "selected" : ""?> ><?=$bus->plate?> - <?=$bus->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Şoför adı</label>
                                    <div class="controls">
                                        <input id="input" class="input-xlarge validate[required]" type="text" name="driver_name" value="<?=$route->driver_name?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Ücret</label>
                                    <div class="controls">
                                        <input id="input" class="input-xlarge validate[required]" type="text" name="fare" value="<?=$route->fare?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Kalkış Zamanı</label>
                                    <div class="controls">
                                        <div id="datetimepicker1" class="input-append date">
                                            <input class="validate[required]" data-format="yyyy-MM-dd hh:mm:ss" type="text" name="departure_time" value="<?=$route->departure_time?>">
                                            <span class="add-on">
                                              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                              </i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-alt btn-large btn-primary" type="submit">Kaydet</button>
                                </div>
                            </fieldset>
                            <input type="hidden" name="edit" value="1">
                            <input type="hidden" name="id" value="<?=$route->id?>">
                        </form>
                    </section>
                    </div>
                </article>
                <!-- /Data block -->

            <?php elseif(isset($_GET["a"]) && $_GET["a"] == "delete"): ?>
                <?php
                    deleteRoute($_GET["id"]);
                ?>


            <?php elseif(isset($_GET["a"]) && $_GET["a"] == "add"): ?>
                    <?php
            ?>
            <article class="span12 data-block">
                <div class="data-container">
                    <header>
                        <h2><span class="awe-star"></span> Yeni rota ekle</h2>
                    </header>
                    <section>
                        <form class="form-horizontal" action="" method="POST">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="select">Buradan</label>
                                    <div class="controls">
                                        <select name="from_city" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getCities() as $city): ?>
                                                <option value="<?=$city->id?>"><?=$city->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="select">Buraya</label>
                                    <div class="controls">
                                        <select name="to_city" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getCities() as $city): ?>
                                                <option value="<?=$city->id?>"><?=$city->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="select">Otobüs</label>
                                    <div class="controls">
                                        <select name="bus_id" class="validate[required]">
                                            <option value="">Seçiniz</option>
                                            <?php foreach(getBuses() as $bus): ?>
                                                <option value="<?=$bus->id?>"><?=$bus->plate?> - <?=$bus->name?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Şoför</label>
                                    <div class="controls">
                                        <input id="input" class="input-xlarge validate[required]" type="text" name="driver_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Ücret</label>
                                    <div class="controls">
                                        <input id="input" class="input-xlarge validate[required]" type="text" name="fare">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input">Kalkış Zamanı</label>
                                    <div class="controls">
                                        <div id="datetimepicker1" class="input-append date">
                                            <input data-format="yyyy-MM-dd hh:mm:ss" type="text" name="departure_time">
                                            <span class="add-on">
                                              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                              </i>
                                            </span>
                                        </div>
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
                            <h2><span class="awe-star"></span> Rota Listesi</h2>
                            <ul class="data-header-actions">
                                <li class="active"><a href="routes.php?a=add" class="btn btn-alt btn-inverse">Yeni rota ekle</a></li>
                            </ul>
                        </header>
                        <section>
                            <?php if($routes = getRoutes()): ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Buradan</th>
                                        <th>Buraya</th>
                                        <th>Şoför</th>
                                        <th>Kalkış Zamanı</th>
                                        <th>Ücret</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($routes as $route): ?>
                                        <tr>
                                            <td><?=$route->id?></td>
                                            <td><?=getCityName($route->from_city)?></td>
                                            <td><?=getCityName($route->to_city)?></td>
                                            <td><?=$route->driver_name?></td>
                                            <td><?=$route->departure_time?></td>
                                            <td><?=$route->fare?></td>
                                            <td class="toolbar">
                                                <div class="btn-group">
                                                    <a href="routes.php?a=edit&id=<?=$route->id?>" class="btn btn-flat"><span class="awe-wrench"></span></a>
                                                    <a href="routes.php?a=delete&id=<?=$route->id?>" class="btn btn-flat"><span class="awe-remove"></span></a>
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