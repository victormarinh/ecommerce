<?php 

require_once("vendor/autoload.php");

use Slim\Slim;
use Hcode\Page;
use Hcode\PageAdmin;
use Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");

	//$_SERVER["DOCUMENT_ROOT"];
});


$app->get('/admin', function() {

	$pageAdmin = new PageAdmin();

	$pageAdmin->setTpl("index");

});

$app->get('/admin/login', function() {

	$pageAdmin = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$pageAdmin->setTpl("login");
});

$app->post('/admin/login', function() {

	User::login($_POST['login'], $_POST['password']);

	header("Location: /admin");
	exit;
});

$app->run();

 ?>