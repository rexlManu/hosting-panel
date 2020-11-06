<?php
$currPage = 'back_Mein Profil';
include 'app/controller/PageController.php';

if(isset($_POST['checkCode'])){
    $error = null;

    if($user->checkVoucher($_POST['code']) == false){
        $error = 'Dieser Code existiert nicht';
    }

    if(empty($_POST['code'])){
        $error = 'Bitte gebe einen Code an';
    }

    if(empty($error)){
        $user->useVoucher($_POST['code'], $userid);
        echo sendSuccess('Gutschein wurde eingelöst');
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
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="card card-body panel-body">

                                <h3 class="card-title">Mein Profil</h3>

                                <div class="card-body">
                                    <label>Benutzername</label>
                                    <input style="color: black;" value="<?= $username; ?>" readonly class="form-control">
                                    <br>
                                    <label>E-Mail</label>
                                    <input style="color: black;" value="<?= $mail; ?>" readonly class="form-control">
                                    <br>
                                    <label>Kundennummer</label>
                                    <input style="color: black;" value="KD-<?= $userid; ?>" readonly class="form-control">
                                    <br>
                                    <label>Support-Pin</label>
                                    <input style="color: black;" value="<?= $support_pin; ?>" readonly class="form-control">
                                    <br>
                                    <label>Bot Limit</label>
                                    <input style="color: black;" value="<?= $bot_slots; ?>" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card card-body panel-body">

                                <h3 class="card-title">Gutschein einlösen</h3>

                                <div class="card-body">
                                    <form method="post">
                                        <input style="color: black;" name="code" placeholder="XXX-XXX-XXX-XXX" class="form-control">
                                        <br>
                                        <button type="submit" name="checkCode" class="btn btn-primary btn-block">Gutschein einlösen</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
