<?php
session_start();
if( isset($_SESSION['usuario']) )
{
session_destroy();
echo '  <script>
			location.href="../visao/form_login.php";
		</script>';
}
?>