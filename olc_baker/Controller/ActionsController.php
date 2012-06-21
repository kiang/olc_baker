<?php

class ActionsController extends AppController {

    var $name = 'Actions';

    function add($formId = null) {
        if (!$formId) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            if (in_array($this->request->data['Action']['action'], array(
                        'index', 'view', 'admin_index', 'admin_add', 'admin_edit',
                        'admin_view', 'admin_habtm_set',
                    )) || $this->Action->hasAny(array(
                        'form_id' => $formId,
                        'action' => $this->request->data['Action']['action'],
                    ))) {
                $this->Session->setFlash(__('Method name is duplicated'));
            } else {
                $this->request->data['Action']['form_id'] = $formId;
                if (!empty($this->request->data['Action']['parameter'])) {
                    $this->request->data['Action']['parameters'] = serialize($this->request->data['Action']['parameter']);
                }
                unset($this->request->data['Action']['parameter']);
                $this->Action->create();
                if ($this->Action->save($this->request->data)) {
                    $this->Session->setFlash(__('The data has been saved'));
                    $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
                } else {
                    $this->Session->setFlash(__('Something was wrong during saving, please try again'));
                }
            }
        }
        $this->set('formId', $formId);
        $this->set('engines', $this->Action->getEngineList());
    }

    function delete($id = null) {
        if (!$id || !$formId = $this->Action->field('form_id', array('Action.id' => $id))) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if ($this->Action->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted'));
            $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
        }
    }

    function engine_form($formId, $engine) {
        /*
         * Fetch available fields
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
        foreach ($form['FormField'] AS $field) {
            $key = Inflector::classify($form['Form']['name']) . '.' . $field['name'];
            $fields[$key] = $form['Form']['label'] . '->' . $field['label'];
            $fieldTypes[$key] = $field['type'];
        }
        foreach ($form['Relationship'] AS $relationship) {
            foreach ($relationship['TargetForm']['FormField'] AS $field) {
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