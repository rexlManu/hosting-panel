<?php
$currPage = 'back_Botverwaltung_team_admin';
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
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Bots</h3>
                                </div>
                                <div class="card card-body container">
                                    <table id="dataTableDE" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Benutzername</th>
                                            <th>Botname</th>
                                            <th>Status</th>
                                            <th>Erstellt am</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $SQL = $db->prepare("SELECT * FROM `bots` WHERE `deleted_At` IS NULL ORDER BY `id` DESC");
                                        $SQL->execute();
                                        if ($SQL->rowCount() != 0) {
                                            while ($row = $SQL->fetch(PDO::FETCH_ASSOC)){

                                                if(is_null($row['bot_id'])){
                                                    $state = 'Offline';
                                                } else {
                                                    $state = 'Online';
                                                }

                                                ?>
                                                <tr>
                                                    <td><?= $row['id']; ?></td>
                                                    <td><?= $user->getDataById($row['user_id'],'username'); ?></td>
                                                    <td><?= $helper->protect($row['bot_name']); ?></td>
                                                    <td><?= $state ?></td>
                                                    <td><?= $helper->formatDate($row['created_at']); ?></td>
                                                    <td> <a href="<?= $helper->url(); ?>team/bot/<?= $row['id']; ?>"><button class="btn btn-primary btn-sm">Verwalten</button></a> </td>
                                                </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
