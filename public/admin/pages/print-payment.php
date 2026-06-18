<?php

require_once __DIR__ . '/../../../classes/Pembayaran.php';

$pembayaranModel = new Pembayaran();

$dataPembayaran = $pembayaranModel->getAll();
$summary = $pembayaranModel->getReportSummary();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran AgniMukti</title>

    <style>
        *{
            box-sizing:border-box;
        }

        body{
            font-family: Arial, sans-serif;
            margin:40px;
            color:#222;
        }

        .header{
            text-align:center;
            margin-bottom:30px;
        }

        .header h1{
            margin:0;
            font-size:24px;
        }

        .header p{
            margin-top:5px;
            color:#666;
        }

        .summary{
            display:flex;
            gap:15px;
            margin-bottom:25px;
        }

        .card{
            flex:1;
            border:1px solid #ccc;
            padding:15px;
        }

        .card h3{
            margin:0;
            font-size:14px;
            color:#555;
        }

        .card p{
            margin-top:8px;
            font-size:20px;
            font-weight:bold;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #000;
            padding:8px;
            font-size:12px;
        }

        table th{
            background:#eee;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .footer{
            margin-top:50px;
            text-align:right;
        }

        @media print{
            button{
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <h1>LAPORAN PEMBAYARAN</h1>
    <p>Sistem Administrasi Kremasi AgniMukti</p>
</div>

<div class="summary">

    <div class="card">
        <h3>Total Transaksi</h3>
        <p><?= $summary['total_transaksi'] ?></p>
    </div>

    <div class="card">
        <h3>Pendapatan Lunas</h3>
        <p>
            Rp <?= number_format(
                $summary['total_lunas'],
                0,
                ',',
                '.'
            ) ?>
        </p>
    </div>

    <div class="card">
        <h3>Belum Bayar</h3>
        <p>
            Rp <?= number_format(
                $summary['total_belum_bayar'],
                0,
                ',',
                '.'
            ) ?>
        </p>
    </div>

</div>

<table>

    <thead>
        <tr>
            <th>No</th>
            <th>ID Invoice</th>
            <th>Kode Pendaftaran</th>
            <th>Nama Almarhum</th>
            <th>Tanggal Bayar</th>
            <th>Metode</th>
            <th>Total Bayar</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($dataPembayaran as $i => $row): ?>

        <tr>

            <td class="text-center">
                <?= $i + 1 ?>
            </td>

            <td>
                #INV-<?= str_pad(
                    $row['id_pembayaran'],
                    3,
                    '0',
                    STR_PAD_LEFT
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $row['kode_pendaftaran']
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $row['nama_almarhum']
                ) ?>
            </td>

            <td>
                <?= date(
                    'd-m-Y',
                    strtotime($row['tanggal_bayar'])
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $row['metode_pembayaran']
                ) ?>
            </td>

            <td class="text-right">
                Rp <?= number_format(
                    $row['total_bayar'],
                    0,
                    ',',
                    '.'
                ) ?>
            </td>

            <td class="text-center">
                <?= htmlspecialchars(
                    $row['status_pembayaran']
                ) ?>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<div class="footer">
    <p>
        Dicetak pada:
        <?= date('d F Y H:i') ?>
    </p>
</div>

<script>
    window.print();
</script>

</body>
</html>