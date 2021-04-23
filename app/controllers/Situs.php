<?php
class Situs extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data = [
            'sites' => $this->db->get('situs')
        ];
        view('situs/index', $data);
    }


    public function add()
    {
        $data = [
            'ekstraktor' => $this->db->get('ekstraktor')
        ];
        view('situs/add', $data);
    }


    public function create()
    {
        $data = [
            'nama_situs' => $_POST['nama_situs'],
            'url' => $_POST['url']
        ];
        // Insert data situs
        $id = $this->db->insert('situs', $data, true)['last_insert_id()'];

        // update data ekstaktor (kolom situs_id)
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor1']]);
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor2']]);

        setFlashData(['type' => 'success', 'msg' => 'Data situs berhasil ditambahkan']);
        redirect('situs/index');
    }

    public function edit($id)
    {
        $data = [
            'situs' => $this->db->query("SELECT * FROM situs WHERE id=$id", 'get'),
            'ekstraktor' => $this->db->get('ekstraktor')
        ];
        view('situs/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_situs' => $_POST['nama_situs'],
            'url' => $_POST['url']
        ];
        // Insert data situs
        $this->db->update('situs', $data, ['id' => $id]);

        // update data ekstaktor (kolom situs_id)
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor1']]);
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor2']]);

        setFlashData(['type' => 'success', 'msg' => 'Data situs berhasil diperbaharui']);
        redirect('situs/index');
    }
}
