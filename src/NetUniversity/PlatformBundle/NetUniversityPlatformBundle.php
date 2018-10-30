<?php

namespace NetUniversity\PlatformBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NetUniversityPlatformBundle extends Bundle
{
	  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
