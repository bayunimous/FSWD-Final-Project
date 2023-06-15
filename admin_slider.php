<!-- admin_slider.php -->

<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

$message = '';

// Process form submission
if (isset($_POST['submit'])) {
    $image = $_FILES['image']['name'];
    $caption = $_POST['caption'];

    $targetDirectory = 'images/Slider/';
    $targetFile = $targetDirectory . basename($image);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedExtensions = array('jpg', 'jpeg', 'png');

    if (in_array($imageFileType, $allowedExtensions)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $insertQuery = "INSERT INTO slider (image, caption) VALUES ('$image', '$caption')";
            $result = mysqli_query($conn, $insertQuery);

            if ($result) {
                $message = 'Slider image uploaded successfully.';
            } else {
                $message = 'Error uploading slider image.';
            }
        } else {
            $message = 'Error uploading slider image.';
        }
    } else {
        $message = 'Invalid file type. Only JPG, JPEG, and PNG files are allowed.';
    }
}

// Delete slider image
if (isset($_GET['delete'])) {
    $sliderId = $_GET['delete'];

    $deleteQuery = "DELETE FROM slider WHERE id = '$sliderId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        $message = 'Slider image deleted successfully.';
    } else {
        $message = 'Error deleting slider image.';
    }
}

// Retrieve slider images
$selectQuery = "SELECT * FROM slider";
$sliderResult = mysqli_query($conn, $selectQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Slider</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: #f44336;
            margin-top: 10px;
        }

        .slider-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .slider-item img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .slider-item .caption {
            flex: 1;
        }

        .slider-item .delete {
            color: #f44336;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Admin Slider</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="image">Slider Image:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div>
                <label for="caption">Caption:</label>
                <input type="text" name="caption" id="caption" required>
            </div>
            <div>
                <input type="submit" name="submit" value="Upload">
            </div>
        </form>

        <p><?php echo $message; ?></p>

        <h3>Slider Images</h3>
        <?php while ($row = mysqli_fetch_assoc($sliderResult)) : ?>
            <div class="slider-item">
                <img src="images/Slider/<?php echo $row['image']; ?>" alt="<?php echo $row['caption']; ?>">
                <div class="caption"><?php echo $row['caption']; ?></div>
                <div class="delete">
                    <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>