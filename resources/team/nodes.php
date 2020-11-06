<?php
$currPage = 'back_Nodeverwaltung_team_admin';
include 'app/controller/PageController.php';

if(isset($_POST['createNode'])){
    $SQL = $db->prepare("INSERT INTO `bot_nodes`(`name`, `node_ip`, `unique_id`, `token`, `port`, `state`, `limit`) VALUES (?,?,?,?,?,?,?)");
    $SQL->execute(array($_POST['name'], $_POST['node_ip'], $_POST['unique_id'], $_POST['token'], $_POST['port'], 'active', $_POST['limit']));

    echo sendSuccess('Die Node wurde angelegt');
}

?>
<form method="post">
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Neue Node erstellen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label>Name:</label>
                    <input class="form-control" name="name" required="required">
                    <br>

                    <label>Node IP:</label>
                    <input class="form-control" name="node_ip" required="required">
                    <br>

                    <label>Teamspeak Unique ID:</label>
                    <input class="form-control" name="unique_id" required="required">
                    <br>

                    <label>API Token:</label>
                    <input class="form-control" name="token" required="required">
                    <br>

                    <label>API Port:</label>
                    <input class="form-control" name="port" value="58913" required="required">
                    <br>

                    <label>Bot Limit:</label>
                    <input class="form-control" name="limit" value="100" required="required">
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary" name="createNode">Node erstellen</button>
                </div>
            </div>
        </div>
    </div>
</form>


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

                    <br><br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Neue Node anlegen</button>
                    <br><br>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card card-body">
                                <div class="card-body">

                                    <table id="dataTableDE" class="table table-nowrap">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Node IP</th>
                                            <th scope="col">Bot Limit</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Erstellt am</th>
                                            <th scope="col">Aktive Bots</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $SQL = $db -> prepare("SELECT * FROM `bot_nodes`");
                                        $SQL->execute();
                                        if ($SQL->rowCount() != 0) {
                                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                                <tr>
                                                    <td><?= $row['id']; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= $row['node_ip']; ?></td>
                                                    <td><?= $row['limit']; ?></td>
                                                    <td><?= $row['state']; ?></td>
                                                    <td><?= $site->formatDate($row['created_at']); ?></td>
                                                    <td><?= $node->getBotCountFromNode($row['id']); ?></td>
                                                    <td><a href="<?= $helper->url(); ?>team/node/<?= $row['id']; ?>" class="btn btn-primary btn-sm">Bearbeiten</a></td>
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
