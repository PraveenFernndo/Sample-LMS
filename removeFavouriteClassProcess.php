<?php

$favourite_id=$_GET["i"];

require "connection.php";

Database::iud("delete from favourite where id='".$favourite_id."'");

echo "Successfully Removed";

?>