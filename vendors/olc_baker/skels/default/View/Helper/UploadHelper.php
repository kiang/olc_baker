<?php
/**
 * This file is a part of UploadPack - a set of classes that makes file uploads in CakePHP as easy as possible.
 *
 * UploadHelper
 *
 * UploadHelper provides fine access to files uploaded with UploadBehavior. It generates url for those files and can display image tags of uploaded images. For more info read UploadPack documentation.
 *
 * @author Michał Szajbe (michal.szajbe@gmail.com) and netguru.pl
 * @link http://github.com/netguru/uploadbehavior
 * @version 0.1
 */
class UploadHelper extends AppHelper
{
    public $helpers = array('Html');

    public function image($data, $path, $style = 'original', $options = array())
    {
        return $this->output($this->Html->image($this->url($data, $path, $style, false), $options));
    }

    public function url($data, $field, $style = 'original', $urlize = true)
    {
        list ($model, $field) = explode('.', $field);
        if (is_array($data)) {
            if (isset($data[$model])) {
                if (isset($data[$model]['id'])) {
                    $id = $data[$model]['id'];
                    $filename = $data[$model][$field];
                }
            } elseif (isset($data['id'])) {
                $id = $data['id'];
                $filename = $data[$field];
            }
        }
        if (isset($id) && isset($filename)) {
            $settings = UploadBehavior::interpolate($model, $id, $field, $filename, $style, array('webroot' => ''));
            $url = isset($settings['url']) ? $settings['url'] : $settings['path'];
        } else {
            $settings = UploadBehavior::interpolate($model, null, $field, null, $style, array('webroot' => ''));
            $url = isset($settings['default_url']) ? $settings['default_url'] : null;
        }

        return $urlize ? $this->Html->url($url) : $url;
    }
}
