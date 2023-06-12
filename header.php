<?php
if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id']; // Mengatur ID pengguna ke dalam variabel sesi
} else {
   $user_id = null;
}
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="https://web.facebook.com/404NotFoundAccountx" class="fab fa-facebook-f"></a>
            <a href="https://www.twitter.com/" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/bayu.ngrhaa" class="fab fa-instagram"></a>
            <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
         </div>
         <?php
         if (!isset($user_id)) {
            echo '<p> <a href="login.php">Masuk</a> | <a href="register.php">Daftar</a> </p>';
         } else {
            echo '<p>Selamat datang, ' . $_SESSION['user_name'] . '! | <a href="logout.php">Logout</a> </p>';
         }
         ?>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="index.php" class="logo">Galaxy Furniture</a>

         <nav class="navbar">
            <a href="index.php">Beranda</a>
            <a href="about.php">Tentang Kami</a>
            <a href="shop.php">Produk</a>
            <a href="contact.php">Kontak</a>
            <a href="orders.php">Pesanan</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            if (isset($user_id)) {
               $select_cart_number = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number);
               echo '<a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(' . $cart_rows_number . ')</span> </a>';
            }
            ?>
         </div>

         <?php
         if (isset($user_id)) {
            echo '
            <div class="user-box">
               <p>username : <span>' . $_SESSION['user_name'] . '</span></p>
               <p>email : <span>' . $_SESSION['user_email'] . '</span></p>
            </div>
            ';
         }
         ?>
      </div>
   </div>
</header>