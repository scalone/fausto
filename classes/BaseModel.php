<?php //namespace FatecFranca\ADS8N;

require_once('Attribute.php');

abstract class BaseModel {
	private $_attributes = [];  // Vetor vazio
	private $_controller;

	protected function addAttribute(
		$name,
				/*DataType*/ $dataType,
				$label,
				$length = null,
				$value = null
	) {
		$attr = new Attribute($name, $dataType, $label, $length, $value);
		$this->_attributes[$name] = $attr; //Adiciona o atributo ao vetor
	}

	abstract protected function initAttributes();
	abstract protected function getTableName(); // Nome da tabela
	abstract protected function getPkName();    // Nome do campo chave primária

	public function __construct($controller) {
		$this->initAttributes();
		$this->_controller = $controller;
	}

	public function getController() {
		return $this->_controller;
	}

	public function setAttrValue(string $attrName, $value) {
		//echo '***************', $attrName, '<br />';
		if(key_exists($attrName, $this->_attributes)) {
			$this->_attributes[$attrName]->setValue($value);
		}
	}

	public function getAttrValue(string $attrName) {
		if(key_exists($attrName, $this->_attributes)) {
			return $this->_attributes[$attrName]->getValue();
		}
		else {
			return NULL;
		}
	}

	/*
	 * Procura um registro no BD por chave primária
	 */
	public function findByPk($pkValue) {
		$db = $this->getController()->getApp()->getDb();
		$rows = $db->query("select * from {$this->getTableName()} where
	{$this->getPkName()} = '{$pkValue}'");

				/*
				echo "Consulta executada: ", "select * from {$this->getTableName()} where
				{$this->getPkName()} = '{$pkValue}'";

				echo "<pre>";*/

		if($rows) {
			foreach($rows as $row) {
				//var_dump($row);
				$fieldNames = array_keys($row);
				//var_dump($fieldNames);
				foreach($fieldNames as $fn) {
					$this->setAttrValue($fn, $row[$fn]);
				}
			}
		}

		//var_dump($this->_attributes);
		//echo "</pre>";
	}

	public function find($where = null, $orderBy = null, $limit = null) {
		$db = $this->getController()->getApp()->getDb();
		$sql = "select * from {$this->getTableName()}";

		if(isset($where)) {
			$sql .= ' where ' . $where;
		}

		if(isset($orderBy)) {
			$sql .= ' order by ' . $orderBy;
		}

		if(isset($limit)) {
			$sql .= ' limit ' . $limit;
		}

		//echo "<pre>";
		//echo "Consulta executada: ".$sql;
		//echo "</pre>";

		$rows = $db->query($sql);

		//echo '<pre>';
		//var_dump($rows);
		//echo '</pre>';

		// Não encontrou nenhum registro
		if(! $rows) {
			return null;
		}

		// Se encontrou registros
		$instances = []; // Vetor vazio

		// Obtém o nome real da classe do modelo
		$className = get_class($this);

		foreach($rows as $row) {

			// Cria uma nova instância do modelo
			$instance = new $className($this->getController());

			// Preenche os valores dos atributos da nova instância
			// com os valores do registro correspondente no banco de dados
			$fieldNames = array_keys($row);
			foreach($fieldNames as $fn) {
				$instance->setAttrValue($fn, $row[$fn]);
			}

			// Adiciona a instância à coleção que será retornada
			$instances[] = $instance;
		}

		return $instances;
	}
}
?>
