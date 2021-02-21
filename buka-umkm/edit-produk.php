<?php

    include 'db.php';
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
        echo'<script>window.location="data-produk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);

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
                <h3>Edit Data Produk</h3>

                <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select name="kategori" class="input-control" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){ 
                            ?>
                            <option value="<?php $r['category_id'] ?>" <?php echo($r['category_id'] == $p->category_id)? 'selected':'' ?>><?php echo $r['category_name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required value="<?php echo $p->product_name ?>">
                        <input type="text" name="harga" class="input-control" placeholder="Harga" required  value="<?php echo $p->product_price  ?>">
                                 
                        <img src="produk/<?php echo $p->product_image ?>" width="25%">
                        <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                        <input type="file" name="gambar" class="input-control btn">
                        <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"><?php echo $p->product_description  ?></textarea><br>
                        <select class="input-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo ($p->product_status == 1)? 'selected':'' ?> >Aktif</option>
                            <option value="0" <?php echo ($p->product_status == 0)? 'selected':'' ?> >Tidak Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){

                            //data inputan form
                            $kategori    = $_POST['kategori'];
                            $nama        = $_POST['nama'];
                            $harga       = $_POST['harga'];
                            $deskripsi   = $_POST['deskripsi'];
                            $foto        = $_POST['foto'];

                            //data gambar baru
                            $filename = $_FILES['gambar']['name'];
                            $tmp_name = $_FILES['gambar']['tmp_name'];

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];

                            $newname = 'produk'.time().'.'.$type2;

                            //format file yang di izinkan
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'pdf');

                            //damin ganti gambar
                            if($filename != ''){

                                if(!in_array($type2, $tipe_diizinkan)){
                                    //jika format file tidak di izinkan
                                    echo'<script>alert("Format file tidak di izinkan!")</script>';
                                }else{

                                    unlink('./produk/'.$foto);

                                    //jika format file di izinkan
                                    move_uploaded_file($tmp_name, './produk/'.$newname);

                                    $namagambar = $newname;
                                }

                            }else{

                                //jika gambar tidak di ganti
                                $namagambar = $foto;

                            }

                            //query update data produk
                            $update = mysqli_query($conn, "UPDATE tb_product SET
                                                category_id = '".$kategori."',
                                                product_name = '".$nama."',  
                                                product_price = '".$harga."', 
                                                product_description = '".$deskripsi."', 
                                                product_image = '".$namagambar."', 
                                                product_status = '".$status."' 
                                                WHERE product_id = '".$p->product_id."' ");

                            if($update){
                                echo'<script>alert("Edit data berhasil")</script>';
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