<?php

    include "db.php";
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Galeri UMKM</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    </head>
    <body>
        <!-- header -->
        <header>
            <div class="container">
                <h1><a href="dashboard.php">Galeri UMKM</a></h1>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-kategori.php">Data Kategori</a></li>
                    <li><a href="data-produk.php">Data Produk</a></li>
                    <li><a href="keluar.php">Keluar</a></li>
                </ul>
            </div>
        </header>

        <!-- content -->
        <div class="section">
            <div class="container">
                <h3>Data Produk</h3>
                <div class="box">
                    <p><a class="btn" href="tambah-produk.php">Tambah Data</a></p><br>
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                                if(mysqli_num_rows($produk) > 0){ 
                                while($row = mysqli_fetch_array($produk)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td>Rp.<?php echo number_format($row['product_price']) ?></td>
                                <td><?php echo $row['product_description'] ?></td>
                                <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                                <td><?php echo ($row['product_status'] == 0)? 'Tidak aktif':'Aktif'; ?></td>
                                <td>
                                    <a class="btn-edit" href="edit-produk.php?id=<?php echo $row['product_id']?>">Edit</a>
                                    <a onclick="return confirm('Yakin ingin di hapus')" class="btn-hapus" href="proses-hapus.php?idp=<?php echo $row['product_id']?>">Hapus</a>
                                </td>
                            </tr>
                            <?php } } ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2021 - Galeri UMKM</small>
            </div>
        </footer>

        <!-- data table -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    "aLengthMenu" : [[5,10,25,50,100,-1],[5,10,25,50,100,"All"]],
                    "iDisplayLength" : 5
                });
            } );
        </script>

    </body>
</html>