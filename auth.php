<?php
  session_start();
  require_once "pages/connection.php"; 
  $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`= '".mysqli_real_escape_string($conn, $_POST['email'])."'");

  $result = mysqli_fetch_array($sql);

    if($_POST['email'] == $result['email'] && $_POST['pass'] == $result['password']){
          $_SESSION['auth'] = 'true';
          $_SESSION['admin'] = 'false';
          $_SESSION['id'] = $result['id'];
          if($result['role_id']==1){
            header("Location: pages/restricted_admin.php?id=".$result['id']);
            $_SESSION['admin'] = 'true';
            $_SESSION['admin_id'] = $result['id'];
          } else {
            header("Location: pages/restricted.php?id=".$result['id']);
          }
        }
      else {
          $_SESSION['auth'] = 'false';
          header("Location: pages/main.php?login=false");
      }
  
