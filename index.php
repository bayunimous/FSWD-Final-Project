<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
   header('location:login.php');
}
if (isset($_POST['add_to_cart'])) {
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }
}

// Get filter values
$filter_product_name = $_GET['product_name'] ?? '';
$filter_product_type = $_GET['product_type'] ?? '';
$filter_min_price = $_GET['min_price'] ?? '';
$filter_max_price = $_GET['max_price'] ?? '';

// Build SQL query based on filters
$sql = "SELECT * FROM `products` WHERE 1=1";
if (!empty($filter_product_name)) {
   $sql .= " AND name LIKE '%$filter_product_name%'";
}
if (!empty($filter_product_type)) {
   $sql .= " AND type = '$filter_product_type'";
}
if (!empty($filter_min_price)) {
   $sql .= " AND price >= '$filter_min_price'";
}
if (!empty($filter_max_price)) {
   $sql .= " AND price <= '$filter_max_price'";
}
$sql .= " LIMIT 6";

$select_products = mysqli_query($conn, $sql) or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .filter-form {
         margin-bottom: 20px;
      }

      .filter-form input,
      .filter-form select {
         margin-right: 10px;
      }
   </style>
</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home">
      <div class="content">
         <h3>Furniture Terbaik Dari Bahan Pilihan.</h3>
         <p>Belanja Furniture murah? disini tempatnya</p>
         <a href="about.php" class="white-btn">Temukan Barang</a>
      </div>
   </section>

   <section class="products">
      <h1 class="title">Produk Terbaru</h1>

      <div class="filter-form">
         <form action="" method="get">
            <input type="text" name="product_name" placeholder="Nama Produk" value="<?php echo $filter_product_name; ?>">
            <select name="product_type">
               <option value="">Jenis Produk</option>
               <option value="type1" <?php if ($filter_product_type == 'type1') echo 'selected'; ?>>Type 1</option>
               <option value="type2" <?php if ($filter_product_type == 'type2') echo 'selected'; ?>>Type 2</option>
               <option value="type3" <?php if ($filter_product_type == 'type3') echo 'selected'; ?>>Type 3</option>
            </select>
            <input type="number" name="min_price" placeholder="Harga Minimum" value="<?php echo $filter_min_price; ?>">
            <input type="number" name="max_price" placeholder="Harga Maksimum" value="<?php echo $filter_max_price; ?>">
            <input type="submit" value="Filter">
         </form>
      </div>

      <div class="box-container">
         <?php
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="post" class="box">
                  <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <?php if (isset($fetch_products['stok'])) { ?>
                     <div class="stok">
                        <h3>Stok Total : Sisa <?php echo $fetch_products['stok']; ?></h3>
                     </div>
                  <?php } ?>
                  <div class="price">Rp.<?php echo $fetch_products['price']; ?>/-</div>
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="add to cart" name="add_to_cart" class="btn">
               </form>

         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">Lihat Lebih Banyak</a>
      </div>

   </section>

   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="images/about-img.jpg" alt="">
         </div>
         <div class="content">
            <h3>Tentang Kami</h3>
            <p>Selamat datang di Galaxy Furniture, tujuan utama kami adalah memberikan solusi furnitur yang berkualitas tinggi untuk mempercantik dan meningkatkan ruang hidup Anda. Sebagai penyedia furnitur terkemuka, kami menawarkan berbagai pilihan desain yang elegan dan fungsional untuk memenuhi gaya dan kebutuhan individu Anda. Dengan menggunakan bahan-bahan terbaik dan menggabungkannya dengan keahlian pengrajin kami yang berpengalaman.</p>
            <a href="about.php" class="btn">Baca Lebih Banyak</a>
         </div>
      </div>
   </section>

   <section class="home-contact">
      <div class="content">
         <h3>Kamu Punya Pertanyaan?</h3>
         <p>Silahkan hubungi bayunugraha.bjm@gmail.com</p>
         <a href="contact.php" class="white-btn">Hubungi Kami</a>
      </div>
   </section>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>