<?php
$currPage = 'back_Webspace verlängern';
include 'app/controller/PageController.php';
include 'app/manager/customer/webspace/renew.php';
?>
<section class="bg-half-170 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container" style="margin-top: -30px; margin-bottom: -60px;">
        <h1 style="color: white;"><?= $currPageName; ?></h1>
    </div>
</section>

<section class="section">
    <div class="container">
    <h3 class="text-center">Webspace verlängern</h3>
    <br>
    <div class="container col-nt-hid-pg ">
        <div class="row">

            <div class="col-md-9">
                <div class="card card-body panel-body">

                    <form method="post">

                        <label for="duration">Laufzeit</label>
                        <select id="duration" name="duration" class="form-control" style="color: black;">
                            <option value="30" data-factor="1">30 Tage</option>
                            <option value="60" data-factor="2">60 Tage</option>
                            <option value="90" data-factor="3">90 Tage</option>
                        </select>

                        <br>

                        <button type="submit" class="btn btn-primary" name="renew">Kostenpflichtig verlängern</button>

                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-body panel-body text-center">

                    Kostenübersicht
                    <h3 data-amount="">0.00€</h3>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>
<br>

<script>

    $('#slots').on('input', function() {update();});
    $("select, textarea").change(function() { update(); } ).trigger("change");

    function update(){
        var sum = "<?= $serverInfos['price']; ?>";

        var price = Number(sum * $("#duration").find("option:selected").data("factor"))
            .toLocaleString("de-DE", {minimumFractionDigits: 2, maximumFractionDigits: 2});
        $("*[data-amount]").html(price + " €");
    }

    $(document).ready(function(){
        update();
    });
</script>
