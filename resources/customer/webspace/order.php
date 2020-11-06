<?php
$currPage = 'front_Webspace bestellen';
$currPageDesc = 'Die besten Webspaces der ganzen stadt :P';
include 'app/controller/PageController.php';
include 'app/manager/customer/webspace/order.php';
?>
<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section bg-light">
    <div class="container">

        <div class="second-priceing-table text-center">
            <div class="row">

                <?php
                $SQL = $db->prepare("SELECT * FROM `webspace_packs`");
                $SQL->execute();
                if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="card pricing hosting-rate border-0 rounded overflow-hidden">
                            <div class="plan-name p-4 border-bottom">
                                <h4 class="title mb-3"><?php echo str_replace('_',' ', $row['plesk_id']); ?></h4>
                            </div>
                            <div class="card-body p-4">
                                <div class=" text-center">
                                    <span class="price text-primary h1 mb-0"><?= $row['price']; ?></span>
                                    <span class="h6 text-muted mb-0 mt-2">€</span>
                                    <span class="h6 text-muted align-self-end mb-1">/mo</span>
                                </div>
                                <ul class="feature-list list-unstyled mb-0">
                                    <li class="text-muted"><i class="mdi mdi-arrow-right text-primary mr-2"></i><span class="font-weight-bold"><?= $row['disc']; ?></span> GB Speicher</li>
                                    <li class="text-muted"><i class="mdi mdi-arrow-right text-primary mr-2"></i><span class="font-weight-bold"><?= $row['subdomains']; ?></span> Subdomains</li>
                                    <li class="text-muted"><i class="mdi mdi-arrow-right text-primary mr-2"></i><span class="font-weight-bold"><?= $row['databases']; ?></span> Datenbanken</li>
                                    <li class="text-muted"><i class="mdi mdi-arrow-right text-primary mr-2"></i><span class="font-weight-bold"><?= $row['ftp_accounts']; ?></span> FTP-Accounts</li>
                                    <li class="text-muted"><i class="mdi mdi-arrow-right text-primary mr-2"></i><span class="font-weight-bold"><?= $row['emails']; ?></span> E-Mails</li>
                                </ul>
                                <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
                                    <form method="post">
                                        <input hidden value="none" name="order">
                                        <input hidden value="<?= $row['plesk_id']; ?>" name="planName">
                                        <button onclick="orderNow();" id="orderBtn" type="submit" class="btn btn-primary" name="order">Kostenpflichtig bestellen</button>
                                    </form>
                                <?php } else { ?>
                                    <a href="<?= $helper->url(); ?>register" class="btn btn-primary">Account erstellen</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } } ?>

                <script>
                    function orderNow() {
                        document.getElementById("orderForm").submit();
                        const button = document.getElementById('orderBtn');
                        button.disabled = true;
                        button.innerHTML = 'Bestellung wird ausgeführt...';
                    }
                </script>

            </div>
        </div>

    </div>
</section>
