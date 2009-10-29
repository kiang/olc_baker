<?php
if(!isset($url)) {
    $url = array();
}
echo $paginator->first('<<', array('url' => $url));
echo ' &nbsp; ' . $paginator->prev('<', array('url' => $url));
echo ' &nbsp; ' . $paginator->numbers(array('url' => $url));
echo ' &nbsp; ' . $paginator->next('>', array('url' => $url));
echo ' &nbsp; ' . $paginator->last('>>', array('url' => $url));