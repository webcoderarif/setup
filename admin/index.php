<?php require_once "inc/header.php"; ?>
<?php require_once "inc/sidebar.php"; ?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="margin-top: 64px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><?= isset($register_job_total) ? $register_job_total : '0'; ?></h1>
                                <h5 class="text-white">REGISTER JOB</h5>
                            </div>
                            <a href="manage_job.php" class="text-center p-1 text-white" style="background: #198bbe;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><?= isset($free_trial_total) ? $free_trial_total : '0'; ?></h1>
                                <h5 class="text-white">FREE TRIAL</h5>
                            </div>
                            <a href="free_trial_job.php" class="text-center p-1 text-white" style="background: #1f8d5d;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><?= isset($free_quote_total) ? $free_quote_total : '0'; ?></h1>
                                <h5 class="text-white">FREE QUOTE</h5>
                            </div>
                            <a href="free_quote_job.php" class="text-center p-1 text-white" style="background: #ffa415;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><?= isset($quick_query_total) ? $quick_query_total : '0'; ?></h1>
                                <h5 class="text-white">QUICK QUERY</h5>
                            </div>
                            <a href="quick_query.php" class="text-center p-1 text-white" style="background: #b54120;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><?= isset($contact_mail_total) ? $contact_mail_total : '0'; ?></h1>
                                <h5 class="text-white">CONTACT MAIL</h5>
                            </div>
                            <a href="contact_mail.php" class="text-center p-1 text-white" style="background: #b54120;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div id="clock_hou" class="my-2"></div>
                              </div>
                              <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div id="clock_india" class="my-2"></div>
                              </div>
                              <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div id="clock_korea" class="my-2"></div>
                              </div>
                              <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div id="clock_uk" class="my-2"></div>
                              </div>
                              <div class="col-md-12 col-sm-6 col-xs-12">
                                    <div id="clock_tokyo" class="my-2"></div>
                              </div>
                        </div>
                    </div>
                </div>  
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
<?php require_once "inc/footer.php"; ?>