<?php

require_once "../vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR);
$dotenv->load();
$path = null;
$name = null;

$service = new \Saver\Saver(new \Saver\Services\Upload\CurlUploadService( new \Saver\Services\Files\LocalFile()));
$service->saveFromUrl($_POST['url'], $path , $name);

?>
<form method="post">
    <input type="text" name="url" value="<?=$_POST['url']?>">
    <input type="submit">
</form>