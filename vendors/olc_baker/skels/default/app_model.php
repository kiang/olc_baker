<?php

class AppModel extends Model {

    var $actsAs = array('Containable');
    var $recursive = -1;

    function checkUnique($data) {
        foreach ($data AS $key => $value) {
            if (empty($value)) {
                return false;
            }
            if ($this->id) {
                return!$this->hasAny(array(
                    'id !=' => $this->id, $key => $value,
                ));
            } else {
                return!$this->hasAny(array($key => $value));
            }
        }
    }

}