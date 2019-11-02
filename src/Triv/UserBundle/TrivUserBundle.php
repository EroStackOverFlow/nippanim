<?php

namespace Triv\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TrivUserBundle extends Bundle
{

  public function getParent()
  {
    return 'FOSUserBundle';
  }

}
