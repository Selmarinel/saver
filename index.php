<?php

require_once "vendor/autoload.php";

$service = new \Saver\Services\CurlUploadService($_POST['url']);
$service->uploadFile();


?>
<form method="post">
    <input type="text" name="url" value="<?=$_POST['url']?>">
    <input type="submit">
</form>
