<?php
$currPage = 'team_Benutzerverwaltung_admin';
include 'app/controller/PageController.php';

$id = $helper->protect($_GET['id']);
$SQL = $db->prepare("SELECT * FROM `users` WHERE `id` = :id");
$SQL->execute(array(":id" => $id));
$userInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

if(isset($_POST['updateUser'])){

    $SQL = $db->prepare("UPDATE `users` SET `username` = :username, `email` = :email, `state` = :state, `role` = :role WHERE `id` = :id");
    $SQL->execute(array(":username" => $_POST['username'], ":email" => $_POST['email'], ":state" => $_POST['state'], ":role" => $_POST['role'], ":id" => $id));

    echo sendSuccess('Benutzer wurde gespeichert');
}

if(isset($_POST['changePassword'])){
    $error = null;

    if(empty($_POST['password'])){
        $error = 'Bitte gebe ein Passwort ein';
    }

    if($_POST['password'] != $_POST['password_repeat']){
        $error = 'Die Passwörter sind nicht gleich';
    }

    if(empty($error)){

        $cost = 10;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => $cost]);

        $SQL = $db->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");
        $SQL->execute(array(":password" => $password, ":id" => $id));
        echo sendSuccess('Password wurde geändert');

    } else {
        echo sendError($error);
    }
}
?>

<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="container card card-body">
                    <form method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <label>Benutzername</label>
                                <input style="color: black;" name="username" value="<?= $userInfos['username']; ?>" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>E-Mail</label>
                                <input style="color: black;" name="email" value="<?= $userInfos['email']; ?>" class="form-control">
                            </div>

                            <div class="col-md-12"> <br> </div>

                            <div class="col-md-6">
                                <label>Status</label>
                                <select style="color: black;" class="form-control" name="state">
                                    <option <?php if($userInfos['state'] == 'pending'){ echo 'selected'; } ?> value="pending">Inaktiv</option>
                                    <option <?php if($userInfos['state'] == 'active'){ echo 'selected'; } ?> value="active">Aktiv</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Rolle</label>
                                <select style="color: black;" class="form-control" name="role">
                                    <option <?php if($userInfos['role'] == 'customer'){ echo 'selected'; } ?> value="customer">Kunde</option>
                                    <option <?php if($userInfos['role'] == 'supporter'){ echo 'selected'; } ?> value="supporter">Supporter</option>
                                    <option <?php if($userInfos['role'] == 'admin'){ echo 'selected'; } ?> value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-success" type="submit" name="updateUser">Speichern</button>
                            </div>

                        </div>
                    </form>
                </div>

                <br>

                <div class="card card-body container">
                    <h4 style="margin-top: 0px;">Passwort ändern</h4>
                    <form method="post">
                        <div class="row">

                            <div class="col-md-6">
                                <label>Passwort</label>
                                <input style="color: black;" name="password" placeholder="Passwort eingeben" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Passwort wiederholen</label>
                                <input style="color: black;" name="password_repeat" placeholder="Passwort eingeben" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <br>
                                <button class="btn btn-success" type="submit" name="changePassword">Passwort ändern</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
