<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . "/bootstrap")
    ->in(__DIR__ . "/config")
    ->in(__DIR__ . "/database")
    ->in(__DIR__ . "/routes")
    ->in(__DIR__ . "/src")
    ->in(__DIR__ . "/tests");


$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@PSR12' => true,
        'declare_strict_types' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        '@Symfony' => true,
    ])
    ->setFinder($finder);
