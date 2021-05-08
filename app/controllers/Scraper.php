<?php
class Scraper extends Controller
{
    public function cURL($url = '')
    {
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
        return json_encode($listHref, JSON_PRETTY_PRINT);
    }

    public function getHref($html = '', $url = '')
    {
        $url = str_replace('/', '\\/', $url);
        if (!strpos($url, 'pikiran-rakyat')) {
            $url = $url . "read";
        }
        $regex = '/<a.+?href="(.*?' . $url . '.*?)"/';
        preg_match_all($regex, $html, $match);
        return array_values(array_unique($match[1]));
    }

    public function getContent($index = "")
    {
        if (isset($_POST['json'])) {
            return $this->insert($_POST['json']);
        }
        $result = $this->cURL($_SESSION['links'][$index]);
        echo $result;
        echo "<script src='" . url($_SESSION['ekstraktor']) . "'></script>";
    }

    public function index()
    {
        $data = [
            'ekstraktor' => $_SESSION['ekstraktor']
        ];
        // unset($_SESSION['ekstraktor']);
        view('scraper/index', $data);
    }

    public function insert($json = '')
    {
        $json = preg_replace('/<a.*?>(.*?)<\/a>/', '$1', $json);
        $result = json_decode($json, true);
        $isi_berita = $this->parseIsiBerita($result['photo_detail'], $result['article_text']);
        $indexLink = explode('/', $_GET['url']);
        $indexLink = end($indexLink);
        $url = $_SESSION['links'][$indexLink];
        unset($_SESSION['links'][$indexLink]);
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
