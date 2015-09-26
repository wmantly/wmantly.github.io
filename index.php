<?php
header('Content-Type: text/html; charset=utf-8');
if(isset($_POST['pageURL'])){
	include('./' . $_POST['pageURL'] . '.html');
	exit;
}else if( !isset($_GET['page']) ){
	$_GET['page'] = '/home';
} 
include('./index.html');
?>
