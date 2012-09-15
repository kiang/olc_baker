
    function <{$actionName}>() {
        $this->helpers = array_merge($this->helpers, array('FlashChart'));
<{foreach from=$blocks.group_field key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
<{foreach from=$blocks.calculate_field key=b_className item=b_classFields}>
<{foreach from=$b_classFields key=b_key item=b_label}>
<{foreach from=$blocks.label_field key=c_className item=c_classFields}>
<{foreach from=$c_classFields key=c_key item=c_label}>

        $data = $this-><{$modelName}>->find('all', array(
            'fields' => array(
                '<{$parameters.settings.sql_method}>(<{$b_className}>.<{$b_key}>) AS value',
                '<{$className}>.<{$key}>',
                '<{$c_className}>.<{$c_key}>',
            ),
            'group' => array('<{$className}>.<{$key}>'),
        ));
        $charData = array();
        foreach ($data AS $item) {
            $charData[$item['<{$className}>']['<{$key}>']]['value'] = $item[0]['value'];
            $charData[$item['<{$className}>']['<{$key}>']]['label'] = $item['<{$c_className}>']['<{$c_key}>'];
        }
        $this->set('charData', $charData);
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
<{/foreach}>
    }
