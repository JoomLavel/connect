<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 14.09.2020
 * Time: 18:42
 */

require __DIR__ . '/../scr/command/GenericCommand.php';
require __DIR__ . '/../scr/command/MakeComponent.php';
require __DIR__ . '/../scr/service/ComponentGenerator.php';
require __DIR__ . '/../scr/service/ZipGenerator.php';

use App\Command\MakeComponent;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new MakeComponent($config));

try {
    $application->run();
} catch (Exception $e) {
}