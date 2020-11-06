<?php
$currPage = 'front_Startseite';
include 'app/controller/PageController.php';
?>
<!-- Home Start -->
<section class="bg-half-260 d-table w-100 bg-primary" style="background: url('<?= $helper->cdnUrl(); ?>images/bg/bg1.png') top center;" id="home">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-12">
                <div class="title-heading text-center">
                    <h4 class="heading text-white mb-3">Hosting & Domain In One Plateform</h4>
                    <p class="text-white-50 para-desc mx-auto mb-0">Create, collaborate, and turn your ideas into incredible products with the definitive platform for digital design.</p>

                    <div class="mt-4">
                        <a href="javascript:void(0)" class="btn btn-primary mx-1">Get Started</a>
                        <a href="javascript:void(0)" class="btn btn-light mx-1">Learn More</a>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Home End -->

<!-- Services Start -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title mb-3">Hosting Services</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Create, collaborate, and turn your ideas into incredible products with the definitive platform for digital design.</p>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/shared.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-shared.html" class="title text-dark">Shared Hosting</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-shared.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/vps.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-vps.html" class="title text-dark">VPS Hosting</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-vps.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/dedicated.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-dedicated.html" class="title text-dark">Dedicated Hosting</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-dedicated.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/cloud.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-cloud.html" class="title text-dark">Cloud Hosting</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-cloud.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/reseller.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-reseller.html" class="title text-dark">Reseller Hosting</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-reseller.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card services p-4 rounded-pill border-0">
                    <div class="icon text-center mb-4">
                        <img src="<?= $helper->cdnUrl(); ?>images/icons/domain.svg" alt="">
                    </div>
                    <div class="card-body p-0 content">
                        <h5 class="mb-3"><a href="hosting-domain.html" class="title text-dark">Domain Name</a></h5>
                        <p class="text-muted mb-3">We provide cloud based enterprise hosting, server and storage solutions of unmatched quality.</p>
                        <a href="hosting-domain.html" class="text-primary">Read More <i data-feather="chevron-right" class="fea icon-sm"></i></a>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container-fluid mt-100 mt-60">
        <div class="rounded-pill bg-primary py-5 px-4">
            <div class="row py-md-5 py-4">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="section-title">
                                <h6 class="text-white mb-3">Powered by SSD</h6>
                                <h2 class="text-white mb-0">100% Faster Solid State Drive Server</h2>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-6 col-md-6 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                            <ul class="list-unstyled mb-0 ml-lg-5">
                                <li class="text-white-50 my-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle fea icon-ex-md text-white mr-2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>Ultrafast Data Read/Write Speeds</li>
                                <li class="text-white-50 my-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle fea icon-ex-md text-white mr-2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>Enterprise Grade Hardware</li>
                                <li class="text-white-50 my-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle fea icon-ex-md text-white mr-2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>Highest Data Protection Reliability</li>
                            </ul>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </div><!--end row-->
        </div><!--end div-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="mr-lg-5">
                    <img src="<?= $helper->cdnUrl(); ?>images/features/1.png" class="img-fluid" alt="">
                </div>
            </div><!--end col-->

            <div class="col-lg-6 col-md-6 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
                <div class="ml-lg-5">
                    <div class="media services serv-primary rounded align-items-center p-4 bg-light position-relative overflow-hidden">
                                <span class="h1 icon2 text-primary">
                                    <i class="uil uil-swatchbook"></i>
                                </span>
                        <div class="media-body content ml-3">
                            <h5>Enhance Security</h5>
                            <p class="para text-muted mb-0">There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                        <div class="big-icon">
                            <i class="uil uil-swatchbook"></i>
                        </div>
                    </div>

                    <div class="media services serv-primary rounded align-items-center p-4 bg-light mt-4 position-relative overflow-hidden">
                                <span class="h1 icon2 text-primary">
                                    <i class="uil uil-tachometer-fast-alt"></i>
                                </span>
                        <div class="media-body content ml-3">
                            <h5>High Performance</h5>
                            <p class="para text-muted mb-0">There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                        <div class="big-icon">
                            <i class="uil uil-tachometer-fast-alt"></i>
                        </div>
                    </div>

                    <div class="media services serv-primary rounded align-items-center p-4 bg-light mt-4 position-relative overflow-hidden">
                                <span class="h1 icon2 text-primary">
                                    <i class="uil uil-user-check"></i>
                                </span>
                        <div class="media-body content ml-3">
                            <h5>Unbeatable Support</h5>
                            <p class="para text-muted mb-0">There are many variations of passages of Lorem Ipsum available</p>
                        </div>
                        <div class="big-icon">
                            <i class="uil uil-user-check"></i>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
                <div class="ml-lg-5">
                    <img src="<?= $helper->cdnUrl(); ?>images/features/2.png" class="img-fluid" alt="">
                </div>
            </div><!--end col-->

            <div class="col-lg-6 col-md-6 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0 order-2 order-md-1">
                <div class="section-title mr-lg-5">
                    <h4 class="title mb-3">Quick Responce <br> and Secure Server</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Create, collaborate, and turn your ideas into incredible products with the definitive platform for digital design.</p>

                    <ul class="list-unstyled text-muted mt-3">
                        <li class="my-2"><i data-feather="check-circle" class="fea icon-ex-md text-primary mr-2"></i>Digital Marketing Solutions for Tomorrow</li>
                        <li class="my-2"><i data-feather="check-circle" class="fea icon-ex-md text-primary mr-2"></i>Our Talented & Experienced Marketing Agency</li>
                        <li class="my-2"><i data-feather="check-circle" class="fea icon-ex-md text-primary mr-2"></i>Create your own skin to match your brand</li>
                    </ul>
                    <a href="javascript:void(0)" class="mt-4 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</section><!--end section-->
<!-- Services End -->
