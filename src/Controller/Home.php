<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Controller;

use Wheel\Actions;

/**
 * Home page controller 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Home extends Actions
{
  public function indexAction()
  {
    return $this->get('twig')->render('home/index.twig');
  }
}
