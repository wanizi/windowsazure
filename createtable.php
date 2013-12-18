<?php
require_once "init.php";

try {
     $tableRestProxy->createTable('tasks');
}
catch(ServiceException $e) {
     $code = $e->getCode();
     $error_message = $e->getMessage();
     echo $code.": ".$error_message."<br />";
}
?>