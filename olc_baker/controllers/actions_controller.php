<?php
class ActionsController extends AppController {

	var $name = 'Actions';

	function add($formId = null) {
	    if (!$formId) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect($this->referer());
		}
		if (!empty($this->data)) {
		    if(in_array($this->data['Action']['action'], array(
		        'index', 'view', 'admin_index', 'admin_add', 'admin_edit',
		    	'admin_view', 'admin_habtm_set',
		    )) || $this->Action->hasAny(array(
		        'form_id' => $formId,
		    	'action' => $this->data['Action']['action'],
		    ))) {
		        $this->Session->setFlash('介面名稱重複');
		    } else {
		        $this->data['Action']['form_id'] = $formId;
		        if(!empty($this->data['Action']['parameter'])) {
		            $this->data['Action']['parameters'] = serialize($this->data['Action']['parameter']);
		        }
		        unset($this->data['Action']['parameter']);
		        $this->Action->create();
		        if ($this->Action->save($this->data)) {
		            $this->Session->setFlash('資料已經儲存');
		            $this->redirect(array('controller' => 'forms', 'action'=>'view', $formId));
		        } else {
		            $this->Session->setFlash('資料儲存失敗，請重試');
		        }
		    }
		}
		$this->set('formId', $formId);
		$this->set('engines', $this->Action->getEngineList());
	}

	function delete($id = null) {
	    if (!$id || !$formId = $this->Action->field('form_id', array('Action.id' => $id))) {
			$this->Session->setFlash('請依據網頁指示操作');
			$this->redirect($this->referer());
		}
		if ($this->Action->del($id)) {
			$this->Session->setFlash('資料已經刪除');
			$this->redirect(array('controller' => 'forms', 'action'=>'view', $formId));
		}
	}

	function engine_form($formId, $engine) {
	    /*
	     * 取得可用欄位，自己的、belongsto 與 hasone
	     */
	    $form = $this->Action->Form->find('first', array(
	        'fields' => array('name', 'label'),
	        'conditions' => array('Form.id' => $formId),
	        'contain' => array(
	        	'Relationship' => array(
	                'fields' => array('id'),
	        		'conditions' => array(
	        			'Relationship.type' => array('bt', 'ho'),
	                ),
	                'TargetForm' => array(
	                    'fields' => array('name', 'label'),
	                    'FormField' => array(
	                    	'fields' => array('name', 'label', 'type'),
	                    	'order' => array('FormField.sort ASC'),
	                    ),
	                ),
	            ),
	            'FormField' => array(
	                'fields' => array('name', 'label', 'type'),
	                'order' => array('FormField.sort ASC'),
	            ),
	        ),
	    ));
	    $fields = $fieldTypes = array();
	    foreach($form['FormField'] AS $field) {
	        $key = Inflector::classify($form['Form']['name']) . '.' . $field['name'];
	        $fields[$key] = $form['Form']['label'] . '->' . $field['label'];
	        $fieldTypes[$key] = $field['type'];
	    }
	    foreach($form['Relationship'] AS $relationship) {
	        foreach($relationship['TargetForm']['FormField'] AS $field) {
	            $key = Inflector::classify($relationship['TargetForm']['name']) . '.' . $field['name'];
	            $fields[$key] = $relationship['TargetForm']['label'] . '->' . $field['label'];
	            $fieldTypes[$key] = $field['type'];
	        }
	    }
	    $this->set('fields', $fields);
	    $this->set('fieldTypes', $fieldTypes);
	    $this->set('content', $this->Action->getEngineContent($engine));
	}

}