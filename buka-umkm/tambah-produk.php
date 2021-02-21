<?php

    include 'db.php';
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
                <h3>Tambah Data Produk</h3>

                <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select name="kategori" class="input-control" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){ 
                            ?>
                            <option value="<?php $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                        <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                        <input type="file" name="gambar" class="input-control btn" required>
                        <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea><br>
                        <select class="input-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1">Aktif</option>
                            <option value="0"> Tidak Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){

                            // print_r($_FILES['gambar']);

                            //inputan dari form
                            $kategori    = $_POST['kategori'];
                            $nama        = $_POST['nama'];
                            $harga       = $_POST['harga'];
                            $deskripsi   = $_POST['deskripsi'];
                            $status      = $_POST['status'];

                            //file upload
                            $filename = $_FILES['gambar']['name'];
                            $tmp_name = $_FILES['gambar']['tmp_name'];

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'produk'.time().'.'.$type2;

                            //format file yang di izinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

                            //validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                //jika format file tidak di izinkan
                                echo'<script>alert("Format file tidak di izinkan!")</script>';
                            }else{
                                //jika format file di izinkan
                                move_uploaded_file($tmp_name, './produk/'.$newname);
                            }

                            //proses upload file dan insert data ke database
                            $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                                    null,
                                                    '".$kategori."',
                                                    '".$nama."',
                                                    '".$harga."',
                                                    '".$deskripsi."',
                                                    '".$newname."',
                                                    '".$status."',
                                                    null
                                                    ) ");

                                if($insert){
                                    echo'<script>alert("Tambah data berhasil")</script>';
                                    echo'<script>window.location="data-produk.php"</script>';
                                }else{
                                    echo'gagal'.mysqli_error($conn);
                                }
                        }
                    ?>
                </div>
                <a href="data-produk.php">&larr; Kembali</a>
            </div>
        </div>

        <!-- footer -->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2021 - Galeri UMKM</small>
            </div>
        </footer>

        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'deskripsi' );
        </script>
    </body>
</html>