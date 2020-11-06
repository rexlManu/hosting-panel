<?php
$currPage = 'back_Webspace';
include 'app/controller/PageController.php';
include 'app/manager/customer/webspace/manage.php';
?>
<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <div class="card card-body panel-body text-center">

                    <h4 class="mb-0">Webspace #<?= $serverInfos['id']; ?></h4>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted mb-2 font-13">
                                <strong>Status:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Domain:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>FTP User:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Preis:</strong>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <strong>Laufzeit:</strong>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $state; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['domainName']; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['ftp_name']; ?></span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $serverInfos['price']; ?>€</span>
                            </p>
                            <p class="text-muted mb-2 font-13">
                                <span class="ml-2"><?= $helper->formatDate($serverInfos['expire_at']); ?></span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-7">
                <div class="card card-body panel-body text-center">
                    <h4 class="mb-0">Logindaten</h4>
                    <br>

                    <div class="row">

                        <div class="col-md-6">
                            <label for="username">Benutzername</label>
                            <input style="color: black;" class="form-control" id="username" disabled value="<?= $user->getDataBySession($_COOKIE['session_token'],'username'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Passwort</label>
                            <input style="color: black;" class="form-control" disabled value="<?= $user->getDataBySession($_COOKIE['session_token'],'plesk_password'); ?>">
                        </div>

                        <div class="col-md-12">
                            <br>
                            <a target="_blank" class="btn btn-block btn-primary" href="https://vweb01.deinwebspacehost.de:8443">Zum Login</a>
                            <br>
                            <a class="btn btn-block btn-success" href="<?= $helper->url(); ?>webspace/renew/<?= $id; ?>">Verlängern</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
