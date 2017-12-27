<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ObservationController extends Controller
{
    public function observationAction()
    {
        return $this->render('OCNAOBundle:Default:index.html.twig');
    }
}
