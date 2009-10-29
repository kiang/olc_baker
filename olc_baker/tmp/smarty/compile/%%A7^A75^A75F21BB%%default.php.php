<?php /* Smarty version 2.6.22, created on 2009-10-29 22:42:19
         compiled from default/controllers/default.php */ ?>
<?php echo '<?php'; ?>

class <?php echo $this->_tpl_vars['controllerName']; ?>
Controller extends AppController {

    var $name = '<?php echo $this->_tpl_vars['controllerName']; ?>
';
    var $helpers = array(<?php if ($this->_tpl_vars['uploads']): ?>'Upload',<?php endif; ?>);

<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] ) || isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
    function index($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
        $foreignKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => '<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        );
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
        $habtmKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => '<?php echo $this->_tpl_vars['rOption']['associationForeignKey']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);
<?php endif; ?>
        $scope = array();
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['<?php echo $this->_tpl_vars['modelName']; ?>
.' . $foreignKeys[$foreignModel]] = $foreignId;
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
            $joins = array(
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
                '<?php echo $this->_tpl_vars['rModel']; ?>
' => array(
                    0 => array(
                    	'table' => '<?php echo $this->_tpl_vars['rOption']['joinTable']; ?>
',
                    	'alias' => '<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
',
                    	'type' => 'inner',
                    	'conditions'=> array('<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
 = <?php echo $this->_tpl_vars['modelName']; ?>
.id'),
                    ),
                    1 => array(
                    	'table' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
',
                    	'alias' => '<?php echo $this->_tpl_vars['rModel']; ?>
',
                    	'type' => 'inner',
                    	'conditions'=> array('<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
.<?php echo $this->_tpl_vars['rOption']['associationForeignKey']; ?>
 = <?php echo $this->_tpl_vars['rModel']; ?>
.id'),
                    ),
                ),
<?php endforeach; endif; unset($_from); ?>
            );
            if(array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['<?php echo $this->_tpl_vars['modelName']; ?>
.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
']['joins'] = $joins[$foreignModel];
            }
<?php endif; ?>
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
']['limit'] = 20;
        $items = $this->paginate($this-><?php echo $this->_tpl_vars['modelName']; ?>
, $scope);
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }
<?php else: ?>
    function index() {
        $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this-><?php echo $this->_tpl_vars['modelName']; ?>
));
    }
<?php endif; ?>

    function view($id = null) {
        if (!$id || !$this->data = $this-><?php echo $this->_tpl_vars['modelName']; ?>
->read(null, $id)) {
            $this->Session->setFlash(__('Please do following the links in the page', true));
            $this->redirect(array('action'=>'index'));
        }
    }

<?php echo $this->_tpl_vars['customMethods']; ?>


<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] ) || isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
        $foreignKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => '<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        );
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
        $habtmKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => '<?php echo $this->_tpl_vars['rOption']['associationForeignKey']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);
<?php endif; ?>
        $scope = array();
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['<?php echo $this->_tpl_vars['modelName']; ?>
.' . $foreignKeys[$foreignModel]] = $foreignId;
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
            $joins = array(
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
                '<?php echo $this->_tpl_vars['rModel']; ?>
' => array(
                    0 => array(
                    	'table' => '<?php echo $this->_tpl_vars['rOption']['joinTable']; ?>
',
                    	'alias' => '<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
',
                    	'type' => 'inner',
                    	'conditions'=> array('<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
.<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
 = <?php echo $this->_tpl_vars['modelName']; ?>
.id'),
                    ),
                    1 => array(
                    	'table' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['table_name']; ?>
',
                    	'alias' => '<?php echo $this->_tpl_vars['rModel']; ?>
',
                    	'type' => 'inner',
                    	'conditions'=> array('<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
.<?php echo $this->_tpl_vars['rOption']['associationForeignKey']; ?>
 = <?php echo $this->_tpl_vars['rModel']; ?>
.id'),
                    ),
                ),
<?php endforeach; endif; unset($_from); ?>
            );
            if(array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['<?php echo $this->_tpl_vars['modelName']; ?>
.' . $foreignKeys[$foreignModel]]);
                if($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
']['joins'] = $joins[$foreignModel];
                }
            }
<?php endif; ?>
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
']['limit'] = 20;
        $items = $this->paginate($this-><?php echo $this->_tpl_vars['modelName']; ?>
, $scope);
<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
        if($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach($items AS $key => $item) {
                $items[$key]['option'] = $this-><?php echo $this->_tpl_vars['modelName']; ?>
->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        '<?php echo $this->_tpl_vars['modelName']; ?>
.id' => $item['<?php echo $this->_tpl_vars['modelName']; ?>
']['id'],
                        $foreignModel.'.id' => $foreignId,
                    ),
                ));
                if($items[$key]['option'] > 0) {
                    $items[$key]['option'] = 1;
                }
            }
            $this->set('op', $op);
        }
<?php endif; ?>
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }
<?php else: ?>
    function admin_index() {
        $this->paginate['<?php echo $this->_tpl_vars['modelName']; ?>
'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this-><?php echo $this->_tpl_vars['modelName']; ?>
));
    }
<?php endif; ?>

    function admin_view($id = null) {
        if (!$id || !$this->data = $this-><?php echo $this->_tpl_vars['modelName']; ?>
->read(null, $id)) {
            $this->Session->setFlash(__('Please do following the links in the page', true));
            $this->redirect(array('action'=>'index'));
        }
    }

