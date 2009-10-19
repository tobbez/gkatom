<?php
require_once("downloadhelper.inc.php");


$d = DownloadHelper::getInstance();

if($d->getCurrentLocal() < $d->getLatest()) {
  echo "New comics found; getting comics " . ($d->getCurrentLocal() + 1) . "-" . $d->getLatest() . "\n";
  for ($i = $d->getCurrentLocal() + 1; $i <= $d->getLatest(); $i++) {
    //echo "Downloading " . $i . "\n";
    $d->download($i);
    $d->setCurrentLocal($i);
  }
  echo "Update complete\n";
} else {
  echo "Up to date\n";
}


?>
