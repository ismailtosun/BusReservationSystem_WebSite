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
    updateAgent($_POST);
    header("Location: agents.php?updated=1");

}

if(isset($_POST["add"]) && $_POST["add"] == "1")
{
    $new_agent_name = $_POST['agent_name'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['phone'];
    $new_address = $_POST['address'];
    addAgent ($new_agent_name,$new_email,$new_phone,$new_address);
    header("Location: agents.php?added=1");

}


if(isset($_GET["a"]) && $_GET["a"] == "delete"){
    deleteAgent($_GET["id"]);
    header("Location: agents.php?deleted=1");
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
                    <strong>Başarılı!</strong> Yeni acenta Eklendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["updated"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Acenta güncellendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["deleted"])): ?>
                <div class="alert alert-info">
                    <strong>Silindi!</strong> Acenta silindi.
                </div>
            <?php endif; ?>
            <!-- Grid row -->
            <div class="row">
                <?php if(isset($_GET["a"]) && $_GET["a"] == "edit"): ?>
                    <?php
                    $id = $_GET["id"];
                    $agent = getAgent($id);
                    ?>

                    <article class="span12 data-block">

                        <div class="data-container">
                            <header>
                                <h2><span class="awe-star"></span> Acentayı Düzenle</h2>
                            </header>
                            <section>
                                <form class="form-horizontal" action="" method="POST">

                                    <fieldset>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Acenta Adı</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="agent_name" value="<?=$agent->name?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">E-Mail</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required,custom[email]]" type="text" name="email" value="<?=$agent->email?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Telefon</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="phone" value="<?=$agent->phone?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Adres</label>
                                            <div class="controls">
                                                <input id="input" class="input-xlarge validate[required]" type="text" name="address" value="<?=$agent->address?>">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button class="btn btn-alt btn-large btn-primary" type="submit">Değişiklikleri Kaydet</button>
                                        </div>

                                    </fieldset>

                                    <input type="hidden" name="edit" value="1">
                                    <input type="hidden" name="id" value="<?=$agent->id?>">

                                </form>
                            </section>
                        </div>

                    </article>
                    <!-- /Data block -->

                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "delete"): ?>
                    <?php
                    deleteAgent($_GET["id"]);
                    ?>



                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "add"): ?>
                    <?php
                ?>
                <article class="span12 data-block">

                    <div class="data-container">
                        <header>
                            <h2><span class="awe-star"></span> Yeni Acenta Ekle</h2>
                        </header>
                        <section>
                            <form class="form-horizontal" action="" method="POST">

                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Acenta Adı</label>
                                        <div class="controls">
                                            <input id="input" class="input-xlarge validate[required]" type="text" name="agent_name">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">E-Mail</label>
                                        <div class="controls">
                                            <input id="input" class="input-xlarge validate[required,custom[email]]" type="text" name="email">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Telefon</label>
                                        <div class="controls">
                                            <input id="input" class="input-xlarge validate[required]" type="text" name="phone">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Adres</label>
                                        <div class="controls">
                                            <input id="input" class="input-xlarge validate[required]" type="text" name="address">
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
                                <h2><span class="awe-star"></span> Acenta Listesi</h2>
                                <ul class="data-header-actions">
                                    <li class="active"><a href="agents.php?a=add" class="btn btn-alt btn-inverse">Yeni Acenta Ekle</a></li>
                                </ul>
                            </header>

                            <section>
                                <?php if(($agents = getAgents()) != null): ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Adı</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Adres</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach($agents as $agent): ?>
                                                <tr>

                                                    <td><?=$agent->id?></td>
                                                    <td><?=$agent->name?></td>
                                                    <td><?=$agent->email?></td>
                                                    <td><?=$agent->phone?></td>
                                                    <td><?=$agent->address?></td>

                                                    <td class="toolbar">
                                                        <div class="btn-group">
                                                            <a href="agents.php?a=edit&id=<?=$agent->id?>" class="btn btn-flat"><span class="awe-wrench"></span></a>
                                                            <a href="agents.php?a=delete&id=<?=$agent->id?>" class="btn btn-flat"><span class="awe-remove"></span></a>
                                                        </div>
                                                    </td>

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
                <?php endif; ?>
            </div>
            <!-- /Grid row -->

        </div>
        <!-- /Right (content) side -->

    </section>
    <!-- /Main page container -->

<?php include('footer.php') ?>