<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCNAOBundle:Default:index.html.twig');
    }
    public function LandingPageAction()
    {
        return $this->render('OCNAOBundle::landingpage.html.twig');
    }
}
