<?php
echo "\nUpdating apt-get...\n\n";
$aptget = exec("apt-get update 2>&1", $aptgetArray, $aptgetCode);
if ($aptgetCode !== 0) {
    echo "Error updating apt-get: $aptget\n\n";
    exit(1);
}
echo "Installing git...\n";
$git = exec("apt-get install -y git 2>&1", $gitArray, $gitCode);
if ($gitCode !== 0) {
    echo "Error installing git: $git\n\n";
    exit(1);
}
echo "Installing xdebug...\n";
$xdebug = exec("pecl install xdebug", $xdebugArray, $xdebugCode);
if ($xdebugCode !== 0) {
    echo "Error installing xdebug: $xdebug\n\n";
    exit(1);
}
if (preg_match('/zend_extension=([^"]+)/', $xdebug, $matches)) {
    $zend_extension = $matches[0];
    exec("echo '$zend_extension\nxdebug.mode = debug\nxdebug.start_with_request = yes' > /usr/local/etc/php/conf.d/xdebug.ini");
} else {
    echo "Could not find xdebug zend_extension path.\n\n";
    exit(1);
}
echo "\nInstallation complete.\n\n";
