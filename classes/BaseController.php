<?php
class BaseController {
	private $_app;

	public function getControllerName() {
		return strtolower(str_replace('Controller', '', get_class($this)));
	}

	public function render($view, $model) {
		$viewFilename = "views/{$this->getControllerName()}/$view.php";

		if(is_file($viewFilename)) {
			require_once($viewFilename);
		}
		else {
			throw new Exception("Arquivo de visualização '$viewFilename' não encontrado.");
		}
	}

	public function __construct($app) {
		$this->_app = $app;
	}

	public function getApp() {
		return $this->_app;
	}
}
?>
