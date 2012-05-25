<?php

use Wheel\Route\Regex;
use Wheel\Action;

class Route_RegexTest extends PHPUnit_Framework_TestCase
{
  public function testRouteMatch()
  {
    $route = new Regex('/^\/test\/(\w*)/', new Action('test', 'test'));
    $this->assertTrue($route->isMatch('/test/1'));
  }
  public function testRouteNotMatch()
  {
    $route = new Regex('/^\/test\/(\w*)/', new Action('test', 'test'));
    $this->assertTrue($route->isMatch('/test/1/extra'));
  }

  public function testRouteParmsOne()
  {
    $route = new Regex('/^\/test\/(\w*)/', new Action('test', 'test'));
    $action = $route->getAction('/test/1');

    $this->assertCount(1, $action->getParams());
  }

  public function testRouteParmsTwo()
  {
    $route = new Regex('/^\/test\/(\w*)/', new Action('test', 'test', array('arg-one')));
    $action = $route->getAction('/test/arg-two');

    $this->assertCount(2, $action->getParams());
  }
}