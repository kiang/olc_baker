<?php

return array(
    'acos' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'parent_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'model' => array(
            'type' => 'string',
            'null' => false,
            'length' => 64,
        ),
        'foreign_key' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'alias' => array(
            'type' => 'string',
            'default' => '',
            'length' => 128,
        ),
        'lft' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'rght' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
    ),
    'aros' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'parent_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'model' => array(
            'type' => 'string',
            'default' => '',
            'length' => 64,
        ),
        'foreign_key' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'alias' => array(
            'type' => 'string',
            'default' => '',
            'length' => 128,
        ),
        'lft' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'rght' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
    ),
    'aros_acos' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'aro_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'aco_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        '_create' => array(
            'type' => 'integer',
            'null' => false,
            'default' => 0,
            'length' => 2,
        ),
        '_read' => array(
            'type' => 'integer',
            'null' => false,
            'default' => 0,
            'length' => 2,
        ),
        '_update' => array(
            'type' => 'integer',
            'null' => false,
            'default' => 0,
            'length' => 2,
        ),
        '_delete' => array(
            'type' => 'integer',
            'null' => false,
            'default' => 0,
            'length' => 2,
        ),
    ),
    'members' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'group_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'username' => array(
            'type' => 'string',
            'null' => false,
            'length' => 64,
        ),
        'password' => array(
            'type' => 'string',
            'null' => false,
            'length' => 48,
        ),
        'user_status' => array(
            'type' => 'string',
            'null' => false,
            'default' => 'N',
            'length' => 1,
        ),
        'created' => array(
            'type' => 'datetime',
            'null' => false,
        ),
        'modified' => array(
            'type' => 'datetime',
            'null' => false,
        ),
    ),
    'groups' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'parent_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'name' => array(
            'type' => 'string',
            'null' => false,
            'length' => 64,
        ),
    ),
    'group_permissions' => array(
        'id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
            'key' => 'primary',
            'primary' => 'id',
        ),
        'parent_id' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'order' => array(
            'type' => 'integer',
            'null' => false,
            'length' => 11,
        ),
        'name' => array(
            'type' => 'string',
            'null' => false,
            'length' => 64,
        ),
        'description' => array(
            'type' => 'string',
            'null' => true,
            'length' => 255,
        ),
        'acos' => array(
            'type' => 'string',
            'null' => false,
            'length' => 255,
        ),
    ),
);