<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/') ?>https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>
<div class="container-fluid">

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="<?=base_url();?>admin/index">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Daftar Menu</li>
</ol>

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>Tambah Daftar Menu</div>
        <div class="mt-3">
            <form action="<?= base_url('admin/simpanmenu'); ?>" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">ID</label>
                    <input type="text" name="id_menu" class="form-control" id="exampleFormControlInput1" placeholder="id menu">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu" class="form-control" id="exampleFormControlInput1" placeholder="nama menu">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="number" name="harga_menu" class="form-control" id="exampleFormControlInput1" placeholder="harga menu">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Gambar Menu</label>
                    <<input type="file" name="gambar_menu" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kategori Menu</label>
                    <select name="kategori" class="form-control" required>
                    <option>--Pilih Kategori</option>
                        <?php
                                foreach ($allkategori as $kategori){                            
                        ?>
                        <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori'];?></option>
                        <?php
                                }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>

</div>

</div>
</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

</body>

</html>