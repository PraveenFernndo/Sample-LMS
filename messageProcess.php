<?php
require "connection.php";

Database::iud("update messages set status='1' where id='".$_GET["i"]."'");

?>