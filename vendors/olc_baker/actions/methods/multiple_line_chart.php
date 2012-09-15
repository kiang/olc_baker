    function <{$actionName}>() {
        $this->helpers = array_merge($this->helpers, array('FlashChart'));
<{foreach from=$blocks.group_field key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
<{foreach from=$blocks.calculate_field key=b_className item=b_classFields}>
<{foreach from=$b_classFields key=b_key item=b_label}>
<{foreach from=$blocks.label_field key=c_className item=c_classFields}>
<{foreach from=$c_classFields key=c_key item=c_label}>
<{foreach from=$blocks.base_field key=d_className item=d_classFields}>
<{foreach from=$d_classFields key=d_key item=d_label}>
        $baseFields = $this-><{$modelName}>->find('all', array(
            'fields' => array(
                '<{$className}>.<{$key}>',
                '<{$c_className}>.<{$c_key}>',
                '<{$d_className}>.<{$d_key}>',
            ),
            'group' => array('<{$d_className}>.<{$d_key}>'),
        ));
        $charData = array();
        foreach ($baseFields AS $baseField) {
            $data = $this-><{$modelName}>->find('all', array(
                'conditions' => array(
                    '<{$d_className}>.<{$d_key}>' => $baseField['<{$d_className}>']['<{$d_key}>']
                ),
                'fields' => array(
                    '<{$parameters.settings.sql_method}>(<{$b_className}>.<{$b_key}>) AS value',
                ),
                'group' => array('<{$className}>.<{$key}>'),
            ));
            $charData[$baseField['<{$d_className}>']['<{$d_key}>']]['label'] = $baseField['<{$c_className}>']['<{$c_key}>'];
            foreach ($data AS $item) {
                $charData[$baseField['<{$d_className}>']['<{$d_key}>']]['value'][] = $item[0]['value'];
            }
        }
        $this->set('charData', $charData);
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
    }
