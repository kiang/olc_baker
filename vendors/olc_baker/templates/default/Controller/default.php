<?php

App::uses('AppController', 'Controller');

class //<{$controllerName}>Controller extends AppController {

    public $name = '//<{$controllerName}>';
    public $paginate = array();
    public $helpers = array(//<{if $uploads}>'Upload',//<{/if}>);

//<{if isset($relationships.belongsTo) || isset($relationships.hasAndBelongsToMany)}>

    function index($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();
//<{if isset($relationships.belongsTo)}>

        $foreignKeys = array(
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>

            '//<{$rModel}>' => '//<{$rOption.foreignKey}>',
//<{/foreach}>

            );
//<{/if}>

//<{if isset($relationships.hasAndBelongsToMany)}>

        $habtmKeys = array(
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>

            '//<{$rModel}>' => '//<{$rOption.associationForeignKey}>',
//<{/foreach}>

        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);
//<{/if}>

        $scope = array();
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['//<{$modelName}>.' . $foreignKeys[$foreignModel]] = $foreignId;
//<{if isset($relationships.hasAndBelongsToMany)}>

            $joins = array(
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>

                '//<{$rModel}>' => array(
                    0 => array(
                    	'table' => '//<{$rOption.joinTable}>',
                    	'alias' => '//<{$htbtmModels[$modelName][$rOption.className]}>',
                    	'type' => 'inner',
                    	'conditions'=> array('//<{$htbtmModels[$modelName][$rOption.className]}>.//<{$rOption.foreignKey}> = //<{$modelName}>.id'),
                    ),
                    1 => array(
                    	'table' => '//<{$models[$rOption.className].table_name}>',
                    	'alias' => '//<{$rModel}>',
                    	'type' => 'inner',
                    	'conditions'=> array('//<{$htbtmModels[$modelName][$rOption.className]}>.//<{$rOption.associationForeignKey}> = //<{$rModel}>.id'),
                    ),
                ),
//<{/foreach}>

            );
            if(array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['//<{$modelName}>.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['//<{$modelName}>']['joins'] = $joins[$foreignModel];
            }
//<{/if}>

        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['//<{$modelName}>']['limit'] = 20;
        $items = $this->paginate($this->//<{$modelName}>, $scope);
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }
//<{else}>


    function index() {
        $this->paginate['//<{$modelName}>'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this->//<{$modelName}>));
    }
//<{/if}>


    function view($id = null) {
        if (!$id || !$this->data = $this->//<{$modelName}>->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action'=>'index'));
        }
    }

//<{$customMethods}>


//<{if isset($relationships.belongsTo) || isset($relationships.hasAndBelongsToMany)}>

    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();
//<{if isset($relationships.belongsTo)}>

        $foreignKeys = array(
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>

            '//<{$rModel}>' => '//<{$rOption.foreignKey}>',
//<{/foreach}>

        );
//<{/if}>

//<{if isset($relationships.hasAndBelongsToMany)}>

        $habtmKeys = array(
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>

            '//<{$rModel}>' => '//<{$rOption.associationForeignKey}>',
//<{/foreach}>

        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);
//<{/if}>

        $scope = array();
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['//<{$modelName}>.' . $foreignKeys[$foreignModel]] = $foreignId;
//<{if isset($relationships.hasAndBelongsToMany)}>

            $joins = array(
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>

                '//<{$rModel}>' => array(
                    0 => array(
                    	'table' => '//<{$rOption.joinTable}>',
                    	'alias' => '//<{$htbtmModels[$modelName][$rOption.className]}>',
                    	'type' => 'inner',
                    	'conditions'=> array('//<{$htbtmModels[$modelName][$rOption.className]}>.//<{$rOption.foreignKey}> = //<{$modelName}>.id'),
                    ),
                    1 => array(
                    	'table' => '//<{$models[$rOption.className].table_name}>',
                    	'alias' => '//<{$rModel}>',
                    	'type' => 'inner',
                    	'conditions'=> array('//<{$htbtmModels[$modelName][$rOption.className]}>.//<{$rOption.associationForeignKey}> = //<{$rModel}>.id'),
                    ),
                ),
//<{/foreach}>

            );
            if(array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['//<{$modelName}>.' . $foreignKeys[$foreignModel]]);
                if($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['//<{$modelName}>']['joins'] = $joins[$foreignModel];
                }
            }
//<{/if}>

        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['//<{$modelName}>']['limit'] = 20;
        $items = $this->paginate($this->//<{$modelName}>, $scope);
//<{if isset($relationships.hasAndBelongsToMany)}>

        if($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach($items AS $key => $item) {
                $items[$key]['option'] = $this->//<{$modelName}>->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        '//<{$modelName}>.id' => $item['//<{$modelName}>']['id'],
                        $foreignModel.'.id' => $foreignId,
                    ),
                ));
                if($items[$key]['option'] > 0) {
                    $items[$key]['option'] = 1;
                }
            }
            $this->set('op', $op);
        }
//<{/if}>

        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }
