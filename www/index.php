<?php

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

$_ENV['SLIM_MODE'] = APPLICATION_ENV;

// Ensure lib directory is on include_path
set_include_path(APPLICATION_PATH . '/lib/' . PATH_SEPARATOR . get_include_path());

// Load Slim and Twig
require_once 'Slim/Slim/Slim.php';
require_once 'Slim-Extras/Views/TwigView.php';
require_once 'ZootoolGatePHP/src/ZootoolGatePHP.php';


$slim = new Slim(
    array('view' => new TwigView, 'templates.path' => APPLICATION_PATH . '/views', 'cookies.encrypt' => false, 'session.handler' => null)
);

$slim->configureMode(
    'production',
    function () use ($slim)
    {
        $slim->config(
            array(
                 'log.enable' => true,
                 'log.path' => APPLICATION_PATH . '/logs',
                 'debug' => false
            )
        );
    }
);

$slim->configureMode(
    'development',
    function () use ($slim)
    {
        $slim->config(
            array(
                 'log.enable' => false,
                 'debug' => true
            )
        );
    }
);



$zoogate = new ZootoolGatePHP();
$zoogate->setApikey('XXX');
$zoogate->setResultFormat('object');


$slim->get('/', function() use ($slim, $zoogate)
    {
        $items = $zoogate->get('users', 'items', array('username' => 'edvanbeinum'));
        $slim->render('index.html', array('items' => $items));
    }
);

$slim->get('/:tag/', function ($tag) use ($slim, $zoogate)
    {
        $items = $zoogate->get('users', 'items', array('username' => 'edvanbeinum', 'tag' => $tag));
        if( ! $items ) {
            $slim->flash('error', 'Sorry dear, we don\'t have any links that are tagged with "' . $tag . '"');
            $slim->redirect('/');
        }
        $slim->render('tagged.html', array('items' => $items, 'tag' => $tag));
    }
);

$slim->run();