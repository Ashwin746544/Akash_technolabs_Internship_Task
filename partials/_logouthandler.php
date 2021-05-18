<?php

session_start();
session_unset();
session_destroy();
$logout=true;


header("location:/forum/index.php?logout=$logout");


?>