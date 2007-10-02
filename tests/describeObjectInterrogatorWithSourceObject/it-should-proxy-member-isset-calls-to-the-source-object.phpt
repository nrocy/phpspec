--TEST--
Should proxy member isset calls to the source object
--FILE--
<?php
require dirname(__FILE__) . '/../_setup.inc';
require_once 'PHPSpec/Object/Interrogator.php';

class Foo {
    public $arg1 = null;
    public function __construct($arg1) {
        $this->arg1 = $arg1;
    }
}

$proxy = new PHPSpec_Object_Interrogator('Foo', 1);
$proxy->arg1 = null;
assert('!isset($proxy->arg1)');



?>
===DONE===
--EXPECT--
===DONE===