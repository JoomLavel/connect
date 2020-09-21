<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 14.09.2020
 * Time: 18:42
 */

use JoomLavel\Rad\Command\MakeComponent;
use Symfony\Component\Console\Application;

$application = new Application();

$MakeComponent = new MakeComponent($config);

$application->add($MakeComponent );

try {
    $application->run();
} catch (Exception $e) {
}
