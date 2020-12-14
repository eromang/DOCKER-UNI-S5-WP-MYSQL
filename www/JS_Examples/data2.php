<?php
 header("Content-Type: application/json");
 $s = <<< EOT
{
  "name" : "Volker",
  "email" : "vm@uni.lu",
  "classes" : [ "SE", "WP", "JavaEE"]
}
EOT;
 print ($s);
?>