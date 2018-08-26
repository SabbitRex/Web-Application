<?php
session_start();
echo json_encode($_SESSION["start_time"]);

//date_default_timezone_set("asia/kolkata");
//echo date("M d, Y H:i:s");
?>