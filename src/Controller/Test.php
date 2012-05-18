<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Controller;

use Wheel\Actions;

/**
 * Test controller 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Test extends Actions
{
  public function helloAction($name)
  {
    return $this->get('twig')->render('test/hello.twig', array('name' => $name));
  }
}
