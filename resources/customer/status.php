<?php
$currPage = 'back_Server Status';
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
        <div class="container-fluid">
        </div>
    </div>
    <section class="priceing-section section-padding">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body panel-body">
                        <h3 class="card-title">Status</h3>

                        <div class="card-body">
                            <table id="dataTableDE" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (json_decode($uptimerobot->getMonitors())->monitors as $monitor){ ?>
                                    <tr>
                                        <td><?= $monitor->friendly_name; ?></td>
                                        <td><?php if($monitor->status == 2){ echo '<span class="badge badge-success">Online</span>'; } elseif($monitor->status == 8){ echo '<span class="badge badge-warning">Hoher Ping</span>'; } elseif($monitor->status == 9){ echo '<span class="badge badge-danger">Offline</span>'; } else { echo '<span class="badge badge-info">Unbekannt</span>'; } ?></td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</section>
