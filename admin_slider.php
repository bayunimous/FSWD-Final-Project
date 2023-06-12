<?php
include 'config.php';
session_start();

// Cek jika pengguna telah login sebagai admin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Ganti dengan halaman login admin
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $caption = $_POST['caption'];
    $image = $_FILES['image'];

    // Cek apakah file gambar telah diunggah
    if ($image['error'] === UPLOAD_ERR_OK) {
        // Tentukan lokasi penyimpanan file gambar
        $targetDir = 'slider_images/'; // Ganti dengan lokasi penyimpanan yang sesuai
        $targetFile = $targetDir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Cek apakah file tersebut merupakan gambar
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($imageFileType, $allowedExtensions)) {
            // Pindahkan file gambar ke lokasi penyimpanan
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                // Simpan data slider ke database
                $sql = "INSERT INTO slider (image, caption) VALUES ('$image[name]', '$caption')";
                mysqli_query($conn, $sql) or die('query failed');
                $message = 'Slider added successfully!';
            } else {
                $message = 'Failed to upload image!';
            }
        } else {
            $message = 'Invalid file format! Only JPG, JPEG, and PNG files are allowed.';
        }
    } else {
        $message = 'No image selected!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Slider</title>
</head>

<body>
    <h1>Admin Slider</h1>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
        </div>
        <div>
            <label for="caption">Caption:</label>
            <input type="text" name="caption" id="caption" required>
        </div>
        <div>
            <button type="submit">Add Slider</button>
        </div>
    </form>
</body>

</html>