<?php
$currPage = 'team_Benutzerverwaltung_admin';
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
                <div class="card card-body">

                    <table id="my_table" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Benutzername</th>
                                <th>E-Mail</th>
                                <th>Kunde seit</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $SQL = $db -> prepare("SELECT * FROM `users` ORDER BY `id` DESC");
                        $SQL->execute();
                        if ($SQL->rowCount() != 0) {
                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){?>
                            <tr>
                                <th><?php echo $row['id']; ?></th>
                                <th><?php echo $row['username']; ?></th>
                                <th><?php echo $row['email']; ?></th>
                                <td><?php echo $row['created_at']; ?></td>
                                <td><a href="<?php echo $url; ?>team/user/<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Anschauen</a></td>
                            </tr>
                        <?php } } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
</section>
