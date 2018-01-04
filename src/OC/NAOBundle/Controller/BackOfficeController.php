<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BackOfficeController extends Controller
{
  /**
   *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
    public function indexAction()
    {
      // pour mettre donnée un role a l'utilisteur voulu (ici azerty)
      //$userManager = $this->get('fos_user.user_manager');//recuperre le service
       //$user = $userManager->findUserBy(array('username' => 'Lucas'));
       //$user->removeRole('ROLE_OBSERVER'); // surpimer le role observateur
    //   $user->setRoles(array('ROLE_NATURALIST'));// enregistre le role naturalist
      //$user->setRoles(array('ROLE_ADMIN'));// enregistre le role admin
      //$userManager->updateUser($user);
    // //   echo "*************";
      // $user = $userManager->findUserBy(array('username' => 'azerty'));
      // $x = $user->getRoles();
      // dump($x);
      // exit;


      // // soit on utilise les annotation soir ceci
      // if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
      // throw new AccessDeniedException('Accès limité aux utilisateurs.');

        return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }
}
