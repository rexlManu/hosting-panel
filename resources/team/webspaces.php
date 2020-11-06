<?php
$currPage = 'team_Alle Kunden Webspaces';
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
        <br>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-body container">

                    <table id="my_table" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Domain</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ablaufdatum</th>
                                <th scope="col">Bestellt am</th>
                                <th scope="col">Preis</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $SQL = $db->prepare("SELECT * FROM `webspace` WHERE `deleted_at` IS NULL");
                        $SQL->execute();
                        if ($SQL->rowCount() != 0) {while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                            <tr>
                                <td scope="row"><?= $row['id']; ?></td>
                                <td scope="row"><?= $row['domainName']; ?></td>
                                <td scope="row"><?= $row['state']; ?></td>
                                <td scope="row"><?= $row['expire_at']; ?></td>
                                <td><?= $row['created_at']; ?></td>
                                <td><?= $row['price']; ?>€</td>
                            </tr>
                        <?php } } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
</section>
