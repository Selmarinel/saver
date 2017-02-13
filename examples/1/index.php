<?php
require_once "../../vendor/autoload.php";
$service = new \Saver\Saver(new \Saver\Services\Upload\CurlUploadService( new \Saver\Services\Files\LocalFile()));
$service->saveFromUrl($_POST['url']);
?>
<form method="post">
    <input type="text" name="url" value="<?=$_POST['url']?>">
    <input type="submit">
</form>