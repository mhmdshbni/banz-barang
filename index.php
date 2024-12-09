<?php
session_start();
include 'data_barang.php';
include 'data_customer.php';

function resetIds(&$data) {
    $newId = 1;
    foreach ($data as &$item) {
        $item['id'] = $newId++;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_barang'])) {
        $id = end($barang)['id'] + 1;
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $barang[] = ['id' => $id, 'nama_barang' => $nama_barang, 'harga' => $harga, 'stok' => $stok];
    } elseif (isset($_POST['delete_barang'])) {
        $id = $_POST['delete_barang'];
        foreach ($barang as $key => $item) {
            if ($item['id'] == $id) {
                unset($barang[$key]);
                break;
            }
        }

        resetIds($barang);
    } elseif (isset($_POST['add_customer'])) {
        $id = end($customer)['id'] + 1;
        $nama_customer = $_POST['nama_customer'];
        $email = $_POST['email'];
        $no_telepon = $_POST['no_telepon'];
        $customer[] = ['id' => $id, 'nama_customer' => $nama_customer, 'email' => $email, 'no_telepon' => $no_telepon];
    } elseif (isset($_POST['delete_customer'])) {
        $id = $_POST['delete_customer'];
        foreach ($customer as $key => $cust) {
            if ($cust['id'] == $id) {
                unset($customer[$key]);
                break;
            }
        }
        
        resetIds($customer);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1, h2 {
            color: #333;
            border-bottom: 2px solid #e2e2e2;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #5cb85c;
        }

        button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .delete-button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 align="center"><i class="fas fa-store"></i>BANZ ELEKTRONIK</h1>
        
        <h2><i class="fas fa-box-open"></i> Daftar Barang</h2>
        <form method="post">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" placeholder="Harga" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" id="stok" name="stok" placeholder="Stok" required>
            </div>
            <button type="submit" name="add_barang">Tambah Barang</button>
        </form>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Hapus</th>
            </tr>
            <?php
            foreach ($barang as $item) {
                echo "<tr>";
                echo "<td>" . $item['id'] . "</td>";
                echo "<td>" . $item['nama_barang'] . "</td>";
                echo "<td>" . $item['harga'] . "</td>";
                echo "<td>" . $item['stok'] . "</td>";
                echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_barang' value='" . $item['id'] . "' class='delete-button'>Hapus</button></form></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h2><i class="fas fa-users"></i> Daftar Customer</h2>
        <form method="post">
            <div class="form-group">
                <label for="nama_customer">Nama Customer</label>
                <input type="text" id="nama_customer" name="nama_customer" placeholder="Nama Customer" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">No Telepon</label>
                <input type="text" id="no_telepon" name="no_telepon" placeholder="No Telepon" required>
            </div>
            <button type="submit" name="add_customer">Tambah Customer</button>
        </form>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Hapus</th>
            </tr>
            <?php
            foreach ($customer as $cust) {
                echo "<tr>";
                echo "<td>" . $cust['id'] . "</td>";
                echo "<td>" . $cust['nama_customer'] . "</td>";
                echo "<td>" . $cust['email'] . "</td>";
                echo "<td>" . $cust['no_telepon'] . "</td>";
                echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_customer' value='" . $cust['id'] . "' class='delete-button'>Hapus</button></form></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
