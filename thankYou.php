<?php
    require_once 'core/init.php';
    $name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $complex = sanitize($_POST['complex']);
    $street = sanitize($_POST['street']);
    $street2 = sanitize($_POST['street2']);
    $suburb = sanitize($_POST['suburb']);
    $province = sanitize($_POST['province']);
    $city = sanitize($_POST['city']);
    $postal_code = sanitize($_POST['postal_code']);
    $tax = sanitize($_POST['tax']);
    $sub_total = sanitize($_POST['sub_total']);
    $grand_total = sanitize($_POST['grand_total']);
    $cart_id = sanitize($_POST['cart_id']);
    $description = sanitize($_POST['description']);
    $charge_amount = number_format($grand_total,2) * 100;
    $metadata = array(
      "cart_id"   => $cart_id,
      "tax"       => $tax,
      "sub_total" => $sub_total,
    );

    //adjust inventory
    $itemQ = 
 ?>
