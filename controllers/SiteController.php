<?php

require_once('classes/BaseController.php');
require_once('models/News.php');
require_once('classes/BaseModel.php');

class SiteController extends BaseController {
	public function actionIndex() {
		$news = new News($this);
		//$news->findByPk(1);
		$newsList = $news->find(null, 'created_at desc', 10);
		//echo '<pre>';
		//var_dump($newsList);
		//echo '</pre>';
		$this->render('index', $newsList);
	}

	public function actionTeste() {
		echo 'Isto é um teste';
	}
}
?>