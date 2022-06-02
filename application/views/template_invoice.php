<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
    <title><?php echo $title ?></title>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/dashboard/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/dashboard/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/dashboard/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/dashboard/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Main content -->

        <div class="d-inline-flex mb-5">
            <div class="col-md-2 mb-5">
                <div class="invoice-logo">
                    <img src="assets/telemedicine/img/iDok.png" width="120" height="auto" alt="logo">
                </div>
            </div>
            <div class="col-md-8 text-center" align="center">
                <p class="text-black">
                <h4><strong>Rumah Sakit Telemedicine</strong></h4></br>
                <h5>Menara Thamrin 12th Floor, Jl. M.H Thamrin Kav.3 Jakarta 10250</h5>
                <h5>Telp. (021) 230 2347, +6221 230 2345, Fax. 6221 230 3567, info@lintasarta.co.id</h5>
                <h5>Central Jakarta</h5>
                </p>
            </div>
            <div class="col-md-2 text-right" align="right">
                <div class="invoice-logo">
                    <img src="assets/telemedicine/img/iDok.png" width="120" height="auto" alt="logo">
                </div>
            </div>
        </div>
        <hr>
        <p align="center"><strong><?php echo $title ?></strong></p><br>
        </p>
        <div>
            <?php $this->load->view($view); ?>
        </div>
        <div>

                <style>
                    
                    .d-inline-flex {
                        display: inline-flex;
                    }
                    .mb-5 {
                        margin-bottom: 2.2rem;
                    }       
                    hr {
                        margin-top: -200px; border-bottom: 2px solid #000
                    }        
                </style>


            </div>

            <div class="sidebar-overlay" data-reff=""></div>
            <!-- <script src="assets/dashboard/js/jquery-3.2.1.min.js"></script>
    <script src="assets/dashboard/js/popper.min.js"></script>
    <script src="assets/dashboard/js/bootstrap.min.js"></script>
    <script src="assets/dashboard/js/jquery.slimscroll.js"></script>
    <script src="assets/dashboard/js/Chart.bundle.js"></script>
    <script src="assets/dashboard/js/chart.js"></script>
    <script src="assets/dashboard/js/app.js"></script>


    <script src="assets/dashboard/js/select2.min.js"></script>
    <script src="assets/dashboard/js/jquery.dataTables.min.js"></script>
    <script src="assets/dashboard/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/dashboard/js/moment.min.js"></script>
    <script src="assets/dashboard/js/bootstrap-datetimepicker.min.js"></script> -->
</body>

</html>