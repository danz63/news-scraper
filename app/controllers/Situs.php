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
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor']]);

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
        $this->db->update('ekstraktor', ['situs_id' => $id], ['id' => $_POST['ekstraktor']]);

        setFlashData(['type' => 'success', 'msg' => 'Data situs berhasil diperbaharui']);
        redirect('situs/index');
    }

    public function scrap($id)
    {
        $situs = $this->db->getWhere('situs', ['id' => $id]);
        $ekstraktor = $this->db->getWhere('ekstraktor', ['situs_id' => $id]);

        $scrap = new Scraper();
        $json = $scrap->getList($situs['url']);

        $json = str_replace('\\/', '/', $json);
        $arrayLink = json_decode($json);

        $linksExist = $this->db->pluck('isi_berita', 'url');
        $arrayLink = array_diff($arrayLink, $linksExist);
        $_SESSION['links'] = array_values($arrayLink);
        $_SESSION['ekstraktor'] = $ekstraktor['lokasi'];
        redirect('scraper/index');
    }

    public function checkHandler()
    {
        $links = json_decode($_POST['links'], true);
        $response['msg'] = false;
        if (count(array_diff($links, $_SESSION['links'])) > 0) {
            $response['msg'] = true;
        }
        echo json_encode($response);
    }
}
