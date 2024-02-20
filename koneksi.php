<?php
# Konek ke Web Database
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "";
$myDbs	= "kamsir";

$koneksidb = mysqli_connect( $myHost, $myUser, $myPass, $myDbs);
if ($koneksidb) {
  echo "";
}

?>