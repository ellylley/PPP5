<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include Bootstrap CSS and JS for modal functionality -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
                </div>
            </div>
        </div>

        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" align="center">Restore Tugas</h4>
                        
                    </div>
                    <div class="card-content">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tugas</th>
                                        <th>Kelas</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tugas as $task) {
                                       
                                            // Retrieve the class name from the kelas table using id_kelas
                                            // $kelas = $this->db->get_where('kelas', ['id_kelas' => $task->id_kelas])->row();
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $task->nama_tugas ?></td>
                                        <td><?= $task->nama_kelas ?></td>
                                        <td><?= $task->tanggal ?></td>
                                        <td>
                                        <a href="<?= base_url('home/aksi_restore_tugas/'.$task->id_tugas)?>">
    <button class="btn btn-danger btn-sm ">Restore</button>
    </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    

    <!-- JavaScript to show Kelas dropdown and label -->
    
</body>
</html>
