<html>
<head>
  <title>File list</title>
</head>
<body>
  <?php
    foreach(glob("*.jpg") as $fn) {
      echo '<a href="' . $fn . '">' . $fn . "</a><br>\n";
    }
  ?>
</body>
</html>
