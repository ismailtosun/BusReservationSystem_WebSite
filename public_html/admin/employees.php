<?php
session_start();
include('../functions.php');

if(!isLogged()){
    header("Location: ../login.php");
}

if(!isAdmin()){
    header("Location: ../index.php");
}


if(isset($_POST["edit"]) && $_POST["edit"] == "1")
{
    updateEmployee($_POST);
    $updated_user_id=$_POST['user_id'];
    $updated_user_name=$_POST['user_name'];
    $updated_password=$_POST['password'];
    $updated_email=$_POST['email'];
    $updated_user_level=$_POST['user_level'];
    updateUser($updated_user_id,$updated_user_name,$updated_password,$updated_email,$updated_user_level);
    header("location: employees.php?updated=1");

}

if(isset($_POST["add"]) && $_POST["add"] == "1")
{
    $new_agent_id = $_POST['agent_id'];
    $new_first_name = $_POST['first_name'];
    $new_last_name = $_POST['last_name'];
    $new_email = $_POST['email'];
    $new_phone_number = $_POST['phone_number'];
    $new_gender = $_POST['gender'];

    $new_user_id = $_POST['user_id'];
    $new_user_name = $_POST['user_name'];
    $new_password = $_POST['password'];

    $user_id = addUser ($new_user_name,$new_password,$new_email);
    addEmployee ($new_agent_id,$new_first_name,$new_last_name,$new_email,$new_phone_number,$new_gender,$user_id);
    header("location: employees.php?added=1");
}


