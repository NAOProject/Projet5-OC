<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use OC\UserBundle\Entity\User;
use OC\UserBundle\Entity\Observation;

class BackOfficeController extends Controller
{
  /**
   *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $role = $user->getRoles()[0];
      // dump($role);
      // exit;
      switch ($role) {
          case 'ROLE_OBSERVER':
          // echo "icic";
          // exit;
              $Listobservation = $em->getRepository('OCNAOBundle:Observation')->findBy(
                array('user' => $user), // Critere
                array('datetime' => 'desc'),        // Tri
                5,                              // Limite
                0                               // Offset
              );
              return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
                'user' => $user,
                'Listobservation' => $Listobservation,
              ));
              break;
          case 'NATURALIST':
          // $Listobservation = $em->getRepository('UserBundle:Observation')->findBy(
          //   array('user' => $user), // Critere
          //   array('datetime' => 'desc'),        // Tri
          //   5,                              // Limite
          //   0                               // Offset
          // );
          // $Listobservationvalidate = $em->getRepository('UserBundle:Observation')->findBy(
          //   array('statut' => 'false'), // Critere
          //   array('datetime' => 'desc'),        // Tri
          //   5,                              // Limite
          //   0                               // Offset
          // );
          // return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
          //   'user' => $user,
          //   'Listobservation' => $Listobservation,
          // ));
              break;
          case 'ADMIN':

              break;
      }

        // return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
        //   'user' => $user,
        //   'Listobservation' => $Listobservation,
        // ));
    }

    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function naturalistAction()
    {
      // obtenir role naturalist
      //$username =
      // $userManager = $this->get('fos_user.user_manager');//recuperre le service
      // $user = $userManager->findUserBy(array('username' => $username ));
      // $user->setRoles(array('ROLE_NATURALIST'));// enregistre le role naturalist
      // $userManager->updateUser($user);
      //
      //   return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }

   public function ObserverAction()
   {
     //demande pour de venir naturalist
     //envoi email administrateur

   }

///////////////a suprimer le dev fini//////////////////////////////

    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function natAction()
    {
      // obtenir role naturalist
      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      $user = $this->getUser();
      $user->setRoles(array('ROLE_NATURALIST'));// enregistre le role naturalist
      $userManager->updateUser($user);

        return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }
    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function admAction()
    {
      // obtenir role administrateur
      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      $user = $this->getUser();
      dump($user);
      exit;
      $user->setRoles(array('ROLE_ADMIN'));// enregistre le role naturalist
      $userManager->updateUser($user);

        return $this->redirectToRoute('ocnao_backoffice');
    }
    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function obsAction()
    {
      // obtenir role observateur
      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      $user = $this->getUser();
      $user->setRoles(array('ROLE_OBSERVER'));// enregistre le role naturalist
      $userManager->updateUser($user);

        return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig');
    }
}
