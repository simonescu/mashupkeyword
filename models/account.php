<?php
class Account extends AppModel {

	var $name = 'Account';
    var $displayField = 'username';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Lawmaker' => array('className' => 'Lawmaker',
								'foreignKey' => 'lawmaker_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Service' => array('className' => 'Service',
								'foreignKey' => 'service_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'ServiceType' => array('className' => 'ServiceType',
								'foreignKey' => 'service_type_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>
