<?php
class Group extends AppModel {
	var $name = 'Group';
	var $actsAs = array('Acl' => array('requester'));

	function parentNode() {
	    if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    $data = $this->data;
	    if (empty($this->data)) {
	        $data = $this->read();
	    }
	    if (!$data['Group']['parent_id']) {
	        return null;
	    } else {
	        return array('Group' => array('id' => $data['Group']['parent_id']));
	    }
	}
}