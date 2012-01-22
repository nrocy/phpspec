<?php

class PlainFoo {
  public $bar = "boo";
}

class MagicFoo {
  protected $attributes = array(
    "bar" => "boo"
  );

  public function __get($attribute) {
    return $this->attributes[$attribute];
  }
}

// TODO: No idea where this spec should be, nor how best to spec it
// This is currently just a test guarding against regression
class DescribeInterceptor extends \PHPSpec\Context {
  function itAllowsObjectChainingToWorkWhenTheValueHasNoMagicMethods() {
    $plainFoo = $this->spec(new PlainFoo);
    $plainFoo->bar->should->equal("boo");
  }

  function itShouldHandleMissingValueAttributes() {
    // Notices would be raised here if PHP is configured as such
    // Otherwise default PHP behaviour would return null which
    //  would likely fail the test anyway.
    $plainFoo = $this->spec(new PlainFoo);
    @$plainFoo->missing->should->beNull();
  }

  function itAllowsObjectChainingToWorkWhenTheValueHasAMagicGetter() {
    $magicFoo = $this->spec(new MagicFoo);
    $magicFoo->bar->should->equal("boo");
  }

}
