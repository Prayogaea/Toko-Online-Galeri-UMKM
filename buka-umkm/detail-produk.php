<?php
    error_reporting(0);
    include'db.php';

    // $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin 
    //                        WHERE admin_id = 1 ");
    
    // $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
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
                <h1><a href="index.php">Galeri UMKM</a></h1>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="produk.php">Produk</a></li>
                </ul>
            </div>
        </header>

        <!-- search -->
        <div class="search">
            <div class="container">
                <form action="produk.php">
                    <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                    <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                    <input type="submit" name="cari" value="Cari">
                </form>
            </div>
        </div>


        <!-- detail produk -->
        <div class="section">
            <div class="container">
                <h3>Detail Produk</h3>
                <div class="box">
                    <div class="col-2">
                        <img src="produk/<?php echo $p->product_image ?>" width="75%">
                    </div>
                    <div class="col-2">
                        <h3><?php echo $p->product_name ?></h3>
                        <h4>Rp.<?php echo number_format($p->product_price) ?></h4>
                        <p>Deskripsi: <br>
                            <?php echo $p->product_description ?>
                        </p>
                        <p><a id="wa" href="https://api.whatsapp.com/send?phone=+6282244533455&text=Saya tertarik..!" target="_blank">Whatsapp</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- footer -->
        <div class="footer">
            <div class="container">
            <h4>Alamat</h4>
                <p>Malang Jawa timur Indonesia</p>

                <h4>Email</h4>
                <p><a href="mailto:galeriUMKM@gmail.com">galeriUMKM@gmail.com</a></p>

                <h4>Telepon</h4>
                <p><a href="tel:+6282244533455">+6282244533455</a></p>
                <small>Copyright &copy; 2021 - Galeri UMKM</small>

                <!-- <h4>Alamat</h4>
                <p><?php// echo $a->admin_address ?></p>

                <h4>Email</h4>
                <p><?php// echo $a->admin_email?></p>

                <h4>Telepon</h4>
                <p><?php// echo $a->admin_telp ?></p>
                <small>Copyright &copy; 2021 - Galeri UMKM</small> -->
            </div>
        </div>

    </body>
</html>