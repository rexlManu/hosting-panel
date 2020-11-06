<?php
$currPage = 'front_TS3AudioBot bestellen';
$currPageDesc = 'Die besten Bots der ganzen stadt :P';
include 'app/controller/PageController.php';
include 'app/manager/customer/bot/order.php';
?>
<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="second-priceing-table text-center">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-body panel-body">
                        <div class="card-body">
                            <form method="post">

                                <label>Bot Name:</label>
                                <input name="name" placeholder="Mein Bot" class="form-control" style="color: black;">

                                <br>

                                <label>Bot Node:</label>
                                <select class="form-control" name="node" required="required" style="color: black;">
                                    <?php
                                    $SQL = $db -> prepare("SELECT * FROM `bot_nodes` WHERE `state` = 'active'");
                                    $SQL->execute();
                                    if ($SQL->rowCount() != 0) {
                                        while ($row = $SQL -> fetch(PDO::FETCH_ASSOC)){ ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                        <?php } } ?>
                                </select>

                                <br>

                                <input hidden value="none" name="createBot">
                                <button onclick="orderNow();" id="orderBtn" type="submit" class="btn btn-primary" name="createBot">Kostenpflichtig bestellen</button>

                            </form>
                        </div>
                    </div>
                </div>

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
