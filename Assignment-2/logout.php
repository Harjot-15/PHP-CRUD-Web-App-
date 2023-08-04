<?php
session_start();
session_destroy();
header("Location: Index.html");
exit();
?>
