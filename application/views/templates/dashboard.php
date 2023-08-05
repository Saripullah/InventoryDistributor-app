<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title; ?> | CV.VICTORY ABADI</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/fonts.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">

    <!-- Load CSS file for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- load jQuery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--  load JS for Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <style>
        #accordionSidebar,
        .topbar {
            z-index: 1;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view('templates/sidebar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-primary topbar mb-4 static-top shadow-sm">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link bg-transparent d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small text-capitalize">
                                    <?= userdata('nama'); ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/avatar/<?= userdata('foto'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/setting'); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/ubahpassword'); ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <?= $contents; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Datepicker -->
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="<?= base_url(); ?>assets/vendor/gijgo/js/gijgo.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });
    </script>

    <script type="text/javascript">
        $(function() {

            $('.date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });


            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#tanggal').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
                    'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
            }, cb);

            cb(start, end);

            $('.date2').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
            });
        });

        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                <?php if ($this->uri->segment(1) == 'barang' || $this->uri->segment(1) == 'barangmasuk') { ?>
                    ordering: false,
                <?php } ?>

                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columnDefs: [
                    <?php if ($this->uri->segment(1) == 'barang' || $this->uri->segment(1) == 'barangmasuk') { ?> {
                            targets: [0],
                            className: "d-none",
                        },
                    <?php } ?> {
                        targets: -1,
                        orderable: false,
                        
                    }
                ]
            });

            table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
        });
    </script>
    <script type="text/javascript">
        let hal = '<?= $this->uri->segment(1); ?>';
        let id_barang_masuk = $('#id_barang_masuk');
        let satuan = $('#satuan');
        let stok = $('#stok');
        let total = $('#total_stok');
        let jumlah = hal == 'barangmasuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');

        $(document).on('change', '#barang_id', function() {
            let url = '<?= base_url('barang/getstok/'); ?>' + this.value;
            $.getJSON(url, function(data) {
                console.log(data);
                id_barang_masuk.val(data.id_barang_masuk);
                satuan.html(data.nama_satuan);
                <?php if ($this->uri->segment(1) == 'barangmasuk') : ?>
                    stok.val(data.stok_barang_masuk);
                <?php endif; ?>
                <?php if ($this->uri->segment(1) == 'barangkeluar') : ?>
                    stok.val(data.stok_barang_keluar);
                <?php endif; ?>
                jumlah.focus();
            });
        });

        // $(document).on('keyup', '#jumlah_masuk', function() {
        //     let totalStok = parseInt(stok.val()) + parseInt(this.value);
        //     stok.val(Number(totalStok));
        // });

        // $(document).on('keyup', '#jumlah_keluar', function() {
        //     stok.val(stok.val() - this.value);
        // });
    </script>

    <!-- Detail Barang di Penjualan -->
    <?php if ($this->uri->segment(1) == 'penjualan') : ?>
        <script type="text/javascript">
            $(document).on('change', '#id_barang', function() {
                let url = '<?= base_url('barang/getdetailbarang/'); ?>' + this.value;
                $.getJSON(url, function(data) {
                    let cards = showDetailBarang(data);
                    $('.detail-barang').html(cards);
                    $('#satuan').val(data.nama_satuan);
                    $('#harga').val(data.harga);
                    $('#param_stok').val(data.stok);
                    $('#id_satuan').val(data.id_satuan);
                    $('.btn-quantity').prop('disabled', false)
                })
            })

            function showDetailBarang(data) {
                return `<div class="row form-group">
                            <label class="col-md-3 text-md-right" for=""></label>
                            <div class="col-md-9">
                                <div class="border rounded p-3">
                                    <p class="border-bottom pb-2 font-weight-bold">Detail Barang :</p>
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <th width="25%">Nama Barang</th>
                                            <th width="5px">:</th>
                                            <td>${data.nama_barang}</td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Harga</th>
                                            <th width="5px">:</th>
                                            <td>${data.harga}</td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Stok</th>
                                            <th width="5px">:</th>
                                            <td>${data.stok}</td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Satuan</th>
                                            <th width="5px">:</th>
                                            <td>${data.nama_satuan}</td>
                                        </tr>
                                        <tr>
                                            <th width="25%">Jenis</th>
                                            <th width="5px">:</th>
                                            <td>${data.nama_jenis}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>`;
            }
        </script>
    <?php endif; ?>
    <!-- End Detail Barang di Penjualan -->

    <?php if ($this->uri->segment(1) == 'dashboard') : ?>
        <!-- Chart -->
        <script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

        <script type="text/javascript">
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                            label: "Total Barang Masuk",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "#5a5c69",
                            pointHoverBorderColor: "#5a5c69",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?= json_encode($cbm); ?>,
                        },
                        {
                            label: "Total Barang Keluar",
                            lineTension: 0.3,
                            backgroundColor: "rgba(231, 74, 59, 0.05)",
                            borderColor: "#e74a3b",
                            pointRadius: 3,
                            pointBackgroundColor: "#e74a3b",
                            pointBorderColor: "#e74a3b",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "#5a5c69",
                            pointHoverBorderColor: "#5a5c69",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: <?= json_encode($cbk); ?>,
                        }
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: 5
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Barang Masuk", "Barang Keluar"],
                    datasets: [{
                        data: [<?= $barang_masuk; ?>, <?= $barang_keluar; ?>],
                        backgroundColor: ['#4e73df', '#e74a3b'],
                        hoverBackgroundColor: ['#5a5c69', '#5a5c69'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });

            const table = document.getElementsByName('tableBarangMasuk');
            let lastElementChild = null;

            for (let row of table.tbody) {
                const fourthCell = row.cells[4];

                if (lastElementChild === null || fourthCell.innerText !== lastElementChild.innerText) {
                    lastElementChild = fourthCell;
                } else {
                    lastElementChild.rowSpan++;
                    fourthCell.remove();
                }
            }
        </script>
    <?php endif; ?>
</body>

</html>