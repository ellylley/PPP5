<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap CSS -->
    
    
    <style>
        .report-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .report-header h3 {
            font-weight: bold;
        }
        .class-card {
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 20px;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
        .table td, .table th {
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }
        .print-button {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="report-header">
        <h3>Laporan Penilaian</h3>
        <!-- Print Button -->
        <?php if (session()->get('level') != 5): // Hanya tampilkan jika level bukan 5 ?>
        <a href="#" class="btn btn-primary print-button" data-toggle="modal" data-target="#filterModal">Print</a>
    <?php endif; ?>
    </div>

    <!-- List group button & badge start -->
    <section class="list-group-button-badge">
        <?php foreach($kelas as $kelas_item): ?>
        <div class="card class-card">
            <div class="card-header">
                <h4 class="card-title">Kelas: <?= $kelas_item->nama_kelas; ?></h4>
            </div>
            <div class="card-body">
                <?php if (isset($users_by_class[$kelas_item->id_kelas])): ?>
                    <?php foreach($users_by_class[$kelas_item->id_kelas] as $user): ?>
                        <div class="user-info">
                            <h5>Nama: <?= $user->nama_user; ?></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Tugas</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_nilai = 0;
                                    $jumlah_tugas = count($tugas[$kelas_item->id_kelas]);
                                    ?>
                                    <?php foreach($tugas[$kelas_item->id_kelas] as $task): ?>
                                        <tr>
                                            <td><?= date('d-m-Y', strtotime($task->tanggal)); ?></td>
                                            <td><?= $task->nama_tugas; ?></td>
                                            <td><?= isset($user->nilai[$task->id_tugas]) && is_numeric($user->nilai[$task->id_tugas]) ? $user->nilai[$task->id_tugas] : '0'; ?></td>

                                            <?php
if (isset($user->nilai[$task->id_tugas]) && is_numeric($user->nilai[$task->id_tugas])) {
    $total_nilai += $user->nilai[$task->id_tugas];
}
?>


                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="2"><strong>Nilai Akhir</strong></td>
                                        <td>
                                        <?php
// Hitung nilai akhir rata-rata
if ($jumlah_tugas > 0) {
    $nilai_akhir = $total_nilai / $jumlah_tugas;
    // Memeriksa apakah ada bagian desimal
    if (floor($nilai_akhir) == $nilai_akhir) {
        echo number_format($nilai_akhir, 0, '.', ''); // Tidak menampilkan desimal
    } else {
        echo number_format($nilai_akhir, 2, '.', ''); // Menampilkan dua desimal
    }
} else {
    echo '0';
}
?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No users available for this class.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="filterFormWord" method="get" action="<?= base_url('home/word/') ?>">
                    <div class="form-group">
                        <label for="kelas">Nama Kelas</label>
                        <select id="kelas" name="kelas" class="form-control">
                            <option value="">Semua Kelas</option>
                            <?php foreach($kelas as $kelas_item): ?>
                                <option value="<?= $kelas_item->id_kelas; ?>"><?= $kelas_item->nama_kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
                <form id="filterFormPdf" method="get" action="<?= base_url('home/pdf/') ?>">
                    <input type="hidden" id="kelasPdf" name="kelas">
                </form>
                <form id="filterFormExcel" method="get" action="<?= base_url('home/excel/') ?>">
                    <input type="hidden" id="kelasExcel" name="kelas">
                </form>
            </div>
            <div class="modal-footer">
                <!-- Tombol untuk Word -->
                <button type="submit" class="btn btn-primary" onclick="submitFilter('word')">Word</button>
                <!-- Tombol untuk PDF -->
                <button type="submit" class="btn btn-danger" onclick="submitFilter('pdf')">PDF</button>
                <!-- Tombol untuk Excel -->
                <button type="submit" class="btn btn-success" onclick="submitFilter('excel')">Excel</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS & Popper.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<script>
function submitFilter(type) {
    var selectedKelas = document.getElementById('kelas').value;

    if (type === 'word') {
        $('#filterFormWord').submit();
    } else if (type === 'pdf') {
        $('#kelasPdf').val(selectedKelas);
        $('#filterFormPdf').submit();
    } else if (type === 'excel') {
        $('#kelasExcel').val(selectedKelas);
        $('#filterFormExcel').submit();
    }
}
</script>


</body>
</html>
