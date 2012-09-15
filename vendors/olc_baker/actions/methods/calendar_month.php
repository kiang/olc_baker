
    function <{$actionName}>($year = 0, $month = 0) {
        $year = intval($year);
        if ($year < 1900 || $year > 2300) {
            $year = date('Y');
        }
        $month = intval($month);
        if ($month < 1 || $month > 12) {
            $month = date('n');
        }
        $daysRange['start'] = mktime(0, 0, 0, $month, 1, $year);
        $daysRange['end'] = mktime(0, 0, 0, $month + 1, 1, $year) - 1;
<{foreach from=$blocks.datetime key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
        $dayTimeField = '<{$className}>.<{$key}>';
        $dayTimeFieldName = '<{$key}>';
<{/foreach}>
<{/foreach}>
<{foreach from=$blocks.title key=className item=classFields}>
<{foreach from=$classFields key=key item=label}>
        $titleFieldModel = '<{$className}>';
        $titleFieldName = '<{$key}>';
<{/foreach}>
<{/foreach}>

        $listEvents = $this-><{$modelName}>->find('all', array(
            'fields' => array(
                'id', $titleFieldModel . '.' . $titleFieldName, $dayTimeField,
            ),
            'conditions' => array(
                $dayTimeField . ' >=' => date('Y-m-d H:i:s', $daysRange['start']),
                $dayTimeField . ' <=' => date('Y-m-d H:i:s', $daysRange['end']),
            ),
            'order' => array($dayTimeField . ' ASC'),
        ));
        $events = array();
        foreach ($listEvents AS $event) {
            $eventTime = strtotime($event['<{$modelName}>'][$dayTimeFieldName]);
            $day = date('j', $eventTime);
            $event[$titleFieldModel][$titleFieldName] = date('H:i ', $eventTime) . $event[$titleFieldModel][$titleFieldName];
            $events[$day][] = $event;
        }
        $this->set('daysRange', $daysRange);
        $this->set('events', $events);
    }
