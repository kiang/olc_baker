<?php

class FormFieldsController extends AppController {

    var $name = 'FormFields';

    function add($formId = null) {
        if (!$formId) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            $this->FormField->create();
            $this->request->data['FormField']['form_id'] = $formId;
            if (!empty($this->request->data['FormField']['option'])) {
                $this->request->data['FormField']['options'] = serialize($this->request->data['FormField']['option']);
            }
            unset($this->request->data['FormField']['option']);
            if ($this->FormField->save($this->request->data)) {
                $this->Session->setFlash(__('The data has been saved'));
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again'));
            }
        }
        $this->set('formId', $formId);
        $this->set('types', $this->FormField->getFieldTypeList());
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['FormField']['option'])) {
                $this->request->data['FormField']['options'] = serialize($this->request->data['FormField']['option']);
            }
            unset($this->request->data['FormField']['option']);
            if ($this->FormField->save($this->request->data)) {
                $this->Session->setFlash(__('The data has been saved'));
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $this->FormField->field('FormField.form_id')));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->FormField->read(null, $id);
        }
        $this->set('types', $this->FormField->getFieldTypeList());
    }

    function delete($id = null) {
        if (!$id || !$formId = $this->FormField->field('form_id', array('FormField.id' => $id))) {
            $this->Session->setFlash(__('Please do following links in the page'));
            $this->redirect($this->referer());
        }
        if ($this->FormField->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted'));
            $this->redirect(array('controller' => 'forms', 'action' => 'view', $formId));
        }
    }

    function type_form($type, $id = null) {
        $this->set('content', $this->FormField->getFieldTypeContent($type, $id));
    }

}