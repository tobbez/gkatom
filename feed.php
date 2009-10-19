<?php header("Content-Type: application/rss+xml; charset=utf-8"); ?>
<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
  <channel>
   <title>Gunnerkrigg court (feed)</title>
   <link>http://wrya.net/services/comics/gunnerkrigg/</link>
   <description>Feed for http://www.gunnerkrigg.com/. Feed created by tobbez@ryara.net</description>
   <language>en</language>
   <lastBuildDate><?= date("r") ?></lastBuildDate>
   <pubDate><?= date("r") ?></pubDate>
   <atom:link href="http://wrya.net/services/comics/gunnerkrigg/feed.php" rel="self" type="application/rss+xml"/>

<?php
require_once("downloadhelper.inc.php");
$d = DownloadHelper::getInstance();

$to = $d->getCurrentLocal();
$from = $to - 19;

for($i = $to; $i >= $from; $i--) {
  $id = str_pad($i, 8, '0', STR_PAD_LEFT);
  ?>
  <item>
    <title>Gunnerkrigg Court <?= $i ?></title>
    <link>http://www.gunnerkrigg.com/archive_page.php?comicID=<?= $i ?></link>
    <description>
     <![CDATA[
      <img src="http://wrya.net/services/comics/gunnerkrigg/img/<?= $id ?>.jpg" />
     ]]>
    </description>
    <pubDate><?= date("r", filectime("img/$id.jpg")) ?></pubDate>
    <guid isPermaLink="false"><?= $i ?>-<?= md5($i) ?></guid>
  </item>
<?php
}
?>


  </channel>
</rss>
