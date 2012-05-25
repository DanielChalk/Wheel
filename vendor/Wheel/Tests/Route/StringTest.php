<?php

use Wheel\Route\String;
use Wheel\Action;

class Route_StringTest extends PHPUnit_Framework_TestCase
{
  public function testRouteMatch()
  {
    $route = new String('/test', new Action('test', 'test'));
    $this->assertTrue($route->isMatch('/test'));
  }

  public function testRouteNotMatch()
  {
    $route = new String('/test', new Action('test', 'test'));
    $this->assertFalse($route->isMatch('/test-'));
  }

  public function testRouteParmsNone()
  {
    $route = new String('/test', new Action('test', 'test'));
    $action = $route->getAction('/test');

    $this->assertCount(0, $action->getParams());
  }

  public function testRouteParmsOne()
  {
    $route = new String('/test', new Action('test', 'test', array('arg-one')));
    $action = $route->getAction('/test');

    $this->assertCount(1, $action->getParams());
  }
}