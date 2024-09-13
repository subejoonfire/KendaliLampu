<?php
session_start();
include_once __DIR__ . '/../includes/functions.php';


if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'on') {
        updateIotStatus($id, 'Nyala');
    } elseif ($action === 'off') {
        updateIotStatus($id, 'Mati');
    }

    header('Location: dashboard.php'); // Refresh the page to see updates
    exit();
}

$iot_data = getIotData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Kendali Lampu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h2>Dashboard</h2>
            <div class="mt-4">
                <a href="login.php" class="btn btn-secondary mt-3">Logout</a>
                <div class="mt-4">
                    <h4>Data IoT</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama IoT</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($iot_data) && is_array($iot_data)): ?>
                                <?php foreach ($iot_data as $iot): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($iot['id']) ?></td>
                                        <td><?= htmlspecialchars($iot['namaiot']) ?></td>
                                        <td><?= htmlspecialchars($iot['status']) ?></td>
                                        <td>
                                            <a href="?action=on&id=<?= urlencode($iot['id']) ?>" class="btn btn-success btn-control">Nyala</a>
                                            <a href="?action=off&id=<?= urlencode($iot['id']) ?>" class="btn btn-danger btn-control">Mati</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
