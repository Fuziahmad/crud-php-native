<?php
session_start();
session_unset();
session_destroy();

setcookie("YGD232SA","",time()-3600);
setcookie("key","",time()-3600);

header("Location: login.php");
?>