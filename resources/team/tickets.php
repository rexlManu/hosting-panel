<?php
$currPage = 'team_Tickets';
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
                <div class="panel panel-default container">

                    <table id="my_table" class="table table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Status</th>
                            <th scope="col">Letzte Antwort</th>
                            <th scope="col">Datum</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $SQL = $db -> prepare("SELECT * FROM `tickets` ORDER BY `id`");
                        $SQL->execute(array(":user_id" => $_SESSION['id']));
                        if ($SQL->rowCount() != 0) {
                            while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){

                                if($row['state'] == 'OPEN'){
                                    $status = '<span class="badge badge-soft-success">Offen</span>';
                                } elseif($row['state'] == 'CLOSED'){
                                    $status = '<span class="badge badge-soft-danger">Geschlossen</span>';
                                }

                                if($row['last_msg'] == 'CUSTOMER'){
                                    $last_msg = '<span class="badge badge-soft-secondary">Kundenantwort</span>';
                                } elseif($row['last_msg'] == 'SUPPORT'){
                                    $last_msg = '<span class="badge badge-soft-info">Supportantwort</span>';
                                }

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <th scope="row"><?= $helper->xssFix($row['title']); ?></th>
                                    <th scope="row"><?php echo $status; ?></th>
                                    <th scope="row"><?php echo $last_msg; ?></th>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><a href="<?php echo $url; ?>team/ticket/<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Anschauen</a></td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
</section>
