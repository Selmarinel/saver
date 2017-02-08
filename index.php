<?php

require_once "vendor/autoload.php";

$service = new \Saver\SaverController();
$service->saveFile($_POST['url']);


?>
<form method="post">
    <input type="text" name="url" value="<?=$_POST['url']?>">
    <input type="submit">
</form>
