<?php
error_reporting(E_ALL|E_STRICT);
date_default_timezone_set('Europe/Budapest');
use Doctrine\Common\Annotations\AnnotationRegistry;
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $loader = include __DIR__ . '/../vendor/autoload.php';
//    $loader->add('hu', __DIR__ . '/src');
}