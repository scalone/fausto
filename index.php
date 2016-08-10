<?php
if (false)
	echo "AASDASDAS";
else
	echo 'FHFHFHHFH';
?>

<?php
//$servername = "localhost";
$servername = "localhost:/tmp/mysql.sock";
$username = "root";
$password = "";
$dbname = "news";

$link = mysql_connect($servername, $username, $password);
if (!$link) {
	die('Não foi possível conectar: ' . mysql_error());
}
echo 'Conexão bem sucedida';
mysql_close($link);
?>