<?php //namespace FatecFranca\ADS8N;

class DataType /* extends SplEnum */ {
	const INTEGER = 0;
	const STRING = 1;
	const DATE_TIME = 2;
}

class Attribute {

	private $_name;
	private $_dataType;
	private $_length;
	private $_label;
	private $_value;

	public function __construct(
		string $name,
				/*DataType*/ $dataType,
				string $label,
				int $length = null,
				$value = null
	) {
		$this->_name = $name;
		$this->_dataType = $dataType;
		$this->_length = $length;
		$this->_label = $label;
		$this->_value = $value;
	}

	public function setValue($value) {
		$this->_value = $value;
	}

	public function getValue() {
		return $this->_value;
	}
}
?>