<?php

namespace Controller;

use Wheel\Actions;

class Help extends Actions
{
  public function indexAction()
  {
    return $this->get('twig')->render('help/index.twig');
  }
}
