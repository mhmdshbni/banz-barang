<?php

if (!isset($_SESSION['customer'])) {
    $_SESSION['customer'] = [
        ['id' => 1, 'nama_customer' => 'Andi', 'email' => 'andi@example.com', 'no_telepon' => '081234567890'],
        ['id' => 2, 'nama_customer' => 'Budi', 'email' => 'budi@example.com', 'no_telepon' => '081234567891'],
        ['id' => 3, 'nama_customer' => 'Citra', 'email' => 'citra@example.com', 'no_telepon' => '081234567892'],
    ];
}

$customer = &$_SESSION['customer'];
?>
