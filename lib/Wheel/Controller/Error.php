<?php

/**
 * This file is part of the invent-the-wheel project
 * check out the license file ;)
 */

namespace Wheel\Controller;
use Wheel\Actions;

/**
 * Error controller
 * This is a basic error controller, there currently isnt a way to override
 * this class, I may update the dispatcher so it can be, but you can change the 
 * templates for this controller to suite your needs.
 * 
 * @author Daniel Chalk <snatchfrigate@gmail.com>
 */
class Error extends Actions
{
  public function indexAction(\Exception $e)
  {
    return $this->get('twig')->render('error.twig', array('exception' => $e));
  }
}