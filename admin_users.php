<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

if (isset($_POST['edit'])) {
   $edit_id = $_POST['user_id'];
   $new_name = $_POST['new_name'];
   $new_email = $_POST['new_email'];

   mysqli_query($conn, "UPDATE `users` SET name = '$new_name', email = '$new_email' WHERE id = '$edit_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      .edit-btn {
         display: inline-block;
         padding: 8px 16px;
         background-color: #4CAF50;
         color: white;
         border: none;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .edit-btn:hover {
         background-color: #45a049;
      }

      .edit-form {
         display: none;
         margin-top: 10px;
      }

      .edit-form input[type="text"],
      .edit-form input[type="email"] {
         margin-top: 5px;
      }

      .edit-form button[type="submit"] {
         margin-top: 10px;
         padding: 8px 16px;
         background-color: #4CAF50;
         color: white;
         border: none;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .edit-form button[type="submit"]:hover {
         background-color: #45a049;
      }

      .overlay {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 9999;
      }

      .edit-form {
         display: none;
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: #fff;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         z-index: 10000;
      }

      .edit-form h2 {
         margin-top: 0;
      }

      .edit-form input[type="text"],
      .edit-form input[type="email"] {
         width: 100%;
         padding: 8px;
         margin-bottom: 10px;
      }

      .edit-form button[type="submit"] {
         padding: 8px 16px;
         background-color: #4CAF50;
         color: white;
         border: none;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .edit-form button[type="submit"]:hover {
         background-color: #45a049;
      }

      .close-btn {
         position: absolute;
         top: 10px;
         right: 10px;
         cursor: pointer;
      }

      .overlay {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 9999;
      }

      .edit-form {
         display: none;
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: #fff;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         z-index: 10000;
      }

      .edit-form h2 {
         margin-top: 0;
      }

      .edit-form input[type="text"],
      .edit-form input[type="email"] {
         width: 100%;
         padding: 8px;
         margin-bottom: 10px;
      }

      .edit-form button[type="submit"] {
         padding: 8px 16px;
         background-color: #4CAF50;
         color: white;
         border: none;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .edit-form button[type="submit"]:hover {
         background-color: #45a049;
      }

      .close-btn {
         position: absolute;
         top: 10px;
         right: 10px;
         cursor: pointer;
      }
   </style>

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="users">

      <h1 class="title"> Akun Pengguna </h1>

      <div class="box-container">
         <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while ($fetch_users = mysqli_fetch_assoc($select_users)) {
         ?>
            <div class="box">
               <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
               <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
               <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
               <p> user type : <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                      echo 'var(--orange)';
                                                   } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
               <div class="box-buttons">
                  <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Hapus Akun Ini?');" class="delete-btn">Hapus Akun</a>
                  <a href="#" class="edit-btn" data-userid="<?php echo $fetch_users['id']; ?>">Edit Akun</a>
               </div>

               <div class="edit-form" data-userid="<?php echo $fetch_users['id']; ?>">
                  <h2>Edit Akun</h2>
                  <form action="" method="POST">
                     <input type="hidden" name="user_id" value="<?php echo $fetch_users['id']; ?>">
                     <label for="new_name">Nama:</label>
                     <input type="text" id="new_name" name="new_name" value="<?php echo $fetch_users['name']; ?>" required>
                     <label for="new_email">Email:</label>
                     <input type="email" id="new_email" name="new_email" value="<?php echo $fetch_users['email']; ?>" required>
                     <button type="submit" name="edit">Simpan</button>
                  </form>
                  <span class="close-btn">&times;</span>
               </div>
            </div>
         <?php
         }
         ?>
      </div>

   </section>

   <script>
      const editButtons = document.querySelectorAll('.edit-btn');
      const editForms = document.querySelectorAll('.edit-form');
      const closeButtons = document.querySelectorAll('.close-btn');

      editButtons.forEach((button) => {
         button.addEventListener('click', () => {
            const userId = button.getAttribute('data-userid');
            const editForm = document.querySelector(`.edit-form[data-userid="${userId}"]`);
            editForm.style.display = 'block';
         });
      });

      closeButtons.forEach((button) => {
         button.addEventListener('click', () => {
            const editForm = button.parentNode;
            editForm.style.display = 'none';
         });
      });
   </script>

</body>

</html>