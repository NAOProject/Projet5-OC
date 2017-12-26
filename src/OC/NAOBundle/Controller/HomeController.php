<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()

    {
      // echo "ffffffffffffffffffffffffff";
      // exit;
        return $this->render('OCNAOBundle:Default:index.html.twig');
    }
}
