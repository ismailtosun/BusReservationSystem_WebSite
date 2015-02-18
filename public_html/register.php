<?php
session_start();
include("functions.php");

if(isset($_GET["logout"]) && $_GET["logout"] == "1"){
    $_SESSION["logged_in"] = false;
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_name"]);
}

if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){
    header("Location: index.php");
}

if($_POST["username"] != "" && $_POST["password"] != "" && $_POST["email"] != ""){
	$username =$_POST["username"];
	$password =$_POST["password"];
	$email = $_POST["email"];
    $result = addUser($username,$password,$email);
    if($result == 1){
        header("Location: mysales.php");
    }elseif($result == 2)
        header("Location: admin/index.php");
    else{
        header("Location: login.php?error=1");
    }
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
                            <a href="login.php">Giriş Yap</a>
							<a href="#">Üye ol</a>
                        </div>
                    </div><!-- breadcrumb -->

                    <div class="content">
                        <div class="post">
                            <form action="" method="POST">
                                <table cellspacing="0" cellpadding="1" border="0" style="border-collapse:collapse;">
                                    <tbody><tr>
                                        <td><table cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td align="center" colspan="2">Kaydol</td>
                                                </tr><tr>
                                                    <td align="right"><label >Kullanıcı Adı:</label></td><td><input name="username" type="text" ></td>
                                                </tr><tr>
                                                    <td align="right"><label>Şifre:</label></td><td><input name="password" type="password"></td>
                                                </tr><tr>
                                                    <td align="right"><label>E-mail:</label></td><td><input name="email" type="text"></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" colspan="2"><input type="submit" name="submit" value="Kayıt Ol" ></td>
                                                </tr>
                                                </tbody></table></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
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
