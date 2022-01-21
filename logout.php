<!-- 
	 Author: Danny van Schijndel
	 -->
<?php
Session_start();
unset($_SESSION["ID"]); 
unset($_SESSION["USER_ID"]);
unset($_SESSION["PERM"]);
unset($_SESSION["USER_NAME"]);
unset($_SESSION["E-MAIL"]);
unset($_SESSION["STATUS"]);
unset($_SESSION["ROL"]);
Session_destroy();
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>