<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
    function admin_add($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => '<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
',
<?php endforeach; endif; unset($_from); ?>
        );
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            if (!empty($this->data)) {
                $this->data['<?php echo $this->_tpl_vars['modelName']; ?>
'][$foreignKeys[$foreignModel]] = $foreignId;
            }
        } else {
            $foreignModel = '';
        }
        if (!empty($this->data)) {
            $this-><?php echo $this->_tpl_vars['modelName']; ?>
->create();
            if ($this-><?php echo $this->_tpl_vars['modelName']; ?>
->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.<?php echo $this->_tpl_vars['modelName']; ?>
');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.data', $this->data);
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.validationErrors', $this-><?php echo $this->_tpl_vars['modelName']; ?>
->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }
<?php else: ?>
    function admin_add() {
        if (!empty($this->data)) {
            $this-><?php echo $this->_tpl_vars['modelName']; ?>
->create();
            if ($this-><?php echo $this->_tpl_vars['modelName']; ?>
->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.<?php echo $this->_tpl_vars['modelName']; ?>
');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.data', $this->data);
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.validationErrors', $this-><?php echo $this->_tpl_vars['modelName']; ?>
->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }
<?php endif; ?>

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following the links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this-><?php echo $this->_tpl_vars['modelName']; ?>
->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.<?php echo $this->_tpl_vars['modelName']; ?>
');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.data', $this->data);
                $this->Session->write('form.<?php echo $this->_tpl_vars['modelName']; ?>
.validationErrors', $this-><?php echo $this->_tpl_vars['modelName']; ?>
->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this-><?php echo $this->_tpl_vars['modelName']; ?>
->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if($sessionFormData = $this->Session->read('form.<?php echo $this->_tpl_vars['modelName']; ?>
.data')) {
            $this-><?php echo $this->_tpl_vars['modelName']; ?>
->validationErrors = $this->Session->read('form.<?php echo $this->_tpl_vars['modelName']; ?>
.validationErrors');
            $this->Session->delete('form.<?php echo $this->_tpl_vars['modelName']; ?>
');
        }
        if($id > 0) {
            $this->data = $this-><?php echo $this->_tpl_vars['modelName']; ?>
->read(null, $id);
            if(!empty($sessionFormData['<?php echo $this->_tpl_vars['modelName']; ?>
'])) {
                foreach($sessionFormData['<?php echo $this->_tpl_vars['modelName']; ?>
'] AS $key => $val) {
                    if(isset($this->data['<?php echo $this->_tpl_vars['modelName']; ?>
'][$key])) {
                        $this->data['<?php echo $this->_tpl_vars['modelName']; ?>
'][$key] = $val;
                    }
                }
            }
        } else if(!empty($sessionFormData)) {
            $this->data = $sessionFormData;
        }

        $this->set('id', $id);
        $this->set('foreignModel', $foreignModel);
<?php if (isset ( $this->_tpl_vars['relationships']['belongsTo'] )): ?>
        $belongsToModels = array(
<?php $_from = $this->_tpl_vars['relationships']['belongsTo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            'list<?php echo $this->_tpl_vars['rModel']; ?>
' => array(
                'label' => '<?php echo $this->_tpl_vars['models'][$this->_tpl_vars['rOption']['className']]['label']; ?>
',
                'modelName' => '<?php echo $this->_tpl_vars['rModel']; ?>
',
                'foreignKey' => '<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
',
            ),
<?php endforeach; endif; unset($_from); ?>
        );

        foreach($belongsToModels AS $key => $model) {
            if($foreignModel == $model['modelName']) {
                unset($belongsToModels[$key]);
                continue;
            }
            $this->set($key, $this-><?php echo $this->_tpl_vars['modelName']; ?>
->$model['modelName']->find('list'));
        }
        $this->set('belongsToModels', $belongsToModels);
<?php endif; ?>
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following the links in the page', true));
        } else if ($this-><?php echo $this->_tpl_vars['modelName']; ?>
->del($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action'=>'index'));
    }

<?php if (isset ( $this->_tpl_vars['relationships']['hasAndBelongsToMany'] )): ?>
    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
<?php $_from = $this->_tpl_vars['relationships']['hasAndBelongsToMany']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rModel'] => $this->_tpl_vars['rOption']):
?>
            '<?php echo $this->_tpl_vars['rModel']; ?>
' => array(
                'associationForeignKey' => '<?php echo $this->_tpl_vars['rOption']['associationForeignKey']; ?>
',
                'foreignKey' => '<?php echo $this->_tpl_vars['rOption']['foreignKey']; ?>
',
                'alias' => '<?php echo $this->_tpl_vars['htbtmModels'][$this->_tpl_vars['modelName']][$this->_tpl_vars['rOption']['className']]; ?>
',
            ),
<?php endforeach; endif; unset($_from); ?>
        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if(empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', '參數有誤');
        } else {
            $habtmModel = &$this-><?php echo $this->_tpl_vars['modelName']; ?>
->$habtmKeys[$foreignModel]['alias'];
            $conditions = array(
                $habtmKeys[$foreignModel]['associationForeignKey'] => $foreignId,
                $habtmKeys[$foreignModel]['foreignKey'] => $id,
            );
            $status = ($habtmModel->find('count', array(
                'conditions' => $conditions,
            ))) ? 'on' : 'off';
            if($status == $switch) {
                $this->set('habtmMessage', '操作重複');
            } else if($switch == 'on') {
                $habtmModel->create();
                if($habtmModel->save(array($habtmKeys[$foreignModel]['alias'] => $conditions))) {
                    $this->set('habtmMessage', '已更新');
                } else {
                    $this->set('habtmMessage', '更新失敗');
                }
            } else {
                if($habtmModel->deleteAll($conditions)) {
                    $this->set('habtmMessage', '已更新');
                } else {
                    $this->set('habtmMessage', '更新失敗');
                }
            }
        }
    }
<?php endif; ?>
}