<?php
Library::import('recess.sources.db.orm.Model');

/**
 * !HasMany classes, Class: RecessReflectorClass, ForeignKey: packageId
 * !HasMany children, Class: RecessReflectorPackage, ForeignKey: parentId
 * !BelongsTo parent, Class: RecessReflectorPackage, ForeignKey: parentId
 * !Table packages
 */
class RecessReflectorPackage extends Model {
	
	/** !PrimaryKey integer, AutoIncrement: true */
	public $id;
	
	/** !Type text */
	public $name;
	
	/**
	 * !ForeignKey Table: packages
	 * !Type integer
	 */
	public $parentId;
	
	/**
	 * !Type integer
	 */
	public $modified;
	
	function childrenAlphabetically() {
		return $this->children()->orderBy('name ASC');
	}
	
	function __construct($name = '') {
		if($name != '') {
			$this->name = $name;
		}
	}
	
	function insert() {
		echo 'Inserting package: ' . $this->name . '<br />';
		parent::insert();
		
		$dotPosition = strrpos($this->name, Library::dotSeparator);
		
		if($dotPosition !== false) { 
			$parentName = substr($this->name, 0, $dotPosition);
			
			$parent = new RecessReflectorPackage($parentName);
			
			if(!$parent->exists()) {
				$parent->insert();
			}
			$this->setParent($parent);
		}
	}
	
}

?>