<?php

class FormFieldsController extends AppController {

    var $name = 'FormFields';

    function add($formId = null) {
        if (!$formId) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            $this->FormField->create();
            $this->data['FormField']['form_id'] = $formId;
            if (!empty($this->data['FormField']['option'])) {
                $this->data['FormField']['options'] = serialize($this->data['FormField']['option']);
            }
            unset($this->data['FormField']['option']);
            if ($this->FormField->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('formId', $formId);
        $this->set('types', $this->FormField->getFieldTypeList());
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if (!empty($this->data['FormField']['option'])) {
                $this->data['FormField']['options'] = serialize($this->data['FormField']['option']);
            }
            unset($this->data['FormField']['option']);
            if ($this->FormField->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $this->FormField->field('FormField.form_id')));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->FormField->read(null, $id);
        }
        $this->set('types', $this->FormField->getFieldTypeList());
    }

    function delete($id = null) {
        if (!$id || !$formId = $this->FormField->field('form_id', array('FormField.id' => $id))) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if ($this->FormField->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
            $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
        }
    }

    function type_form($type, $id = null) {
        $this->set('content', $this->FormField->getFieldTypeContent($type, $id));
    }

}