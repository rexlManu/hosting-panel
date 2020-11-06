<?php
$currPage = 'front_Passwort vergessen_auth';
include 'app/controller/PageController.php';
include 'app/manager/customer/auth/forgot_password.php';
?>
<div class="back-to-home rounded d-none d-sm-block">
    <a href="<?= $helper->url(); ?>" class="btn btn-icon btn-soft-primary"><i data-feather="home" class="icons"></i></a>
</div>

<section class="cover-user bg-white">
    <div class="container-fluid px-0">
        <div class="row no-gutters position-relative">
            <div class="col-lg-4 padding-less img" style="background:url('<?= $helper->cdnUrl(); ?>images/authentication.jpg') left center" data-jarallax='{"speed": 0.5}'>

            </div>

            <div class="col-lg-8 offset-lg-4 cover-my-30">
                <div class="cover-user-img d-flex align-items-center">
                    <div class="row justify-content-center m-0">
                        <div class="col-lg-7 col-md-9 col-12">
                            <div class="text-center">
                                <a href="javascript:void(0)">
                                    <img src="<?= $helper->cdnUrl(); ?>images/logo-dark.png" height="20" alt="">
                                </a>
                            </div>

                            <div class="card login-page border-0 shadow mt-4" style="z-index: 1">
                                <div class="card-body p-4">
                                    <h4 class="card-title text-center">Passwort vergessen</h4>

                                    <?php if(isset($_GET['key']) && !empty($_GET['key'])){ $key = $_GET['key']; ?>
                                        <form class="login-form mt-4" method="post">
                                            <input name="key" hidden="hidden" value="<?= $_GET['key']; ?>">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group position-relative">
                                                        <label>Neues Passwort <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" name="new_password">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group position-relative">
                                                        <label>Neues Passwort wiederholen <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" name="new_password_repeat">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-0">
                                                    <button class="btn btn-primary btn-block" name="resetPW">Passwort ändern</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } else { ?>
                                        <form class="login-form mt-4" method="post">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group position-relative">
                                                        <label>Benutzername / E-Mail <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="user_info">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mb-0">
                                                    <button class="btn btn-primary btn-block" name="requestReset">Passwort zurücksetzen</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
