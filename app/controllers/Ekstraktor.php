<?php
class Ekstraktor extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['ekstraktor'] = $this->db->get('ekstraktor');
        if ($index = getIndex()) {
            $data += ['byId' => $this->db->getWhere('ekstraktor', ['id' => $index])];
        }
        view('ekstraktor/index', $data);
    }

    public function create()
    {
        if (!isset($_POST['filename']) || !isset($_FILES['ekstraktor']) || !isset($_POST['info'])) {
            redirect('ekstraktor/index');
        }
        $file = $_FILES['ekstraktor'];
        if ($file['type'] != 'text/javascript') {
            setFlashData(['type' => 'danger', 'msg' => 'File bukan script javascript']);
            redirect('ekstraktor/index');
        }
        $ekstensi = explode('.', $file['name']);
        $ekstensi = end($ekstensi);
        $nama = $_POST['filename'] . '.' . $ekstensi;
        $path = 'upload/' . $nama;
        if (!move_uploaded_file($file['tmp_name'], $path)) {
            setFlashData(['type' => 'danger', 'msg' => 'Upload file gagal']);
            redirect('ekstraktor/index');
        }
        $data = [
            'nama' => $nama,
            'lokasi' => $path,
            'info' => $_POST['info']
        ];
        if ($this->db->insert('ekstraktor', $data)) {
            setFlashData(['type' => 'success', 'msg' => 'Data ekstraktor berhasil ditambahkan']);
            redirect('ekstraktor/index');
        }
        setFlashData(['type' => 'danger', 'msg' => 'Data ekstraktor gagal ditambahkan']);
        redirect('ekstraktor/index');
    }

    public function update()
    {
        if (!isset($_POST['filename']) || !isset($_POST['info'])) {
            redirect('ekstraktor/index');
        }
        if (isset($_FILES['ekstraktor'])) {
            $path = $this->db->getWhere('ekstraktor', ['id' => getIndex()])['lokasi'];
            if (file_exists($path)) {
                unlink($path);
            }
            $file = $_FILES['ekstraktor'];
            if ($file['type'] != 'text/javascript') {
                setFlashData(['type' => 'danger', 'msg' => 'File bukan script javascript']);
                redirect('ekstraktor/index');
            }
            $ekstensi = explode('.', $file['name']);
            $ekstensi = end($ekstensi);
            $nama = $_POST['filename'] . '.' . $ekstensi;
            $path = 'upload/' . $nama;
            if (!move_uploaded_file($file['tmp_name'], $path)) {
                setFlashData(['type' => 'danger', 'msg' => 'Upload file gagal']);
                redirect('ekstraktor/index');
            }
        }
        $data = [
            'nama' => $nama,
            'lokasi' => $path,
            'info' => $_POST['info']
        ];
        if ($this->db->update('ekstraktor', $data, ['id' => getIndex()])) {
            setFlashData(['type' => 'success', 'msg' => 'Data ekstraktor berhasil diperbaharui']);
            redirect('ekstraktor/index');
        }
        setFlashData(['type' => 'danger', 'msg' => 'Data ekstraktor gagal diperbaharui']);
        redirect('ekstraktor/index');
    }
}
