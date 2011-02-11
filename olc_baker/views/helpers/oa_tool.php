<?php

class OaToolHelper extends AppHelper {

    function relation_type($key) {
        switch ($key) {
            case 'bt':
                return 'has an ancestor (belongsTo)';
                break;
            case 'ho':
                return 'has a descendant (hasOne)';
                break;
            case 'hm':
                return 'has many descendants (hasMany)';
                break;
            case 'habtm':
                return 'many with many (hasAndBelongsToMany)';
                break;
        }
        return 'Unknown';
    }

    function relation_list() {
        return array(
            'bt' => $this->relation_type('bt'),
            'ho' => $this->relation_type('ho'),
            'hm' => $this->relation_type('hm'),
            'habtm' => $this->relation_type('habtm'),
        );
    }

}