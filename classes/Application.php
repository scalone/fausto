<?php //namespace FatecFranca\ADS8N;

class Application {

	private $_configSet; // Conjunto de configurações
	private $_params; // Parâmetros do conjunto de configurações
	private $_dbConnection = null; // Conexão ao BD

	public function __construct($configSet) {
		$this->_configSet = $configSet;
		$this->_params = $this->getParams();
	}

	private function getParams() {
		return include("config/{$this->_configSet}.php");
	}

	public function getParam($paramName) {
		return $this->_params[$paramName];
	}

	private function connectDb() {

		$this->_dbConnection = new PDO(
			"mysql:host={$this->getParam('db_host')};
		port={$this->getParam('db_port')};
		dbname={$this->getParam('db_schema')};charset=utf8",
			$this->getParam('db_user'), $this->getParam('db_password'));
	}

	public function getDb() {
		// Conecta ao BD se ainda não estiver conectado
		if(! isset($this->_dbConnection)) {
			$this->connectDb();
		}
		return $this->_dbConnection;
	}

	public function returnImage( $path ) {
		header( 'Content-Type: image/' . substr($path, -3) );
		header( 'Content-Length: ' . filesize( $path ) );
		readfile( $path );
		exit;
	}


	/*
	 * Função responsável por executar a aplicação, determinando
	 * qual controller e qual action serão acionados a partir
	 * dos parâmetros passados na URL
	 */
	public function run() {

				/*
				$this->connectDb();

				$result = $this->_dbConnection->query('select * from tb_user');
				echo '<pre>';
				foreach($result as $row)  {
						var_dump($row);
				}
				echo '</pre>';
				 */
		//$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER["REQUEST_URI"];
		//$uri = $_SERVER["REQUEST_URI"];
		$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER["REQUEST_URI"];

		if (isset($_SERVER['QUERY_STRING'])) {
			$queryString = $_SERVER['QUERY_STRING'];
		} else {
			$queryString = '';
		}

		if (file_exists($path) && is_file($path) && substr($_SERVER["REQUEST_URI"], 1, 7) == '_images')  {
			$this->returnImage($path);
		}

		//$queryString = $_SERVER["REQUEST_URI"];

		// Controller e action padrões
		if($queryString == '') {
			$controller = ucfirst($this->getParam('default_controller'));
			$action = 'action' . ucfirst($this->getParam('default_action'));
		}
		else {
			// Cria um vetor com as diferentes partes da query string
			$parts = explode('/', $queryString);

			switch(count($parts)) {
			case 1: // Apenas o controller
				$controller = ucfirst($parts[0]);
				$action = 'action' . ucfirst($this->getParam('default_action'));
				break;

			case 2: // Controller/action
				$controller = ucfirst($parts[0]);
				$action = 'action' . ucfirst($parts[1]);
				break;

			}
		}

		// Carrega o arquivo da classe do controller
		$classFilename = "controllers/{$controller}Controller.php";
		if(is_file($classFilename)) {
			require_once("controllers/{$controller}Controller.php");
		}
		else {
			// Arquivo do controller não encontrado
			header('HTTP/1.0 404 Not Found');
			exit(1);
		}

		// Cria o controller
		$controllerClassName = $controller . 'Controller';

		// Classe do controller não encontrada no arquivo
		if(!class_exists($controllerClassName)) {
			header('HTTP/1.0 404 Not Found');
			exit(1);
		}

		$c = new $controllerClassName($this);

		// Método da action não encontrado no controller
		if(!method_exists($c, $action)) {
			header('HTTP/1.0 404 Not Found');
			exit(1);
		}

		// Invoca a action dentro do controller
		$c->$action();

	}
}
?>