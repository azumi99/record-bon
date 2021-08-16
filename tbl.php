<?php
require 'function.php';
require 'cek.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tutup Bon Langsung | UDAYA </title>
    <link rel="shortcut icon" href="assets/img/head/logo-udaya.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img style="width: 200px; margin-left:-15px; margin-top:6px;" src="assets/img/head/udayaforheader.PNG" alt=""> </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <?php
                        $tampilannama = $_SESSION{
                            'nama'};
                        $tampilangambar = $_SESSION{
                            'image'};
                        ?>
                        <div>
                            <h3 class="sb-sidenav-menu-heading" style="margin-left: 15px;">Welcome <?= $tampilannama; ?></h3>
                            <div style="width: 80px; border-radius:50%; height:80px; margin-left:50px; background: url('<?= "assets/img/user/$tampilangambar"; ?>') center center; background-size:80px; background-repeat:no-repeat;"></div>
                        </div>

                        <br />
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="kb.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Kas Bon
                        </a>
                        <a class="nav-link" href="tb.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Tutup Bon
                        </a>
                        <a class="nav-link" href="tbl.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Tutup Bon Langsung
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Tutup Bon Langsung</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tblmodal">
                                Tambah TBL
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Company</th>
                                            <th>Nominal</th>
                                            <th>Transfer to</th>
                                            <th>Status Terima</th>
                                            <th>Status Transfer</th>
                                            <th>Bukti Transfer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function Rupiah($angka)
                                        {
                                            $hasil = "Rp " . number_format($angka, 2, ',', '.');
                                            return $hasil;
                                        }
                                        $tampilantbl = mysqli_query($conn, "select * from tbl left join login on tbl.id_login=login.id_login left join company on tbl.id_company=company.id_company");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($tampilantbl)) {
                                            $idtbl = $data['id_tbl'];
                                            $idlogin = $data['id_login'];
                                            $idcompany = $data['id_company'];
                                            $tanggal = $data['tanggal_tbl'];
                                            $nama = $data['nama'];
                                            $deskripsi = $data['deskripsi_tbl'];
                                            $company = $data['company_name'];
                                            $nominal = $data['nominal_tbl'];
                                            $transfer = $data['transfer_tbl'];
                                            $status_terima = $data['status_trmtbl'];
                                            $status_transfer = $data['status_trftbl'];
                                            $gambar = $data['bukti_tftbl'];
                                            if ($gambar == null) {
                                                $img = 'tidak ada lampiran';
                                            } else {
                                                $img = '<img style="width:50px;" src="finance/assets/bukti_tftbl/' . $gambar . '" >';
                                            }

                                        ?>
                                            <tr>
                                                <td><?= $idtbl; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $nama; ?></td>
                                                <td><?= $deskripsi; ?></td>
                                                <td><?= $company ?></td>
                                                <td><?= Rupiah($nominal); ?></td>
                                                <td><?= $transfer; ?></td>
                                                <td><?= $status_terima; ?></td>
                                                <td><?= $status_transfer; ?></td>
                                                <td><?= $img; ?></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#updatetbl<?= $idtbl; ?>">update</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetbl<?= $idtbl; ?>">delete</button>
                                                </td>
                                            </tr>

                                            <!-- update modal tbl -->
                                            <div class="modal fade" id="updatetbl<?= $idtbl; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update TBL</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <select name="companyupdatetbl" class="form-control">
                                                                    <option selected value="<?= $idcompany; ?>"><?= $company; ?></option>
                                                                    <?php
                                                                    $tampilancompanytbl = mysqli_query($conn, "select * from company");
                                                                    while ($fetcharray = mysqli_fetch_array($tampilancompanytbl)) {
                                                                        $companyname = $fetcharray['company_name'];
                                                                        $id_companynya = $fetcharray['id_company'];
                                                                    ?>
                                                                        <option value="<?= $id_companynya; ?>"><?= $companyname; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br />
                                                                <input type="number" name="nominalupdatetbl" value="<?= $nominal; ?>" class="form-control" required>
                                                                <br />
                                                                <input type="text" name="transfertoupdatetbl" value="<?= $transfer; ?>" class="form-control" required>
                                                                <br />
                                                                <textarea type="text" class="form-control" name="deskripsiupdatetbl" rows="3" required><?= $deskripsi; ?></textarea>
                                                                <input type="hidden" name="idtbl" value="<?= $idtbl; ?>">
                                                                <br />
                                                                <button type="submit" name="updatetbl" class="btn btn-warning">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- update modal tbl -->

                                            <!-- delete modal tb -->
                                            <div class="modal fade" id="deletetbl<?= $idtbl; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus TBL</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <textarea type="text" class="form-control" name="deskripsi" rows="3" placeholder="<?= $deskripsi; ?>"></textarea>
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda ingin menghapus TBL ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="idtbl" value="<?= $idtbl; ?>">
                                                                <button type="submit" name="modaldeletetbl" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal tb -->

                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; IT Support Palem | 2021</div>
                        <div>
                            <a>Develop by</a>
                            <a style="text-decoration:none;" href="https://www.anandanesia.com/" target="_blank">Ilham Tegar</a>
                            &middot;
                            <a style="text-decoration:none;" href="#">Admathir</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- Modal -->
<div class="modal fade" id="tblmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah TBL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <?php
                    $tampilannama = $_SESSION{
                        'nama'};
                    $idloginnya = $_SESSION{
                        'id_login'};
                    ?>
                    <select name="namatbl" class="form-control">
                        <option value="<?= $idloginnya; ?>" selected><?= $tampilannama; ?></option>
                    </select>
                    <br />
                    <select name="companytbl" class="form-control">
                        <option selected>pilih company</option>
                        <?php
                        $tampilancompany = mysqli_query($conn, "select * from company");
                        while ($fetcharray = mysqli_fetch_array($tampilancompany)) {
                            $company = $fetcharray['company_name'];
                            $id_companynya = $fetcharray['id_company'];
                        ?>
                            <option value="<?= $id_companynya; ?>"><?= $company; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <input type="number" name="nominaltbl" placeholder="nominal" class="form-control" required>
                    <br />
                    <input type="text" name="transfertotbl" placeholder="transfer to" class="form-control" required>
                    <br />
                    <textarea type="text" class="form-control" name="deskripsitbl" rows="3" placeholder="deskripsi" required></textarea>
                    <br />
                    <button type="submit" name="savetbl" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>