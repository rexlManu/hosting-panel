<?php
$currPage = 'front_Register_auth';
include 'app/controller/PageController.php';
include 'app/manager/customer/auth/register.php';
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
                                    <h4 class="card-title text-center">Login</h4>
                                    <form class="login-form mt-4" method="post">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Dein Benutzername <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Benutzername" name="username">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Deine E-Mail <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" placeholder="E-Mail" name="email">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Passwort <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label>Passwort wiederholen <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" placeholder="Password wiederholen" name="password_repeat">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label" for="customCheck1">Login merken</label>
                                                        </div>
                                                    </div>
                                                    <p class="forgot-pass mb-0"><a href="<?= $helper->url(); ?>passwort_reset" class="text-dark font-weight-bold">Passwort vergessen?</a></p>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-0">
                                                <button class="btn btn-primary btn-block" name="register">Account erstellen</button>
                                            </div>

                                            <div class="col-12 text-center">
                                                <p class="mb-0 mt-3"><small class="text-dark mr-2">Doch schon einen Account?</small> <a href="<?= $helper->url(); ?>login" class="text-dark font-weight-bold">Einloggen</a></p>
                                            </div>
                                        </div>
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
