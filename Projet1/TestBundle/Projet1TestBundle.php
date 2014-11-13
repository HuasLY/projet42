<?php

namespace Projet1\TestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Projet1TestBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
