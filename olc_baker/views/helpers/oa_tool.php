<?php
class OaToolHelper extends AppHelper {
    function relation_type($key) {
        switch($key) {
            case 'bt':
                return '屬於 (belongsTo)';
                break;
            case 'ho':
                return '一對一 (hasOne)';
                break;
            case 'hm':
                return '一對多 (hasMany)';
                break;
            case 'habtm':
                return '多對多 (hasAndBelongsToMany)';
                break;
        }
        return '未知';
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