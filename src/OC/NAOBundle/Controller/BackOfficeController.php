<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackOfficeController extends Controller
{


    public function indexAction()
    {



        return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }
}
