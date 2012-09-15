<?php

class FormsController extends AppController
{
    public $name = 'Forms';

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('pForm', $this->Form->read(null, $id));
        $this->set('formFields', $this->Form->FormField->find('all', array(
                    'conditions' => array('FormField.form_id' => $id),
                    'order' => array('FormField.sort ASC'),
                )));
        $this->set('relationships', $this->Form->Relationship->find('all', array(
                    'conditions' => array('Relationship.form_id_base' => $id),
                    'order' => array('Relationship.modified DESC'),
                    'contain' => array('TargetForm'),
                )));
        $this->set('actions', $this->Form->Action->find('all', array(
                    'conditions' => array('Action.form_id' => $id),
                )));
    }

    public function add($projectId = null)
    {
        if (!$projectId) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            $this->Form->create();
            $this->request->data['Form']['project_id'] = $projectId;
            if ($this->Form->save($this->request->data)) {
                $this->Session->setFlash(__('The data has been saved'));
                $this->redirect(array('action' => 'view', $this->Form->getInsertID()));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again'));
            }
        }
        $this->set('projectId', $projectId);
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            if ($this->Form->save($this->request->data)) {
                $this->Session->setFlash(__('The data has been saved'));
                $this->redirect(array('controller' => 'projects', 'action' => 'view', $this->Form->field('project_id')));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Form->read(null, $id);
        }
    }

    public function delete($id = null)
    {
        if (!$id || !$projectId = $this->Form->field('project_id', array('Form.id' => $id))) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        } elseif ($this->Form->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted'));
            $this->redirect(array('controller' => 'projects', 'action' => 'view', $projectId));
        }
    }

}
