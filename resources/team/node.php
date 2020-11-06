<?php
$currPage = 'back_Nodeverwaltung_team_admin';
include 'app/controller/PageController.php';

$id = $helper->protect($_GET['id']);

if(isset($_POST['updateNode'])){
    $SQL = $db->prepare("UPDATE `bot_nodes` SET `name`=? ,`node_ip`=?,`unique_id`=?,`token`=?,`port`=?,`state`=?,`limit`=? WHERE `id` = ?");
    $SQL->execute(array($_POST['name'], $_POST['node_ip'], $_POST['unique_id'], $_POST['token'], $_POST['port'], $_POST['state'], $_POST['limit'], $id));

    echo sendSuccess('Die Node wurde bearbeitet');
}

$SQL = $db->prepare("SELECT * FROM `bot_nodes` WHERE `id` = :id");
$SQL->execute(array(":id" => $id));
$node_data = $SQL->fetch(PDO::FETCH_ASSOC);

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
                            <div class="card card-body container">
                                <div class="card-body">
                                    <form method="post">

                                        <label>Status:</label>
                                        <select style="color: black;" class="form-control" name="state">
                                            <option <?php if($node_data['state'] == 'active'){ echo 'selected'; } ?> value="active">Aktiv</option>
                                            <option <?php if($node_data['state'] == 'disabled'){ echo 'selected'; } ?> value="disabled">Deaktiviert</option>
                                        </select>
                                        <br>

                                        <label>Name:</label>
                                        <input style="color: black;" class="form-control" name="name" value="<?= $node_data['name']; ?>" required="required">
                                        <br>

                                        <label>Node IP:</label>
                                        <input style="color: black;" class="form-control" name="node_ip" value="<?= $node_data['node_ip']; ?>" required="required">
                                        <br>

                                        <label>Teamspeak Unique ID:</label>
                                        <input style="color: black;" class="form-control" name="unique_id" value="<?= $node_data['unique_id']; ?>" required="required">
                                        <br>

                                        <label>API Token:</label>
                                        <input style="color: black;" class="form-control" name="token" value="<?= $node_data['token']; ?>" required="required">
                                        <br>

                                        <label>API Port:</label>
                                        <input style="color: black;" class="form-control" name="port" value="<?= $node_data['port']; ?>" required="required">
                                        <br>

                                        <label>Bot Limit:</label>
                                        <input style="color: black;" class="form-control" name="limit" value="<?= $node_data['limit']; ?>" required="required">
                                        <br>

                                        <button type="submit" name="updateNode" class="btn btn-primary btn btn-block">Speichern</button>
                                        <br>

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
