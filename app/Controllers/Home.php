<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_projek2;
use CodeIgniter\Session\Session;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\LevelPermissionModel;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('level')>0){
            $model= new M_projek2();
            $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman dashboard'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
            $where=array(
                'id_setting'=> 1
              );
              $data['setting'] = $model->getWhere('setting',$where);
              $data['currentMenu'] = 'dashboard'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('dashboard', $data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
 
    } 
    }

    //profile

    public function profile($id)
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 2||session()->get('level') == 3||session()->get('level') == 4||session()->get('level') == 5  ) {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $where= array('user.id_user'=>$id);
        $where=array('id_user'=>session()->get('id'));
        
        $data['user']=$model->getWhere('user',$where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);

        echo view('header',$data);
        echo view ('menu',$data);
        echo view('profile',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/error');
        }
        
}
public function aksieprofile() 
{
    $model = new M_projek2();

    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    $a = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama
    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);

    

    $isi = array(
        'nama_user' => $a,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->to('home/profile/'.$id);
}
    
public function user()
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman manajemen user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
        $data['elly'] = $model->tampil('user', 'id_user');
        $data['backup_users'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $user) {
            $data['backup_users'][$user->id_user] = $model->getBackupUser($user->id_user);
        }

        $data['satu'] = $model->getWhere('user', ['id_user' => $id_user]);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function aksi_tambah_user()
    {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a = $this->request->getPost('nama');
        $b = $this->request->getPost('level');
        $c = md5($this->request->getPost('password'));
        $d = $this->request->getPost('nis');
        $e = $this->request->getPost('nisn');
        $f = $this->request->getPost('kelas');
        $g = $this->request->getPost('jk');
        $h = $this->request->getPost('lahir');
        // $g = $this->request->getPost('editmodul');
        $uploadedFile = $this->request->getFile('foto');

        // Cek apakah file foto di-upload atau tidak
        if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
            $foto = $uploadedFile->getName();
            $model->upload($uploadedFile);
        } else {
            // Set foto default jika tidak ada file yang di-upload
            $foto = 'default.jpg';
        }
        if ($b == 1) {
         
           
        }
    
        
        $isi = array(
            'nama_user' => $a,
            'level' => $b,
            'password' => $c,
           'nis' => $d,
            'nisn' => $e,
            'id_kelas' => $f,
            'jk' => $g,
            'tgl_lhr' => $h,
            'foto' => $foto,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            

        );
        $model ->tambah('user', $isi);
        
        return redirect()->to('home/user');
    }

    public function aksi_edit_user()
{
    $model = new M_projek2();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
       
    $a = $this->request->getPost('nama');
    $b = $this->request->getPost('level');
    $c = ($this->request->getPost('password'));
    $d = $this->request->getPost('nis');
    $e = $this->request->getPost('nisn');
    $f = $this->request->getPost('kelas');
    $g = $this->request->getPost('jk');
    $h = $this->request->getPost('lahir');
    // $g = $this->request->getPost('editmodul');
    $id = $this->request->getPost('id');
    $fotoName = $this->request->getPost('old_foto'); // Mengambil nama foto lama
    $foto = $this->request->getFile('foto');


    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);


    if ($foto && $foto->isValid()) {
        // Generate a new name for the uploaded file
        $newName = $foto->getRandomName();
        // Move the file to the target directory
        $foto->move(ROOTPATH . 'public/images', $newName);
        // Set the new file name to be saved in the database
        $fotoName = $newName;
    }

    // Mengatur nilai untuk nis dan nisn berdasarkan level
    if ($b == 1) {
        $d = null; // Atau bisa di-set ke string kosong ''
        $e = null; // Atau bisa di-set ke string kosong ''
    }

    // Mengatur id_kelas jadi null jika level adalah 2, 3, atau 4
    if (in_array($b, [2, 3, 4])) {
        $f = null;
    }

    $isi = array(
        'nama_user' => $a,
        'level' => $b,
        'password' => $c,
        'nis' => $d,
        'nisn' => $e,
        'id_kelas' => $f,
        'jk' => $g,
        'tgl_lhr' => $h,
        // 'editmodul' => $g,
        'foto' => $fotoName,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function aksi_reset($id)
{
    $model = new M_projek2();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
    $where = array('id_user' => $id);
    
    $isi = array(
        'password' => md5('12345'),
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    );
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function hapususer($id){
    $model = new M_projek2();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('user', $data, ['id_user' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_user' => $id);
$model->hapus('backup_user', $where);
    return redirect()->to('home/user');
}

//kelas

public function kelas()
    {   
        if (session()->get('level') == 0||session()->get('level') == 1 ) {
    	$model= new M_projek2();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman manajemen kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $where= array('id_kelas'=>$id);
        $data['satu']=$model->getwhere('kelas',$where);
      
        $data['elly'] = $model->tampil('kelas','id_kelas');
        $data['backup_kelas'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $kelas) {
            $data['backup_kelas'][$kelas->id_kelas] = $model->getBackupKelas($kelas->id_kelas);
        }

        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'kelas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('kelas',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_tambah_kelas()
    {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $a = $this->request->getPost('kelas');
       
       
        
        $isi = array(
            'nama_kelas' => $a,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            
            

        );
        $model ->tambah('kelas', $isi);
        
        return redirect()->to('home/kelas');
    }
    

    public function aksi_edit_kelas()
    {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $a = $this->request->getPost('kelas');
        $id = $this->request->getPost('id');
       
        $backupWhere = ['id_kelas' => $id];
        $existingBackup = $model->getWhere('backup_kelas', $backupWhere);
    
        if ($existingBackup) {
            // Hapus data lama di user_backup jika ada
            $model->hapus('backup_kelas', $backupWhere);
        }
    
        // Ambil data user lama berdasarkan id_user
        $userLama = $model->getKelasById($id);
    
        // Simpan data user lama ke tabel user_backup
        $backupData = (array) $userLama;  // Ubah objek menjadi array
        $model->tambah('backup_kelas', $backupData);
        
        $isi = array(
            'nama_kelas' => $a,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login


        );
        $where = array('id_kelas' => $id);
        $model ->edit('kelas', $isi, $where);
        
        return redirect()->to('home/kelas');
    }

    public function hapuskelas($id){
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menghapus data kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $data = [
            'isdelete' => 1,
            'deleted_by' => $id_user,
            'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
        ];
       
        
          
        $model->edit('kelas', $data, ['id_kelas' => $id]);

        //Hapus data dari tabel backup_kelas
    $where = array('id_kelas' => $id);
    $model->hapus('backup_kelas', $where);

        return redirect()->to('home/kelas');
   }

   //tugas

   public function tugas()
{   
    if (session()->get('level') == 0||session()->get('level') == 1 ||session()->get('level') == 4||session()->get('level') == 5 ) {
        $model = new M_projek2();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $id_kelas = session()->get('id_kelas'); // Ambil ID kelas user dari session
        $activity = 'Mengakses halaman manajemen tugas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
        
        // Kondisi default untuk semua level
        $where = [
            'tugas.isdelete' => 0,
        ];

        // Tambahkan kondisi khusus untuk level 4
        if (session()->get('level') == 4) {
            $where['tugas.id_user'] = $id_user; // Hanya menampilkan tugas sesuai dengan id_user
        }

        // Tambahkan kondisi khusus untuk level 5
        if (session()->get('level') == 5) {
            $where['tugas.id_kelas'] = $id_kelas; // Hanya menampilkan tugas sesuai dengan id_kelas user
        }

        $data['tugas'] = $model->joinkondisi('tugas', 'kelas', 'tugas.id_kelas=kelas.id_kelas', 'tugas.id_tugas', $where);
        $data['backup_tugas'] = []; // Inisialisasi array untuk backup user

        foreach ($data['tugas'] as $tugas) {
            $data['backup_tugas'][$tugas->id_tugas] = $model->getBackupTugas($tugas->id_tugas);
        }

        $where = array(
            'id_setting' => 1
        );
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'tugas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('tugas', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    } 
}



    public function aksi_tambah_tugas()
    {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah data tugas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $a = $this->request->getPost('nama_tugas');
        $b = $this->request->getPost('kelas');
        $c = $this->request->getPost('tanggal');
       
        
        $isi = array(
            'nama_tugas' => $a,
            'id_kelas' => $b,
            'tanggal' => $c,
            'id_user' => $id_user,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            
            

        );
        $model ->tambah('tugas', $isi);
        
        return redirect()->to('home/tugas');
    }
    public function aksi_edit_tugas()
    {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data tugas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $a = $this->request->getPost('nama_tugas');
        $b = $this->request->getPost('kelas');
        $c = $this->request->getPost('tanggal');
        $id = $this->request->getPost('id');
       
        $backupWhere = ['id_tugas' => $id];
        $existingBackup = $model->getWhere('backup_tugas', $backupWhere);
    
        if ($existingBackup) {
            // Hapus data lama di user_backup jika ada
            $model->hapus('backup_tugas', $backupWhere);
        }
    
        // Ambil data user lama berdasarkan id_user
        $userLama = $model->getTugasById($id);
    
        // Simpan data user lama ke tabel user_backup
        $backupData = (array) $userLama;  // Ubah objek menjadi array
        $model->tambah('backup_tugas', $backupData);

        $isi = array(
            'nama_tugas' => $a,
            'id_kelas' => $b,
            'tanggal' => $c,
            'id_user' => $id_user,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'updated_by' => $id_user // ID user yang login
            
            

        );
        $where = array('id_tugas' => $id);
        $model ->edit('tugas', $isi, $where);
        
        return redirect()->to('home/tugas');
    }

    public function hapustugas($id){
        $model = new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menghapus data tugas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $data = [
            'isdelete' => 1,
            'deleted_by' => $id_user,
            'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
        ];
       
        
          
        $model->edit('tugas', $data, ['id_tugas' => $id]);

        // Hapus data dari tabel backup_kelas
    $where = array('id_tugas' => $id);
    $model->hapus('backup_tugas', $where);

        return redirect()->to('home/tugas');
   }

   //nilai

   public function nilai()
{
    if (session()->get('level') == 0 || session()->get('level') == 1 || session()->get('level') == 4) {
        $model = new M_projek2();
        $id_user = session()->get('id'); // Get user ID from session
    
        // Logging activity
        $activity = 'Mengakses halaman penilaian'; // Activity description
        $this->addLog($id_user, $activity);
    
        if (session()->get('level') == 4) {
            // Get tasks only for the logged-in user (id_user)
            $tasks = $model->getWhereres('tugas', ['id_user' => $id_user, 'isdelete' => 0]);  // Filter tugas sesuai id_user
    
            // Get IDs of classes that have tasks assigned to the logged-in user
            $kelas_ids = array_unique(array_column($tasks, 'id_kelas'));
    
            // Get classes where id_kelas is in the list of kelas_ids
            $data['kelas'] = $model->getWhereres('kelas', ['id_kelas' => $kelas_ids, 'isdelete' => 0]);
    
        } else {
            // Get all classes with isdelete = 0
            $data['kelas'] = $model->getWhereres('kelas', ['isdelete' => 0]);
        }
    
        // Get tasks
        if (session()->get('level') == 4) {
            $tasks = $model->getWhereres('tugas', ['id_user' => $id_user, 'isdelete' => 0]);  // Filter tugas sesuai id_user
        } else {
            $tasks = $model->getWhereres('tugas', ['isdelete' => 0]);  // Tambahkan filter isdelete = 0
        }
    
        // Get all grades with join
        $data['nilai'] = $model->jointiga('nilai', 'tugas', 'user', 
            'nilai.id_tugas=tugas.id_tugas', 'nilai.id_user=user.id_user', 'nilai.id_nilai');
    
        // Group tasks by class
        $data['tugas_by_kelas'] = [];
        foreach ($data['kelas'] as $kelas) {
            // Create a list for this class
            $data['tugas_by_kelas'][$kelas->id_kelas] = array_filter($tasks, function($task) use ($kelas) {
                // Ensure the id_kelas in task is a single value and compare it
                return $task->id_kelas == $kelas->id_kelas;
            });
        }
    
        // Get settings
        $where = array('id_setting'=> 1);
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'nilai'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('nilai', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function nilaisiswa()
{
    if (session()->get('level') == 0 || session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4 || session()->get('level') == 5) {
        $model = new M_projek2();
        
        $id_user = session()->get('id'); // Get user ID from session
        $level = session()->get('level'); // Get user level
        $activity = 'Mengakses halaman laporan penilaian'; // Activity description
        $this->addLog($id_user, $activity);

        // Initialize data arrays
        $data['kelas'] = [];
        $data['users_by_class'] = [];
        $data['tugas'] = [];

        if ($level == 5) {
            // If level 5, get only the user's class
            $user = $model->getWhereres('user', ['id_user' => $id_user], 'id_kelas');
            if ($user) {
                $id_kelas_user = $user[0]->id_kelas; // Get the user's class ID
                // Get class information where the user belongs
                $data['kelas'] = $model->getWhereres('kelas', ['id_kelas' => $id_kelas_user, 'isdelete' => 0], 'id_kelas');
                
                // Get users in this class
                $data['users_by_class'][$id_kelas_user] = $model->getWhereres('user', [
                    'id_kelas' => $id_kelas_user, 
                    'id_user' => $id_user, // Only get the logged-in user's data
                    'isdelete' => 0
                ]);
                
                // Get tasks for this class
                $data['tugas'][$id_kelas_user] = $model->getWhereres('tugas', [
                    'id_kelas' => $id_kelas_user,
                    'isdelete' => 0
                ]);

                // Process user data to get their grades for each task
                foreach ($data['users_by_class'][$id_kelas_user] as &$user_data) {
                    $nilai_per_tugas = [];

                    foreach ($data['tugas'][$id_kelas_user] as $task) {
                        $nilai = $model->getWhereres('nilai', [
                            'id_user' => $user_data->id_user,
                            'id_tugas' => $task->id_tugas
                        ]);

                        // Set nilai per tugas, if available
                        $nilai_per_tugas[$task->id_tugas] = isset($nilai[0]->nilai) ? $nilai[0]->nilai : '';
                    }
                    $user_data->nilai = $nilai_per_tugas; // Assign nilai to user
                }
            }
        } else {
            // For other levels, get all classes and users normally
            $data['kelas'] = $model->getWhereres('kelas', ['isdelete' => 0], 'id_kelas');
            
            foreach ($data['kelas'] as $kelas) {
                // Get users by class id
                $data['users_by_class'][$kelas->id_kelas] = $model->getWhereres('user', [
                    'id_kelas' => $kelas->id_kelas,
                    'isdelete' => 0
                ]);
                
                // Get tasks by class id
                $data['tugas'][$kelas->id_kelas] = $model->getWhereres('tugas', [
                    'id_kelas' => $kelas->id_kelas,
                    'isdelete' => 0
                ]);

                // Process each user to get their grades for each task
                foreach ($data['users_by_class'][$kelas->id_kelas] as &$user) {
                    $nilai_per_tugas = [];
                    
                    foreach ($data['tugas'][$kelas->id_kelas] as $task) {
                        $nilai = $model->getWhereres('nilai', [
                            'id_user' => $user->id_user,
                            'id_tugas' => $task->id_tugas
                        ]);

                        // Set nilai per tugas, if available
                        $nilai_per_tugas[$task->id_tugas] = isset($nilai[0]->nilai) ? $nilai[0]->nilai : '';
                    }
                    $user->nilai = $nilai_per_tugas; // Assign nilai to user
                }
            }
        }

        // Get settings
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'nilaisiswa'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('nilaisiswa', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    } 
}



public function word()
{
    $model = new M_projek2();
    
    $id_user = session()->get('id'); // Get user ID from session
    $activity = 'Mencetak nilai siswa'; // Activity description
    $this->addLog($id_user, $activity);

    // Get filter 'kelas' from GET request
    $selected_kelas = $this->request->getGet('kelas');

    // Get all classes (or specific class if filter is applied)
    if ($selected_kelas) {
        // Filter berdasarkan nama_kelas yang dipilih
        $data['kelas'] = $model->getWhereres('kelas', ['id_kelas' => $selected_kelas]);
    } else {
        // Jika tidak ada filter, ambil semua kelas
        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
    }

    // Get all users and tasks by class
    $data['users_by_class'] = [];
    $data['tugas'] = [];
    foreach ($data['kelas'] as $kelas) {
        // Get users by class id
        $data['users_by_class'][$kelas->id_kelas] = $model->getWhereres('user', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0 ]);

        // Get tasks by class id
        $data['tugas'][$kelas->id_kelas] = $model->getWhereres('tugas', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0 ]);

        // Process each user to get their grades for each task
        foreach ($data['users_by_class'][$kelas->id_kelas] as &$user) {
            $nilai_per_tugas = [];
            
            foreach ($data['tugas'][$kelas->id_kelas] as $task) {
                $nilai = $model->getWhereres('nilai', [
                    'id_user' => $user->id_user,
                    'id_tugas' => $task->id_tugas
                ]);

                // Set nilai per tugas, if available
                $nilai_per_tugas[$task->id_tugas] = isset($nilai[0]->nilai) ? $nilai[0]->nilai : '';
            }
            $user->nilai = $nilai_per_tugas; // Assign nilai to user
        }
    }

    // Get settings
    $where = array('id_setting' => 1);
    $data['setting'] = $model->getWhere('setting', $where);

    // Pass data to view
    echo view('word', $data);
}

public function excel()
{
    $model = new M_projek2();

    $id_user = session()->get('id'); // Get user ID from session
    $activity = 'Mencetak nilai siswa'; // Activity description
    $this->addLog($id_user, $activity);

    // Get filter 'kelas' from GET request
    $selected_kelas = $this->request->getGet('kelas');

    // Get all classes (or specific class if filter is applied)
    if ($selected_kelas) {
        $data['kelas'] = $model->getWhereres('kelas', ['id_kelas' => $selected_kelas]);
    } else {
        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
    }

    // Get all users and tasks by class
    foreach ($data['kelas'] as $kelas) {
        $data['users_by_class'][$kelas->id_kelas] = $model->getWhereres('user', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0]);
        $data['tugas'][$kelas->id_kelas] = $model->getWhereres('tugas', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0]);
    
        foreach ($data['users_by_class'][$kelas->id_kelas] as $key => $user) {
            $nilai_per_tugas = [];
    
            foreach ($data['tugas'][$kelas->id_kelas] as $task) {
                $nilai = $model->getWhereres('nilai', [
                    'id_user' => $user->id_user,
                    'id_tugas' => $task->id_tugas
                ]);
                $nilai_per_tugas[$task->id_tugas] = isset($nilai[0]->nilai) ? $nilai[0]->nilai : '';
            }
            // Set nilai ke masing-masing user dengan mengakses index, bukan menggunakan referensi
            $data['users_by_class'][$kelas->id_kelas][$key]->nilai = $nilai_per_tugas;
        }
    }
    

    // Create new Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Define border style
    $borderStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];

    // Define font style for class header
    $classHeaderStyle = [
        'font' => [
            'bold' => true,
            'size' => 14, // Atur ukuran font di sini
        ],
    ];

    // Initial row position
    $row = 1;

    foreach ($data['kelas'] as $kelas_item) {
        // Header Kelas
        $sheet->setCellValue('A' . $row, 'Kelas: ' . $kelas_item->nama_kelas);
        
        // Apply style to the class header
        $sheet->getStyle('A' . $row)->applyFromArray($classHeaderStyle);
        $row++;

        // Set header untuk info siswa
        $sheet->setCellValue('A' . $row, 'Nama');
        $sheet->setCellValue('B' . $row, 'NIS');

        // Dynamic header untuk setiap tugas
        $col = 'C'; // Mulai dari kolom C
        foreach ($data['tugas'][$kelas_item->id_kelas] as $task) {
            $sheet->setCellValue($col . $row, $task->nama_tugas);
            $col++;
        }

        // Header untuk Nilai Akhir
        $sheet->setCellValue($col . $row, 'Nilai Akhir');

        // Tambahkan border untuk header
        $sheet->getStyle('A' . $row . ':' . $col . $row)->applyFromArray($borderStyle);
        $row++;

        // Set lebar kolom untuk header
        foreach (range('A', $col) as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Mengisi data siswa
        if (isset($data['users_by_class'][$kelas_item->id_kelas])) {
            foreach ($data['users_by_class'][$kelas_item->id_kelas] as $user) {
                // Isi data siswa
                $sheet->setCellValue('A' . $row, $user->nama_user);
                $sheet->setCellValue('B' . $row, $user->nis);

                // Isi nilai tugas
                $col = 'C';
                $total_nilai = 0;
                $jumlah_tugas = count($data['tugas'][$kelas_item->id_kelas]);

                foreach ($data['tugas'][$kelas_item->id_kelas] as $task) {
                    $nilai = isset($user->nilai[$task->id_tugas]) && $user->nilai[$task->id_tugas] !== '' ? $user->nilai[$task->id_tugas] : 0;

                    $sheet->setCellValue($col . $row, $nilai);

                    if (is_numeric($nilai)) {
                        $total_nilai += $nilai;
                    }
                    $col++;
                }

                // Hitung dan isi Nilai Akhir
                $nilai_akhir = $jumlah_tugas > 0 ? $total_nilai / $jumlah_tugas : 0;
                $sheet->setCellValue($col . $row, number_format($nilai_akhir, 2, '.', ''));

                // Tambahkan border untuk baris data siswa
                $sheet->getStyle('A' . $row . ':' . $col . $row)->applyFromArray($borderStyle);
                $row++;
            }
        } else {
            $sheet->setCellValue('A' . $row, 'Tidak ada siswa pada kelas ini.');
            $row++;

            // Tambahkan border untuk pesan tidak ada siswa
            $sheet->getStyle('A' . $row . ':' . $col . $row)->applyFromArray($borderStyle);
        }

        // Tambahkan spasi sebelum kelas berikutnya
        $row++;
    }

    // Set headers untuk download Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="LAPORAN NILAI TUGAS P5 SISWA.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

public function pdf()
{
    $model = new M_projek2();
    
    $id_user = session()->get('id'); // Get user ID from session
    $activity = 'Mencetak nilai siswa'; // Activity description
    $this->addLog($id_user, $activity);
    $dompdf = new dompdf();

    // Get filter 'kelas' from GET request
    $selected_kelas = $this->request->getGet('kelas');

    // Get all classes (or specific class if filter is applied)
    if ($selected_kelas) {
        $data['kelas'] = $model->getWhereres('kelas', ['id_kelas' => $selected_kelas]);
    } else {
        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
    }

    // Get all users and tasks by class
    $data['users_by_class'] = [];
    $data['tugas'] = [];
    foreach ($data['kelas'] as $kelas) {
        $data['users_by_class'][$kelas->id_kelas] = $model->getWhereres('user', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0]);
        $data['tugas'][$kelas->id_kelas] = $model->getWhereres('tugas', ['id_kelas' => $kelas->id_kelas, 'isdelete' => 0]);

        foreach ($data['users_by_class'][$kelas->id_kelas] as &$user) {
            $nilai_per_tugas = [];
            
            foreach ($data['tugas'][$kelas->id_kelas] as $task) {
                $nilai = $model->getWhereres('nilai', [
                    'id_user' => $user->id_user,
                    'id_tugas' => $task->id_tugas
                ]);
                $nilai_per_tugas[$task->id_tugas] = isset($nilai[0]->nilai) ? $nilai[0]->nilai : '';
            }
            $user->nilai = $nilai_per_tugas;
        }
    }

    // Get settings
    $where = array('id_setting' => 1);
    $data['setting'] = $model->getWhere('setting', $where);

    // Convert logo to base64
    $path = FCPATH . 'images/' . $data['setting']->logo;
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data['base64_logo'] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path));
    } else {
        $data['base64_logo'] = ''; // Handle the case where logo does not exist
    }

    $html = view('pdf', $data);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('LAPORAN NILAI TUGAS P5 SISWA.pdf', array("Attachment" => false));
}


public function getUsersByClass($id_kelas)
{
    $model = new M_projek2();

    // Filter users by class ID and isdelete = 0
    $where = [
        'id_kelas' => $id_kelas,
        'isdelete' => 0  // Tambahkan kondisi isdelete = 0
    ];
    $users = $model->getWhereres('user', $where);
    
    // Prepare array for users with their grades
    $users_with_grades = [];

    foreach ($users as $user) {
        // Filter nilai by id_user, id_tugas, and isdelete = 0
        $nilai = $model->getWhereres('nilai', [
            'id_user' => $user->id_user, 
            'id_tugas' => $this->request->getVar('id_tugas')
            // 'isdelete' => 0  // Tambahkan kondisi isdelete = 0
        ]);

        // Include the grade in the user data
        $user->nilai = isset($nilai[0]->nilai) ? $nilai[0]->nilai : ''; // if no grade, set it to empty string
        
        $users_with_grades[] = $user;
    }

    // Return users with grades in JSON format
    return $this->response->setJSON(['users' => $users_with_grades]);
}



public function savenilai()
{
    $model = new M_projek2();
    $id_user = session()->get('id'); // Get user ID from session
    $current_time = date('Y-m-d H:i:s'); // Current timestamp

    // Ambil data JSON yang dikirim
    $input = $this->request->getJSON();
    $nilai = $input->nilai; // Data nilai dari client

    // Periksa apakah data nilai ada
    if (!is_array($nilai) || empty($nilai)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'No data provided']);
    }
    
    // Loop melalui setiap nilai dan simpan ke database
    foreach ($nilai as $item) {
        $data = [
            'id_user' => $item->id_user,
            'id_tugas' => $item->id_tugas,
            'id_kelas' => $item->id_kelas,
            'nilai' => $item->nilai,
            'updated_by' => $id_user,
            'updated_at' => $current_time
        ];
        
        // Periksa apakah nilai sudah ada, jika ada, update, jika tidak, insert baru
        $existing = $model->getWhereres('nilai', [
            'id_user' => $data['id_user'],
            'id_tugas' => $data['id_tugas']
        ]);

        if ($existing) {
            // Update nilai
            $model->edit('nilai', $data, [
                'id_user' => $data['id_user'],
                'id_tugas' => $data['id_tugas']
            ]);
        } else {
            // Insert nilai baru
            $data['created_by'] = $id_user;
            $data['created_at'] = $current_time;
            $model->tambah('nilai', $data);
        }
    }

    return $this->response->setJSON(['status' => 'success', 'message' => 'Nilai berhasil disimpan!']);
}






   //setting

   public function setting()
{
    // Memeriksa level akses user
    if (session()->get('level') == 0||session()->get('level') == 1 ) {
      
        $model = new M_projek2();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_setting' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('setting', $where);
 
        // Memuat view
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        $data['currentMenu'] = 'setting'; 
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        return redirect()->to('home/error');
    } 
}

public function aksisetting()
{
    $model = new M_projek2();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
    
       
    $nama = $this->request->getPost('nama');
    $alamat = $this->request->getPost('alamat');
    $nohp = $this->request->getPost('nohp');
    $sekolah = $this->request->getPost('sekolah');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_setting' => $id);

    $isi = array(
        'nama_setting' => $nama,
        'alamat' => $alamat,
        'nohp' => $nohp,
        'nama_sekolah'=> $sekolah,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('setting', $isi, $where);

    return redirect()->to('home/setting/'.$id);
}

//login
public function login()
    {
        $model= new M_projek2();
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
        echo view('header');
        echo view('login', $data);
    


} 
public function aksilogin()
{
    $name = $this->request->getPost('nama');
    $pw = $this->request->getPost('password');
    $captchaResponse = $this->request->getPost('g-recaptcha-response');
    $backupCaptcha = $this->request->getPost('backup_captcha');
    
    $secretKey = '6LdLhiAqAAAAAPxNXDyusM1UOxZZkC_BLCgfyoQf'; // Ganti dengan secret key Anda yang sebenarnya
    $recaptchaSuccess = false;

    $captchaModel = new M_projek2();

    // Cek koneksi internet
    if ($this->isInternetAvailable()) {
        // Verifikasi reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
        $responseKeys = json_decode($response, true);
        $recaptchaSuccess = $responseKeys["success"];
    }
    
    if ($recaptchaSuccess) {
        // reCAPTCHA berhasil
        $where = [
            'nama_user' => $name,
            'password' => md5($pw),
        ];

        $model = new M_projek2();
        $check = $model->getWhere('user', $where);

        if ($check) {
            session()->set('id', $check->id_user);
            session()->set('nama', $check->nama_user);
            session()->set('level', $check->level);
            session()->set('foto', $check->foto);
            session()->set('id_kelas', $check->id_kelas);
            session()->set('editmodul', $check->editmodul);
            return redirect()->to('home');
        } else {
            return redirect()->to('home/login')->with('error', 'Invalid username or password.');
        }
    } else {
        // Validasi CAPTCHA offline
        $storedCaptcha = session()->get('captcha_code'); // Retrieve stored CAPTCHA from session
        
        if ($storedCaptcha !== null) {
            if ($storedCaptcha === $backupCaptcha) {
                // CAPTCHA valid
                $where = [
                    'nama_user' => $name,
                    'password' => md5($pw),
                ];

                $model = new M_projek2();
                $check = $model->getWhere('user', $where);

                if ($check) {
                    session()->set('id', $check->id_user);
                    session()->set('nama', $check->nama_user);
                    session()->set('level', $check->level);
                    session()->set('foto', $check->foto);
                    session()->set('id_kelas', $check->id_kelas);
                    session()->set('editmodul', $check->editmodul);

                    return redirect()->to('home');
                } else {
                    return redirect()->to('home/login')->with('error', 'Invalid username or password.');
                }
            } else {
                // CAPTCHA tidak valid
                return redirect()->to('home/login')->with('error', 'Invalid CAPTCHA.');
            }
        } else {
            return redirect()->to('home/login')->with('error', 'CAPTCHA session is not set.');
        }
    }
}




    public function generateCaptcha()
{
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Store the CAPTCHA code in the session
    session()->set('captcha_code', $code);

    // Generate the image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Set the content type header - in this case image/png
    header('Content-Type: image/png');

    // Output the image
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

private function isInternetAvailable()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    

}

//log

public function log() 
{
    if (session()->get('level') == 0||session()->get('level') == 1 ) {

      
        $model = new M_projek2();


        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman log aktivitas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
        $data['logs'] = $model->getActivityLogs();
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        
        $data['currentMenu'] = 'log'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    }else{
        return redirect()->to('home/error');
        }
        
}

    public function addLog($id_user, $activity)
{
    $model = new M_projek2(); // Gunakan model M_kedaikopi
    $id_user = session()->get('id');
    $data = [
        'id_user' => $id_user,
        'activity' => $activity,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
}

//changepasswaord
// public function changepassword()
// {
//     if (session()->get('id') > 0) {
      
//         $model = new M_projek2();
//         $id_user = session()->get('id'); // Ambil ID user dari session
//         $activity = 'Mengakses halaman ubah password'; // Deskripsi aktivitas
//         $this->addLog($id_user, $activity);
        
       
        
        
//         $where = array(
//             'id_setting' => 1
//         );
//         $data['setting'] = $model->getWhere('setting', $where);
        
//         $where = array('id_user' => session()->get('id'));
//         $data['elly'] = $model->getwhere('user', $where);
        
//         echo view('header', $data);
//         echo view('menu', $data);
//         echo view('changepassword', $data);
//         echo view('footer');
//     }else{
//         return redirect()->to('home/error');
//         }
        
// }




public function aksi_changepass() {
    $model = new M_projek2();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'mengubah password profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
   

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($id_user);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }
 
    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'updated_by' => $id_user,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $id_user];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/profile/'.$id_user);
}


//restore

public function restore_user()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_projek2();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $where = [
            'user.isdelete' => 1,
            
        ];
        $data['elly'] = $model->joinkondisi('user', 'kelas', 'user.id_kelas=kelas.id_kelas', 'user.id_user', $where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_user',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_user($id) {
        $model = new M_projek2();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore user'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('user', $data, ['id_user' => $id]);
    
        return redirect()->to('home/restore_user');
    }
    public function restore_kelas()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {

    	$model= new M_projek2();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore kelas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
        $data['elly'] = $model->tampil('kelas','id_kelas');
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_kelas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_kelas',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_kelas($id) {
        $model = new M_projek2();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore kelas'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('kelas', $data, ['id_kelas' => $id]);
    
        return redirect()->to('home/restore_kelas');
    }

    public function restore_tugas()
    {   
        if (session()->get('level') == 0||session()->get('level') == 1 ) {
    	$model= new M_projek2();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman manajemen tugas'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        // $where= array('id_kelas'=>$id);
        // $data['satu']=$model->getwhere('tugas',$where);
        $data['kelas'] = $model->tampil('kelas', 'id_kelas');
        $where = [
            'tugas.isdelete' => 1,
            
        ];
        $data['tugas'] = $model->joinkondisi('tugas','kelas', 'tugas.id_kelas=kelas.id_kelas', 'tugas.id_tugas', $where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_tugas'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_tugas',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_tugas($id) {
        $model = new M_projek2();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore tugas'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('tugas', $data, ['id_tugas' => $id]);
    
        return redirect()->to('home/restore_tugas');
    }

    //reedit
    public function aksi_unedit_user()
{
    $model = new M_projek2();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/user')->with('error', 'ID user tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore user yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_user', ['id_user' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_user']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('user', $restoreData, ['id_user' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_user', ['id_user' => $id]);
    }

    return redirect()->to('home/user');
}

public function aksi_unedit_kelas()
{
    $model = new M_projek2();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/kelas')->with('error', 'ID kelas tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore kelas yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_kelas', ['id_kelas' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_kelas']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('kelas', $restoreData, ['id_kelas' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_kelas', ['id_kelas' => $id]);
    }

    return redirect()->to('home/kelas');
}
public function aksi_unedit_tugas()
{
    $model = new M_projek2();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/tugas')->with('error', 'ID tugas tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Merestore tugas yang diedit'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_tugas', ['id_tugas' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_tugas']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('tugas', $restoreData, ['id_tugas' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_tugas', ['id_tugas' => $id]);
    }

    return redirect()->to('home/tugas');
}
}

