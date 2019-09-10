<?php
$GLOBALS["local"] = __DIR__;
define("LOCALPROJETO", __DIR__);
require_once __DIR__ . '/composer/autoload_real.php';
return ComposerAutoloaderInit::getLoader();
