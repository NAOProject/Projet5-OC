<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BackOfficeController extends Controller
{
  // /**
  //  *@Security("has_role('ROLE_OBSERVER') and has_role('ROLE_NATURALIST') and has_role('ROLE_ADMIN')")
  //  */
    public function indexAction()
    {
      // $userManager = $this->get('fos_user.user_manager');
      //
      // $user = $userManager->findUserBy(array('username' => 'azerty'));
      //
      // dump($user->getRoles());
      // exit;

      if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
      throw new AccessDeniedException('Accès limité aux utilisateurs.');
    }
        return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }
}