//<{else}>

    function admin_index() {
        $this->paginate['//<{$modelName}>'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this->//<{$modelName}>));
    }
//<{/if}>


    function admin_view($id = null) {
        if (!$id || !$this->data = $this->//<{$modelName}>->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action'=>'index'));
        }
    }

//<{if isset($relationships.belongsTo)}>

    function admin_add($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array(
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>

            '//<{$rModel}>' => '//<{$rOption.foreignKey}>',
//<{/foreach}>

        );
        if(array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            if (!empty($this->data)) {
                $this->data['//<{$modelName}>'][$foreignKeys[$foreignModel]] = $foreignId;
            }
        } else {
            $foreignModel = '';
        }
        if (!empty($this->data)) {
            $this->//<{$modelName}>->create();
            if ($this->//<{$modelName}>->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
        
//<{if isset($relationships.belongsTo)}>
        $belongsToModels = array(
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
            'list//<{$rModel}>' => array(
                'label' => '//<{$models[$rOption.className].label}>',
                'modelName' => '//<{$rModel}>',
                'foreignKey' => '//<{$rOption.foreignKey}>',
            ),
//<{/foreach}>
        );

        foreach($belongsToModels AS $key => $model) {
            if($foreignModel == $model['modelName']) {
                unset($belongsToModels[$key]);
                continue;
            }
            $this->set($key, $this->//<{$modelName}>->$model['modelName']->find('list'));
        }
        $this->set('belongsToModels', $belongsToModels);
//<{/if}>
    }
//<{else}>

    function admin_add() {
        if (!empty($this->data)) {
            $this->//<{$modelName}>->create();
            if ($this->//<{$modelName}>->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }
//<{/if}>


    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->//<{$modelName}>->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->//<{$modelName}>->read(null, $id);

//<{if isset($relationships.belongsTo)}>
        $belongsToModels = array(
//<{foreach from=$relationships.belongsTo key=rModel item=rOption}>
            'list//<{$rModel}>' => array(
                'label' => '//<{$models[$rOption.className].label}>',
                'modelName' => '//<{$rModel}>',
                'foreignKey' => '//<{$rOption.foreignKey}>',
            ),
//<{/foreach}>
        );

        foreach($belongsToModels AS $key => $model) {
            $this->set($key, $this->//<{$modelName}>->$model['modelName']->find('list'));
        }
        $this->set('belongsToModels', $belongsToModels);
//<{/if}>
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->//<{$modelName}>->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action'=>'index'));
    }

//<{if isset($relationships.hasAndBelongsToMany)}>

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
//<{foreach from=$relationships.hasAndBelongsToMany key=rModel item=rOption}>

            '//<{$rModel}>' => array(
                'associationForeignKey' => '//<{$rOption.associationForeignKey}>',
                'foreignKey' => '//<{$rOption.foreignKey}>',
                'alias' => '//<{$htbtmModels[$modelName][$rOption.className]}>',
            ),
//<{/foreach}>

        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if(empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', __('Wrong Parameters'));
        } else {
            $habtmModel = &$this->//<{$modelName}>->$habtmKeys[$foreignModel]['alias'];
            $conditions = array(
                $habtmKeys[$foreignModel]['associationForeignKey'] => $foreignId,
                $habtmKeys[$foreignModel]['foreignKey'] => $id,
            );
            $status = ($habtmModel->find('count', array(
                'conditions' => $conditions,
            ))) ? 'on' : 'off';
            if($status == $switch) {
                $this->set('habtmMessage', __('Duplicated operactions', true));
            } else if($switch == 'on') {
                $habtmModel->create();
                if($habtmModel->save(array($habtmKeys[$foreignModel]['alias'] => $conditions))) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            } else {
                if($habtmModel->deleteAll($conditions)) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            }
        }
    }
//<{/if}>

}