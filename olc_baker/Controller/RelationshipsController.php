<?php

class RelationshipsController extends AppController {

    var $name = 'Relationships';

    function add($formId = null) {
        if (!$formId || !$baseForm = $this->Relationship->BaseForm->find('first', array(
                    'conditions' => array('BaseForm.id' => $formId),
                    'contain' => array(),
                ))) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            $this->Relationship->create();
            $this->request->data['Relationship']['project_id'] = $baseForm['BaseForm']['project_id'];
            $this->request->data['Relationship']['form_id_base'] = $baseForm['BaseForm']['id'];
            if ($this->Relationship->save($this->request->data)) {
                $this->Session->setFlash(__('Data has been saved'));
                /*
                 * Build the related relationship
                 */
                $this->request->data['Relationship']['parent_id'] = $this->Relationship->getInsertID();
                switch ($this->request->data['Relationship']['type']) {
                    case 'bt':
                        $this->request->data['Relationship']['type'] = 'hm';
                        break;
                    case 'ho':
                    case 'hm':
                        $this->request->data['Relationship']['type'] = 'bt';
                        break;
                }
                $this->request->data['Relationship']['form_id_base'] = $this->request->data['Relationship']['form_id_target'];
                $this->request->data['Relationship']['form_id_target'] = $baseForm['BaseForm']['id'];
                $this->Relationship->create();
                if ($this->Relationship->save($this->request->data)) {
                    $newId = $this->Relationship->getInsertID();
                    $this->Relationship->id = $this->request->data['Relationship']['parent_id'];
                    $this->Relationship->saveField('parent_id', $newId);
                }
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again'));
            }
        }
        $this->set('targetForms', $this->Relationship->TargetForm->find('list', array(
                    'conditions' => array(
                        'TargetForm.id !=' => $formId,
                        'TargetForm.project_id' => $baseForm['BaseForm']['project_id'],
                    ),
                )));
        $this->set('baseForm', $baseForm);
    }

    function delete($id = null) {
        if (!$id || !$parentId = $this->Relationship->field('parent_id', array('Relationship.id' => $id))) {
            $this->Session->setFlash(__('Please do following links in the page'));
        } else if ($this->Relationship->delete($id) && $this->Relationship->delete($parentId)) {
            $this->Session->setFlash(__('Data has been deleted'));
        }
        $this->redirect($this->referer());
    }

}