<?php

include 'config.php';

session_start();

$user_id = null; // Inisialisasi variabel $user_id

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Tentang Kami</h3>
      <p> <a href="index.php">Beranda</a> / Tentang Kami </p>
   </div>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/about-img.jpg" alt="">
         </div>

         <div class="content">
            <h3>Kenapa Harus Kami?</h3>
            <p>Galaxy Furniture penjualan terbaik dan berkualitas, anda dijamin puas jika berbelanja disini</p>
            <p>Since 2022</p>
            <a href="contact.php" class="btn">Hubungi Kami</a>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="title">Review Pembeli</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Barang sesuai dengan gambar, pengiriman cepat dan kualitas bagus</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-o"></i>
            </div>
            <h3>Chelvin Glen</h3>
         </div>

         <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Dengan Harga segitu saya kira kualitas nya biasa aja tapi kenyataan nya di luar ekpetasi</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <h3>Tina</h3>
         </div>

         <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Pengiriman nya cepat hari kamis saya pesan minggu datang</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <h3>Riyadh Zoldyk</h3>
         </div>

         <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Admin Toko Ramah dan pengirimannya cepat </p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Fuan</h3>
         </div>

         <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Lumayan Lah dengan harga segitu</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-o"></i>
            </div>
            <h3>Amat</h3>
         </div>

         <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Mantap</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Udin</h3>
         </div>

      </div>

   </section>


   <!--
<?php include 'footer.php'; ?>
-- >
<!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>