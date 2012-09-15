<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('apps')
    ->exclude('lib')
    ->exclude('vendors/olc_baker/templates')
    ->exclude('olc_baker/tmp')
    ->name('*.php')
    ->name('*.ctp')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->finder($finder)
;
