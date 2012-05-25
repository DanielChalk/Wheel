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
  public function helloAction($first_name, $last_name = null)
  {
    return $this->get('twig')->render('test/hello.twig', array('name' => trim(sprintf('%s %s', $first_name, $last_name))));
  }
}