if(isset($_GET["a"]) && $_GET["a"] == "delete"){
    $id = $_GET["id"];
    $employee = getEmployee($id);
    $user_id= $employee->user_id;
    deleteUser ($user_id);
    deleteEmployee($_GET["id"]);
    header("location: employees.php?deleted=1");

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
                    <strong>Başarılı!</strong> Yeni çalışan eklendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["updated"])): ?>
                <div class="alert alert-success">
                    <strong>Başarılı!</strong> Çalışan bilgileri güncellendi.
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["deleted"])): ?>
                <div class="alert alert-info">
                    <strong>Silindi!</strong> Çalışan silindi.
                </div>
            <?php endif; ?>
            <!-- Grid row -->
            <div class="row">
                <?php if(isset($_GET["a"]) && $_GET["a"] == "edit"): ?>
                    <?php
                    $id = $_GET["id"];
                    $employee = getEmployee($id);

                    $user_id=$employee->user_id;
                    $user=getUser($user_id);

                    ?>
                    <article class="span12 data-block">

                        <div class="data-container">
                            <header>
                                <h2><span class="awe-star"></span> Çalışan Bilgilerini Düzenle</h2>
                            </header>
                            <section>
                                <form class="form-horizontal" action="" method="POST">

                                    <fieldset>

                                        <div class="control-group">
                                            <label class="control-label" for="select">Acenta</label>
                                            <div class="controls" class="validate[required]">
                                                <select name="agent_id" class="validate[required]">
                                                    <option value="">Seçiniz</option>
                                                    <?php foreach(getAgents() as $agent): ?>
                                                        <option value="<?=$agent->id?>" <?=($employee->agent_id == $agent->id) ? "selected" : ""?>><?=$agent->name?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Adı</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="text" name="first_name" value="<?=$employee->first_name?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Soyadı</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="text" name="last_name" value="<?=$employee->last_name?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Email</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required, custom[email]]" type="text" name="email" value="<?=$employee->email?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Telefon Numarası</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="text" name="phone_number" value="<?=$employee->phone_number?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Cinsiyet</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="radio" name="gender" value="0" <?=($employee->gender=="0") ? "checked" : ""?>> Erkek
                                                <input class="input-xlarge validate[required]" type="radio" name="gender" value="1" <?=($employee->gender=="1") ? "checked" : ""?>> Kadın
                                            </div>
                                        </div>

                                        <p>&nbsp;</p>

                                        <header>
                                            <h2><span class="awe-star"></span> Çalışan bilgilerini düzenle</h2>
                                        </header>

                                        <div class="control-group">
                                            <label class="control-label" for="input">Kullanıcı Adı</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="text" name="user_name" value="<?=$user->user_name?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="input">Şifre</label>
                                            <div class="controls">
                                                <input class="input-xlarge validate[required]" type="text" name="password" value="<?=$user->password?>">
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button class="btn btn-alt btn-large btn-primary" type="submit">Değişikleri Kaydet</button>
                                        </div>

                                    </fieldset>

                                    <input type="hidden" name="edit" value="1">
                                    <input type="hidden" name="user_id" value="<?=$employee->user_id?>">
                                    <input type="hidden" name="id" value="<?=$employee->id?>">

                                </form>
                            </section>
                        </div>

                    </article>
                    <!-- /Data block -->

                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "delete"): ?>
                    <?php

                    $id = $_GET["id"];
                    $employee = getEmployee($id);
                    $user_id= $employee->user_id;
                    deleteUser ($user_id);
                    deleteEmployee($_GET["id"]);

                    ?>

                <?php elseif(isset($_GET["a"]) && $_GET["a"] == "add"): ?>
                    <?php
                ?>
                <article class="span12 data-block">

                    <div class="data-container">
                        <header>
                            <h2><span class="awe-star"></span> Yeni Çalışan Ekle</h2>
                        </header>
                        <section>
                            <form class="form-horizontal" action="" method="POST">

                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label" for="select">Acenta</label>
                                        <div class="controls">
                                            <select name="agent_id" class="validate[required]">
                                                <option value="">Seçiniz</option>
                                                <?php foreach(getAgents() as $agent): ?>
                                                    <option value="<?=$agent->id?>"><?=$agent->name?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Adı</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="first_name">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Soyadı</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="last_name">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Email</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required,custom[email]]" type="text" name="email">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Telefon Numarası</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="phone_number">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Cinsiyet</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="radio" name="gender" value="0"> Erkek
                                            <input class="input-xlarge validate[required]" type="radio" name="gender" value="1"> Kadın
                                        </div>
                                    </div>

                                    <p>&nbsp;</p>

                                    <header>
                                        <h2><span class="awe-star"></span> Calışanın kullanıcı bilgileri</h2>
                                    </header>

                                    <div class="control-group">
                                        <label class="control-label" for="input">Kullanıcı Adı</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="user_name">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="input">Şifre</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="password">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="input">Kullanıcı Düzeyi</label>
                                        <div class="controls">
                                            <input class="input-xlarge validate[required]" type="text" name="user_level">
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
                                <h2><span class="awe-star"></span> Çalışan Listesi</h2>
                                <ul class="data-header-actions">
                                    <li class="active"><a href="employees.php?a=add" class="btn btn-alt btn-inverse">Yeni Çalışan Ekle</a></li>
                                </ul>
                            </header>

                            <section>
                                <?php if($employees = getEmployees()): ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Acenta ID</th>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                            <th>Email</th>
                                            <th>Telefon Numarası</th>
                                            <th>Cinsiyet</th>
                                            <th>Kullanıcı ID</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach($employees as $employee): ?>
                                            <tr>

                                                <td><?=$employee->id?></td>
                                                <td><?=$employee->agent_id?></td>
                                                <td><?=$employee->first_name?></td>
                                                <td><?=$employee->last_name?></td>
                                                <td><?=$employee->email?></td>
                                                <td><?=$employee->phone_number?></td>
                                                <td><?=$employee->gender?></td>
                                                <td><?=$employee->user_id?></td>

                                                <td class="toolbar">
                                                    <div class="btn-group">
                                                        <a href="employees.php?a=edit&id=<?=$employee->id?>" class="btn btn-flat"><span class="awe-wrench"></span></a>
                                                        <a href="employees.php?a=delete&id=<?=$employee->id?>" class="btn btn-flat"><span class="awe-remove"></span></a>
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