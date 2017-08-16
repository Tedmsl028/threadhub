<?php
  require_once 'core/init.php';
    unset($_SESSION['Cuser']);
    header('Location: /threadhub/index.php');
?>
