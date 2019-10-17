<?php
/** Require Composer's auto-loader. **/
require(__DIR__ . '/vendor/autoload.php');

/**
 * All code in this file is dev code at the moment.
 */

use DarlingCms\classes\fobBarBaz\Bar;
use DarlingCms\classes\fobBarBaz\Baz;
use DarlingCms\classes\fobBarBaz\Foo;

/**
 * Testing dev implementations of the abstract aggregate classes.
 */
$name = 'Name';
$type = 'Type';
$location = 'Location';
$container = 'Container';
$initialState = true;
$component = new Foo($name, $type);

$storableComponent = new Bar($name, $type, $location, $container);
$switchableComponent = new Baz($name, $type, $location, $container, $type);

echo '<br>' . $component->getName();
echo '<br>' . $component->getUid();
echo '<br>' . $component->getType();

echo '<br>' . $storableComponent->getName();
echo '<br>' . $storableComponent->getUid();
echo '<br>' . $storableComponent->getType();
echo '<br>' . $storableComponent->getLocation();
echo '<br>' . $storableComponent->getContainer();

echo '<br>' . $switchableComponent->getName();
echo '<br>' . $switchableComponent->getUid();
echo '<br>' . $switchableComponent->getType();
echo '<br>' . $switchableComponent->getLocation();
echo '<br>' . $switchableComponent->getContainer();
echo '<br>Initial State: ' . ($switchableComponent->getState() === true ? "True" : "False");
echo '<br>State Switched: ' . ($switchableComponent->switchState() === true ? "True" : "False");
echo '<br>New State: ' . ($switchableComponent->getState() === true ? "True" : "False");

