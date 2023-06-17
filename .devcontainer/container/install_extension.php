<?php

echo "Updating apt-get...\n";
$aptget = exec("apt-get update 2>&1", $aptgetArray, $aptgetCode);
if ($aptgetCode !== 0) {
    echo "Error updating apt-get: $aptget\n";
    exit(1);
}
echo "Installing git...\n";
$git = exec("apt-get install -y git 2>&1", $gitArray, $gitCode);
if ($gitCode !== 0) {
    echo "Error installing git: $git\n";
    exit(1);
}
echo "Installing xdebug...\n";
$xdebug = exec("pecl install xdebug", $xdebugArray, $xdebugCode);
if ($xdebugCode !== 0) {
    echo "Error installing xdebug: $xdebug\n";
    exit(1);
}
if (preg_match('/zend_extension=([^"]+)/', $xdebug, $matches)) {
    $zend_extension = $matches[0];
    exec("echo '$zend_extension' > /usr/local/etc/php/conf.d/xdebug.ini");
} else {
    echo "Could not find xdebug zend_extension path.\n";
    exit(1);
}
echo "Installation complete.\n";