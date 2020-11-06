<?php
$currPage = 'back_TS3AudioBot';
include 'app/controller/PageController.php';
include 'app/manager/customer/bot/manage.php';
?>

<form method="post">
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Neuen Link hinzufügen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label>Name:</label>
                    <input name="name" placeholder="Cooles Youtube Video" class="form-control">

                    <br>

                    <label>Link:</label>
                    <input name="url" placeholder="https://www.youtube.com/watch?v=WmpQKJbozQ8" class="form-control">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary" name="addUrl">Link hinzufügen</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="content-wrapper">
    <section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
        <div class="bg-overlay"></div>
        <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
            <h1 style="color: white;"><?= $currPageName; ?></h1>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="content">
                <div class="container-fluid row">

                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card card-body panel-body text-center">
                                <?= $current_song; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card shadow mb-4">
                            <div class="card card-body panel-body">

                                <form method="post" id="form">
                                    <label>Teamspeak IP</label>
                                    <input style="color: black;" class="form-control" name="server_addr" placeholder="public.teamspeak.com:9987" value="<?= $helper->xssFix($data['server_addr']); ?>">
                                    <br>
                                    <label>Botname</label>
                                    <input style="color: black;" <?php if(empty($data['bot_id'])){ echo 'disabled'; } ?> class="form-control" name="bot_name" placeholder="TS3AudioBot" value="<?= $helper->xssFix($data['bot_name']); ?>">
                                    <br>
                                    <label>Standard Channel</label>
                                    <input style="color: black;" class="form-control" name="default_channel" value="<?= $helper->xssFix($data['default_channel']); ?>">
                                    <br>
                                    <label>Channel Passwort</label>
                                    <input style="color: black;" class="form-control" name="channel_password" value="<?= $helper->xssFix($data['channel_password']); ?>">
                                    <br>
                                    <label>Bot Host Informationen</label>
                                    <input style="color: black;" class="form-control" disabled value="<?= $node->getData($data['node_id'],'name'); ?> (Node-ID: <?= $data['node_id']; ?>)">
                                    <br>
                                    <button class="btn btn-primary" name="updateServerData" type="submit">Speichern</button>
                                </form>

                                <form method="post">
                                    <?php if($auto_repeat == 0){ ?>
                                        <button class="btn btn-success btn-block" name="autoPlay" type="submit">AutoRepeat aktivieren</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary btn-block" name="autoPlay" type="submit">AutoRepeat deaktivieren</button>
                                    <?php } ?>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-7">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card card-body panel-body">
                                                <form method="post" id="form">
                                                    <?php if(empty($data['bot_id'])){ ?>
                                                        <button type="submit" name="startBot" class="btn btn-success btn-block">Starten</button>
                                                        <button type="button" disabled class="btn btn-danger btn-block">Stoppen</button>
                                                    <?php } else { ?>
                                                        <button type="button" disabled class="btn btn-success btn-block">Starten</button>
                                                        <button type="submit" name="stopBot" class="btn btn-danger btn-block">Stoppen</button>
                                                        <button type="submit" name="stopStream" class="btn btn-primary btn-block">Aktuellen Stream stoppen</button>
                                                    <?php } ?>
                                                    <button type="submit" name="deleteBot" class="btn btn-danger btn-block">Bot löschen</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card shadow mb-4">
                                            <div class="card card-body panel-body">
                                                <h4 class="text-center">Channel Commander</h4>

                                                <form method="post">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-success btn-block" name="activateCommander" type="submit">Aktivieren</button>
                                                        </div>
                                                        <div class="col-md-12" style="margin-top: 5px;">
                                                            <button class="btn btn-danger btn-block" name="deaktivateCommander" type="submit">Deaktiviere</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card card-body panel-body">

                                        <form method="post" id="form">
                                            <label>Stream oder Youtube Url</label>
                                            <input style="color: black;" class="form-control" name="stream_url" value="<?= $helper->xssFix($data['last_stream']); ?>" placeholder="https://www.youtube.com/watch?v=IL7t8BY2hS0">
                                            <br>
                                            <?php if(empty($data['bot_id'])){ ?>
                                                <button type="button" disabled class="btn btn-success btn-block">Abspielen</button>
                                            <?php } else { ?>
                                                <button type="submit" name="playNow" class="btn btn-success btn-block">Abspielen</button>
                                            <?php } ?>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card card-body panel-body">

                                        <form method="post" id="volume_change">
                                            <div class="form-group">
                                                <label for="formControlRange">Lautstärke <span id="volume_percent"><?= $volume; ?>%</span></label>
                                                <input type="range" value="<?= $volume; ?>" class="form-control-range" name="volume" id="formControlRange" onchange="updateSlider(this.value);">
                                            </div>
                                        </form>

                                        <script>
                                            function updateSlider(slideAmount) {
                                                $('#formControlRange').val(slideAmount);
                                                $('#volume_percent').html(slideAmount + '%');
                                                $("#volume_change").submit();
                                            }
                                        </script>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <div class="card card-body panel-body">

                                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#exampleModal">Neuen Link hinzufügen</button>

                                        <br>

                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTableDE" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Url</th>
                                                    <th>Play</th>
                                                    <th>Löschen</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Url</th>
                                                    <th>Play</th>
                                                    <th>Löschen</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                $SQL = $db->prepare("SELECT * FROM `stream_links` WHERE `user_id` = :user_id ORDER BY `id` DESC");
                                                $SQL->execute(array(":user_id" => $user->getDataBySession($_COOKIE['session_token'],'id')));
                                                if($SQL->rowCount() != 0) {
                                                    while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <tr>
                                                            <td><?= $helper->xssFix($row['name']); ?></td>
                                                            <td><?= $helper->xssFix($row['url']); ?></td>
                                                            <td>
                                                                <form method="post" id="playForm<?= $row['id']; ?>"> <input hidden value="<?= $row['id']; ?>" name="stream_url"> <i style="cursor: pointer;" onclick="document.getElementById('playForm<?= $row[id] ?>').submit();" class="fas fa-play"></i> </form>
                                                            </td>
                                                            <td>
                                                                <form method="post" id="delForm<?= $row['id']; ?>"> <input hidden value="<?= $row['id']; ?>" name="del_stream_id"> <i style="cursor: pointer;" onclick="document.getElementById('delForm<?= $row[id] ?>').submit();" class="fas fa-trash-alt"></i> </form>
                                                            </td>
                                                        </tr>
                                                    <?php } } ?>
                                                <?php
                                                $SQL = $db->prepare("SELECT * FROM `stream_links` WHERE `user_id` IS NULL ORDER BY `id` DESC");
                                                $SQL->execute();
                                                if($SQL->rowCount() != 0) {
                                                    while ($row = $SQL->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <tr>
                                                            <td><?= $helper->xssFix($row['name']); ?></td>
                                                            <td><?= $helper->xssFix($row['url']); ?></td>
                                                            <td>
                                                                <form method="post" id="playForm<?= $row['id']; ?>"> <input hidden value="<?= $row['id']; ?>" name="stream_url"> <i style="cursor: pointer;" onclick="document.getElementById('playForm<?= $row[id] ?>').submit();" class="fas fa-play"></i> </form>
                                                            </td>
                                                            <td>
                                                                <form method="post" id="delForm<?= $row['id']; ?>"> <input hidden value="<?= $row['id']; ?>" name="del_stream_id"> <i style="cursor: pointer;" onclick="document.getElementById('delForm<?= $row[id] ?>').submit();" class="fas fa-trash-alt"></i> </form>
                                                            </td>
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

        </div>
    </section>
</div>
