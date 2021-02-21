<?php
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
                <h1><a href="">Galeri UMKM</a></h1>
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
                <h3>Dashboard</h3>
                <div class="box">
                    <h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Galeri UMKM</h4>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2021 - Galeri UMKM</small>
            </div>
        </footer>

    </body>
</html>