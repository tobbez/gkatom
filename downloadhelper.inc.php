<?php
class DownloadHelper {
  private static $instance;

  private $cache_fp;

  public function __construct() {
  }

  public static function getInstance() {
    if(!self::$instance)
      self::$instance = new DownloadHelper();

    return self::$instance;
  }

  public function getCurrentLocal() {
    $tmparr = file("latest.txt");
    if($tmparr == FALSE) return 1;
    $cnt = (int) $tmparr[0];
    return $cnt;
  }

  public function setCurrentLocal($val) {
    file_put_contents("latest.txt", $val);
  }

  private function fetchFrontpage() {
    if(!$this->cache_fp)
      $this->cache_fp = implode("\n", file("http://www.gunnerkrigg.com/index2.php"));
  }

  public function getLatest() {
    $this->fetchFrontpage();
    preg_match('#http://www.gunnerkrigg.com//comics/([0-9]{8}).jpg#', $this->cache_fp, $match);
    return (int) ltrim($match[1], '0');
  }

  public function download($id) {
    $n = str_pad((string)$id, 8, "0", STR_PAD_LEFT);
    $ch = curl_init("http://www.gunnerkrigg.com//comics/" . $n . ".jpg");
    $fp = fopen("img/" . $n . ".jpg", 'w');

    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if(curl_exec($ch) === false) {
      die("curl failed for comic $id: " . curl_error($ch) . "\n");
    }
    curl_close($ch);
    fclose($fp);
  }
}
?>
