#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\ClassInfoCommand;

$application = new Application('Class Info v1');

$application->add(new ClassInfoCommand());

$exitCode = $application->run();

exit($exitCode);

#./info.php app:class-info \\Test\\TestClass
#./info.php app:class-info \\App\\ClassInfoCommand
