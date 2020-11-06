<?php
$currPage = 'back_Dashboard';
include 'app/controller/PageController.php';
?>
<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">

        <h3>Meine Webspaces</h3>

        <div class="row">
            <?php
            $SQL = $db->prepare("SELECT * FROM `webspace` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
            $SQL->execute(array(":user_id" => $userid));
            if ($SQL->rowCount() != 0) {
            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

            if($row['state'] == 'active'){
                $state = 'Aktiv';
            } elseif($row['state'] == 'deleted'){
                $state = 'Gelöscht';
            }
            ?>
            <div class="col-md-5">
                <div class="card card-body text-center">
                    <h3 style="margin-top: 30px;">Webspace #<?= $row['id']; ?></h3>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6">
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
                                    <span class="ml-2"><?= $row['domainName']; ?></span>
                                </p>
                                <p class="text-muted mb-2 font-13">
                                    <span class="ml-2"><?= $row['ftp_name']; ?></span>
                                </p>
                                <p class="text-muted mb-2 font-13">
                                    <span class="ml-2"><?= number_format($row['price'], 2); ?>€ /monat</span>
                                </p>
                                <p class="text-muted mb-2 font-13">
                                    <span class="ml-2"><?= $helper->formatDate($row['expire_at']); ?></span>
                                </p>
                            </div>
                        </div>

                        <ul class="social-list list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a href="<?= $helper->url(); ?>webspace/manage/<?= $row['id']; ?>" class="social-list-item border-primary text-primary"> <i class="far fa-edit"></i> </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?= $helper->url(); ?>webspace/renew/<?= $row['id']; ?>" class="social-list-item border-danger text-danger"> <i class="far fa-calendar-alt"></i> </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <?php } } ?>

        </div>

        <br>

        <h3>Meine Bots</h3>
        <div class="row">

            <?php
            $SQL = $db->prepare("SELECT * FROM `bots` WHERE `user_id` = :user_id AND `deleted_at` IS NULL");
            $SQL->execute(array(":user_id" => $userid));
            if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                if($row['state'] == 'active'){
                    $state = 'Aktiv';
                } elseif($row['state'] == 'deleted'){
                    $state = 'Gelöscht';
                }
                ?>
                <div class="col-md-5">
                    <div class="card card-body text-center">
                        <h3 style="margin-top: 30px;">TS3AudioBot #<?= $row['id']; ?></h3>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted mb-2 font-13">
                                        <strong>Name:</strong>
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
                                        <span class="ml-2"><?= $row['bot_name']; ?></span>
                                    </p>
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= number_format($row['price'], 2); ?>€ /monat</span>
                                    </p>
                                    <p class="text-muted mb-2 font-13">
                                        <span class="ml-2"><?= $helper->formatDate($row['expire_at']); ?></span>
                                    </p>
                                </div>
                            </div>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="<?= $helper->url(); ?>bot/manage/<?= $row['id']; ?>" class="social-list-item border-primary text-primary"> <i class="far fa-edit"></i> </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <?php } } ?>
        </div>
    </div>
</section>
