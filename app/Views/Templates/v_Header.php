<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <link rel="shortcut icon" type="text/css" href="<?= base_url('public') ?>/img/rudal_1.png">


    <!-- Custom fonts for this template-->
    <link href="<?= base_url('public') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('public') ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <!-- dataTables Buttons -->
    <link rel="stylesheet" href="<?= base_url('public') ?>/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url('public') ?>/css/buttons.bootstrap4.css" rel="stylesheet" type="text/css">

    <style type="text/css">
        .card {
            width: 0 auto;
            /* Kartu menggunakan lebar penuh */
            max-width: 0 auto;
            /* Atur lebar maksimal jika perlu */
            margin: 0 auto;
            /* Agar card terpusat */
        }

        #container {
            width: 100% !important;
            /* Chart mengikuti lebar penuh card */
            height: 400px;
            /* Atur tinggi chart sesuai kebutuhan */
        }

        .highcharts-figure {
            width: 100%;
            /* Agar chart menggunakan lebar penuh figure */
            margin: 0;
        }

        .highcharts-data-table table {
            min-width: 310px;
            width: 100%;
            /* Chart memanfaatkan lebar penuh */
        }
    </style>

</head>

<body id="page-top">
    <script src="<?= base_url('public/vendor/Highcharts-12.1.2/') ?>code/highcharts.js"></script>
    <script src="<?= base_url('public/vendor/Highcharts-12.1.2/') ?>code/modules/data.js"></script>
    <script src="<?= base_url('public/vendor/Highcharts-12.1.2/') ?>code/modules/exporting.js"></script>
    <script src="<?= base_url('public/vendor/Highcharts-12.1.2/') ?>code/modules/accessibility.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">