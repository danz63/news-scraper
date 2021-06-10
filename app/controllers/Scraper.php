<?php
class Scraper extends Controller
{
    public function cURL($url = '')
    {
        if (!isset($_SESSION['username'])) {
            redirect('home/list');
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($statusCode != 200) {
            echo "Status Request Gagal " . $statusCode;
            curl_close($curl);
            die;
        }
        curl_close($curl);
        return $result;
    }

    public function getList($url = '')
    {
        $response = $this->cURL($url);
        $listHref = $this->getHref($response, $url);
        return $listHref;
    }

    public function getHref($html = '', $url = '')
    {
        if (substr($url, -1) != '/') {
            $url = $url . "/";
        }
        $url = str_replace('/', '\\/', $url);
        if (!strpos($url, 'pikiran-rakyat')) {
            $url = $url . "read";
        }
        $regex = '/<a.+?href="(.*?' . $url . '.*?)"/';
        preg_match_all($regex, $html, $match);
        // var_dump($url);
        // die;
        return array_values(array_unique($match[1]));
    }

    public function getContent($index = "")
    {
        if (isset($_POST['json'])) {
            $url = $_SESSION['links'][$index];
            unset($_SESSION['links'][$index]);
            return $this->insert($_POST['json'], $url);
        }
        $result = $this->cURL($_SESSION['links'][$index]);


        if (strpos($result, '<h1 class="title-premium">')) {
            unset($_SESSION['links'][$index]);
            echo "<script>window.close();</script>";
        }
        echo $result;
        echo "<script src='" . url($_SESSION['ekstraktor']) . "'></script>";
    }

    public function index()
    {
        $data = [
            'ekstraktor' => $_SESSION['ekstraktor']
        ];
        if (count($_SESSION['links']) < 1) {
            unset($_SESSION['ekstraktor']);
            $user_id = $this->db->getWhere('user', ['username' => $_SESSION['username']])['id'];
            $this->db->insert('log', [
                'user_id' => $user_id,
                'situs_id' => $_SESSION['situs_id']
            ]);
            unset($_SESSION['situs_id']);
            redirect('situs/index');
        }
        view('scraper/index', $data);
    }

    public function insert($json = '', $url)
    {
        // menghapus anchor
        $json = preg_replace('/<a.*?>(.*?)<\/a>/', '$1', $json);

        $result = json_decode($json, true);

        // Menambahkan tag small untuk penanda detail foto
        $isi_berita = $this->parseIsiBerita($result['photo_detail'], $result['article_text']);
        $isi_berita = str_replace('"', '\"', $isi_berita);
        $result['title'] = str_replace('"', '\"', $result['title']);

        preg_match('/(https:\/\/.*?\.com)/', $url, $match);
        $situs_id = $this->db->query("SELECT id FROM situs WHERE url LIKE '%{$match[0]}%'", 'get')['id'];
        $data = [
            'judul' => $result['title'],
            'waktu_publikasi' => $result['read_time'],
            'img' => $result['photo_src'],
            'isi' => $isi_berita,
            'situs_id' => $situs_id,
            'url' => $url
        ];
        $this->db->insert('isi_berita', $data);
        echo "<script>window.close();</script>";
    }

    public function parseIsiBerita($img_info, $article_text)
    {
        return "<small class=\'img-info\'>{$img_info}</small>
            {$article_text}";
    }
}
