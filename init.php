<?php
require_once 'vendor\autoload.php';
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
$connectionString = "DefaultEndpointsProtocol=http;AccountName=tuto8storage1;AccountKey=6tekSFp3AKg8yOHB6F81a6l2Drbu2hMa+PiIPWkCWRC1vTvyyOVRMuxJEVFppr+cGA7NPq6hCWSGoanxqpsK5w==";
$tableRestProxy = ServicesBuilder::getInstance()->createTableService($connectionString);
?>