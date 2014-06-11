<?php
class //<{$modelName}> extends AppModel {

    var $name = '//<{$modelName}>';
//<{if $models[$modelName].validate}>

    var $validate = array(
//<{foreach from=$models[$modelName].validate key=field item=options}>

        '//<{$field}>' => array(
//<{foreach from=$options key=option item=items}>

            '//<{$option}>' => array(
//<{foreach from=$items key=ikey item=item}>

                '//<{$ikey}>' => //<{$item}>,
//<{/foreach}>

            ),
//<{/foreach}>

        ),
//<{/foreach}>

    );
//<{/if}>
                

    var $actsAs = array(
//<{if $uploads}>

        'Upload' => array(
//<{foreach from=$uploads key=field item=value}>

            '//<{$field}>' => array(
//<{if $value eq 'image'}>

                'styles' => array('thumb' => '150x150'),
//<{/if}>

            ),
//<{/foreach}>

        ),
//<{/if}>

    );

//<{if isset($relationships)}>

//<{foreach from=$relationships key=type item=value}>

    var $//<{$type}> = array(
//<{foreach from=$value key=mKey item=mItem}>

        '//<{$mKey}>' => array(
//<{foreach from=$mItem key=rKey item=rItem}>

//<{if $rItem == 'true' || $rItem == 'false'}>

            '//<{$rKey}>' => //<{$rItem}>,
//<{else}>

            '//<{$rKey}>' => '//<{$rItem}>',
//<{/if}>

//<{/foreach}>

        ),
//<{/foreach}>

    );
//<{/foreach}>

//<{/if}>


    function afterSave($created, $options = array()) {
//<{if isset($relationships.hasOne)}>

//<{foreach from=$relationships.hasOne key=rModel item=rOption}>

        if(!empty($this->data['//<{$rOption.className}>'])) {
            if($created) {
                $this->//<{$rOption.className}>->create();
            }
            $this->data['//<{$rOption.className}>']['//<{$rOption.foreignKey}>'] = $this->id;
            $this->//<{$rOption.className}>->save($this->data);
        }
//<{/foreach}>

//<{/if}>

	}

}