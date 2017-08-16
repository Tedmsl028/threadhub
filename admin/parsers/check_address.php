<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/threadhub/core/init.php';
  $name = sanitize($_POST['full_name']);
  $email = sanitize($_POST['email']);
  $complex = sanitize($_POST['complex']);
  $street = sanitize($_POST['street']);
  $street2 = sanitize($_POST['street2']);
  $suburb = sanitize($_POST['suburb']);
  $province = sanitize($_POST['province']);
  $city = sanitize($_POST['city']);
  $postal_code = sanitize($_POST['postal_code']);
  $errors = array();
  $required = array(
    'full_name'   => 'Full Name',
    'email'       => 'Email',
    'complex'     => 'Complex',
    'street'      => 'Street Address',
    'suburb'      => 'Suburb',
    'province'    => 'Province',
    'city'        => 'City',
    'postal_code' => 'Postal Code',
  );

  foreach ($required as $f => $d){
    if(empty($_POST[$f]) || $_POST[$f] == ''){
      $errors[] = $d.' is required.';
    }
  }

  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[] = 'Please enter a valid email address.';
  }

  if(!empty($errors)){
    echo display_errors($errors);
  }else{
    echo 'passed';
  }
?>
