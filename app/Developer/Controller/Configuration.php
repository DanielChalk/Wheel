<?php

namespace Developer\Controller;

use Wheel\Actions;

class Configuration extends Actions
{
  public function configAction()
  {
    $file_to_edit = $this->get('config')->get('file/config.php');
    
    header('content-type: text/plain');
    return file_get_contents($file_to_edit);
  }
} 
