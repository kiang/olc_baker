<?php

class Project extends AppModel {

    public $name = 'Project';
    public $validate = array(
        'name' => array('notBlank'),
        'label' => array('notBlank'),
        'rewrite_base' => array('notBlank'),
        'app_path' => array('notBlank')
    );
    public $hasMany = array(
        'Form' => array(
            'className' => 'Form',
            'foreignKey' => 'project_id',
            'dependent' => false,
        )
    );

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        require_once VENDORS . 'smarty/Smarty.class.php';
        if (class_exists('Smarty')) {
            $this->smarty = new Smarty;
            $this->smarty->template_dir = VENDORS . 'olc_baker' . DS . 'templates' . DS;
            $this->smarty->compile_dir = TMP . 'smarty' . DS . 'compile' . DS;
            $this->smarty->cache_dir = TMP . 'smarty' . DS . 'cache' . DS;
            $this->smarty->left_delimiter = '//<{';
            $this->smarty->right_delimiter = '}>';
        }
    }

    public $tasks = array();
    public $errorMessage = '';

    public function fetchProject($projectId) {
        return $this->find('first', array(
                    'conditions' => array('Project.id' => $projectId),
                    'contain' => array(
                        'Form' => array(
                            'FormField' => array(
                                'order' => array('sort ASC'),
                            ),
                            'Relationship' => array(
                                'fields' => array('type'),
                                'TargetForm' => array(
                                    'fields' => array('name'),
                                ),
                            ),
                            'Action' => array(
                                'fields' => array('name', 'action', 'engine', 'parameters'),
                            ),
                        ),
                    ),
        ));
    }

    /**
     * Make sure if the $appPath exists and copy the skel to there
     * @param string $appPath
     */
    public function initialAppPath($appPath) {
        App::uses('Folder', 'Utility');
        $fh = new Folder();
        if (file_exists($appPath)) {
            if (false === $fh->delete($appPath)) {
                $this->errorMessage = __('Target path exists. But the program could not delete the folder automatically');

                return false;
            } else {
                $this->tasks[] = array(
                    'title' => __('Target path exists. Delete the old folders.'),
                    'operactions' => $fh->messages(),
                );
            }
        }

        /*
         * Copy the skelecton of the application
         */
        $fh->copy(array(
            'to' => $appPath,
            'from' => VENDORS . 'olc_baker' . DS . 'skels' . DS . 'default',
            'mode' => 0777,
        ));
        $errors1 = $fh->errors();
        $fh->copy(array(
            'to' => $appPath . DS . 'cake2' . DS . 'lib',
            'from' => CAKE_CORE_INCLUDE_PATH,
            'mode' => 0777,
        ));
        $errors2 = $fh->errors();
        if (!empty($errors1) || !empty($errors2)) {
            $this->errorMessage = __('The program could not copy files to the folder automatically');

            return false;
        } else {
            $this->tasks[] = array(
                'title' => __('Copy the skelecton of application to the target path'),
                'operactions' => $fh->messages(),
            );
        }

        return true;
    }

}
