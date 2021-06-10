<?php
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($_SESSION['username'])) {
            redirect('home/list');
        }
        view('home/index');
    }

    public function list($page = false)
    {
        $page = $page == false ? 1 : $page;
        $limit = ($page - 1) * 10;
        $query = "SELECT a.id, a.judul, a.waktu_publikasi, a.img, a.url, CONCAT(SUBSTRING(a.isi, 1, 256), ' ...') as sub_news, b.nama_situs FROM isi_berita a JOIN situs b ON a.situs_id=b.id ORDER BY a.id DESC LIMIT $limit, 10";
        $listNews = $this->db->query($query, 'get');
        $pagination = $this->db->query("SELECT COUNT(*) as pages FROM isi_berita", 'get');
        $pagination = ceil($pagination['pages'] / 10);
        $i = 0;
        foreach ($listNews as $news) {
            $parsingIsi = parseContent($listNews[$i]['sub_news']);
            $listNews[$i]['sub_news'] = $parsingIsi['isi'];
            $listNews[$i]['desc'] = $parsingIsi['desc'];
            $i++;
            unset($parsingIsi);
        }
        $data = [
            'news' => $listNews,
            'page' => $page,
            'pagination' => $pagination
        ];
        view('home/list', $data);
    }

    public function read($id = 0)
    {
        $query = "SELECT a.*, b.nama_situs FROM isi_berita a JOIN situs b ON a.situs_id=b.id WHERE a.id=$id";
        $content = $this->db->query($query, 'get');
        $parsingIsi = parseContent($content['isi']);
        $content['isi'] = $parsingIsi['isi'];
        $content['desc'] = $parsingIsi['desc'];
        unset($parsingIsi);
        $data = [
            'news' => $content
        ];
        view('home/read', $data);
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $rowData = $this->db->getWhere('user', [
                'username' => $_POST['username']
            ]);
            $password = $_POST['pwd'];
            if (!password_verify($password, $rowData['password'])) {
                echo "
                <script>
                    alert('Nama Pengguna Atau Kata Sandi Salah, Silahkan Coba Lagi');
                    window.history.back();
                </script>";
                exit;
            }
            $_SESSION['username'] = $rowData['username'];
            setFlashData(['type' => 'success', 'msg' => 'Login Berhasil']);
            redirect('home/index');
        }
        view('home/login');
    }

    public function password()
    {
        if (!isset($_SESSION['username'])) {
            redirect('home/list');
        }
        if (isset($_POST['submit'])) {
            $username = $_SESSION['username'];
            $rowData = $this->db->getWhere('user', [
                'username' => $username
            ]);
            $oldPass = $_POST['old_pass'];
            if (!password_verify($oldPass, $rowData['password'])) {
                setFlashData(['type' => 'danger', 'msg' => 'Sandi Lama Salah, Silahkan Coba Lagi!']);
                redirect('home/password');
            }
            $newPass = $_POST['new_pass'];
            $RePass = $_POST['repeat_pass'];
            if ($newPass !== $RePass) {
                setFlashData(['type' => 'danger', 'msg' => 'Sandi Baru Tidak Sesuai, Silahkan Coba Lagi']);
                redirect('home/password');
            }
            $update = $this->db->update('user', ['password' => password_hash($newPass, PASSWORD_DEFAULT)], ['username' => $username]);
            if ($update) {
                setFlashData(['type' => 'success', 'msg' => 'Sandi berhasil Diubah, Silahkan Login Ulang']);
                redirect('home/password');
            }
        }
        view('home/password');
    }

    public function log()
    {
        if (!isset($_SESSION['username'])) {
            redirect('home/list');
        }
        $query = "SELECT a.*, b.username, c.nama_situs FROM log a JOIN user b ON a.user_id=b.id JOIN situs c ON a.situs_id=c.id ORDER BY a.waktu DESC";
        $dataLog = $this->db->query($query, "get");
        $data = [
            'logs' => $dataLog
        ];
        view('home/log', $data);
    }

    public function logout()
    {
        if (!isset($_SESSION['username'])) {
            redirect('home/list');
        }
        unset($_SESSION['username']);
        redirect('home/login');
    }
}
