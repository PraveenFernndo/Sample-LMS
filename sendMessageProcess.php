<?php

require "connection.php";
$msg = $_POST["mt"];
$message_id = $_POST["message_id"];
if (!empty($msg) && !empty($message_id)) {
    Database::iud("update messages set reply='" . $msg . "' where id='" . $message_id . "'");
    echo "Success";
}

