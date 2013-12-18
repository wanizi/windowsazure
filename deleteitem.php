<?php
require_once "init.php";
$tableRestProxy->deleteEntity('tasks', $_GET['pk'], $_GET['rk']);
header('Location: index.php');
?>