
    function <{$actionName}>($year = 0, $month = 0, $day = 0) {
        $year = intval($year);
        if($year < 1900 || $year > 2300) {
            $year = date('Y');
        }
        $month = intval($month);
        if($month < 1 || $month > 12) {
            $month = date('n');
        }
        $day = intval($day);
        if(!checkdate($month, $day, $year)) {
        	$year = date('Y');
        	$month = date('n');
            $day = date('j');
        }
        $dayRange['start'] = mktime(0, 0, 0, $month, $day, $year);
        $dayRange['end'] = mktime(0, 0, 0, $month, $day + 1, $year) - 1;
<{foreach from=$blocks.datetime key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
        $dayTimeField = '<{$className}>.<{$key}>';
        $dayTimeFieldName = '<{$key}>';
<{/foreach}>
<{/foreach}>
        $listEvents = $this-><{$modelName}>->find('all', array(
            'fields' => array(
                'id',
<{foreach from=$blocks.title key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
                '<{$className}>.<{$key}>',
<{/foreach}>
<{/foreach}>
                $dayTimeField,
            ),
            'conditions' => array(
                $dayTimeField . ' >=' => date('Y-m-d H:i:s', $dayRange['start']),
                $dayTimeField . ' <=' => date('Y-m-d H:i:s', $dayRange['end']),
            ),
            'order' => array($dayTimeField . ' ASC'),
        ));
        $events = array();
        foreach($listEvents AS $event) {
            $hour = date('G', strtotime($event['<{$modelName}>'][$dayTimeFieldName]));
            $events[$hour][] = $event;
        }
        $this->set('dayRange', $dayRange);
        $this->set('events', $events);
    }