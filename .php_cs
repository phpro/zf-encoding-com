<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('config')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');

$config = Symfony\CS\Config\Config::create();
$config->fixers(Symfony\CS\FixerInterface::PSR2_LEVEL);
$config->finder($finder);
return $config;
