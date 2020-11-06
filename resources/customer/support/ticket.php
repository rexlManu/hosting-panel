<?php
$currPage = 'back_Ticket Support';
include 'app/controller/PageController.php';

$ticket_id = $helper->protect($_GET['id']);
$SQL = $db->prepare("SELECT * FROM `tickets` WHERE `id` = :ticket_id");
$SQL->execute(array(":ticket_id" => $ticket_id));
$ticketInfos = $SQL -> fetch(PDO::FETCH_ASSOC);

if($userid != $ticketInfos['user_id']){
    die(header('Location: '.$helper->url().'tickets'));
}


$writer_id = $userid;

if(isset($_POST['answerTicket'])){
    if (isset($_POST['message']) && !empty($_POST['message'])) {

        $SQL = $db->prepare("INSERT INTO `ticket_message`(`ticket_id`, `writer_id`, `message`) VALUES (:ticket_id,:writer_id,:message)");
        $SQL->execute(array(":ticket_id" => $ticket_id, ":writer_id" => $writer_id, ":message" => $_POST['message']));

        $SQL = $db->prepare("UPDATE `tickets` SET `last_msg` = 'CUSTOMER' WHERE `id` = :id");
        $SQL->execute(array(":id" => $ticket_id));

        echo sendSuccess('Antwort übermittelt');
    }
}

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

            <div class="col-md-12">
                <div class="card card-body panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            Ticket-ID: #<?= $ticket_id; ?>
                        </div>
                        <div class="col-md-3">
                            Status: <?= $ticketInfos['state']; ?>
                        </div>
                        <div class="col-md-3">
                            Letzte Antwort: <?= $ticketInfos['last_msg']; ?>
                        </div>
                        <div class="col-md-4">
                            Erstellt am: #<?= $ticketInfos['created_at']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12"> <br> </div>

            <?php
            $SQL = $db -> prepare("SELECT * FROM `ticket_message` WHERE `ticket_id` = :ticket_id");
            $SQL->execute(array(":ticket_id" => $ticket_id));
            if ($SQL->rowCount() != 0) {
                while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){
                    $writer_token = $user->getDataById($row['writer_id'],'session_token');
                    if($user->isInTeam($writer_token) == true){ ?>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="card card-body panel-body">
                                <p><?= $helper->xssFix($row['message']); ?></p>
                                <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                            </div>
                        </div>
                        <div class="col-md-12"> <br> </div>
                    <?php } else { ?>
                        <div class="col-md-6">
                            <div class="card card-body panel-body">
                                <p><?= $helper->xssFix($row['message']); ?></p>
                                <small style="float: right;"><?= $user->getDataById($row['writer_id'], 'username'); ?> schrieb am <?= $row['created_at']; ?></small>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-12"> <br> </div>
                    <?php } } } ?>

            <?php if($ticketInfos['state'] == 'OPEN'){ ?>
                <div class="col-md-12">
                    <form method="post">
                        <textarea style="color: black;" rows="10" name="message" class="form-control"></textarea>
                        <br>
                        <button type="submit" name="answerTicket" class="btn btn-secondary">Antworten</button>
                        <?php if($ticketInfos['state'] == 'OPEN'){ ?>
                        <button style="float: right;" type="submit" name="closeTicket" class="btn btn-primary">Ticket schließen</button>
                        <?php } ?>
                    </form>
                </div>
            <?php } else { ?>
                <center>Dieses Ticket ist geschlossen.</center>
            <?php } ?>

        </div>
    </div>
</section>
