<?php
require_once "../../vendor/autoload.php";
$service = new \Saver\Saver(new \Saver\Services\Upload\CurlUploadService( new \Saver\Services\Files\LocalFile()));
$service->saveFromUrl((isset($_POST['url'])?$_POST['url']:""),"/var/www");
?>
<form method="post">
    <input type="text" name="url" value="<?=(isset($_POST['url'])?$_POST['url']:"")?>">
    <input type="submit">
</form>