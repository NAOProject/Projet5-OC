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

      $Listobservation = $em->getRepository('OCNAOBundle:Observation')->findBy(
        array('user' => $user), // Critere
        array('datetime' => 'desc'),        // Tri
        5,                              // Limite
        0                               // Offset
      );
      switch ($role) {
          case 'ROLE_OBSERVER':


              // dump($Listobservation);
              // exit;
              return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
                'user' => $user,
                'Listobservation' => $Listobservation,
              ));
              //break;

          case 'ROLE_NATURALIST':

            $Listobservationvalidate = $em->getRepository('OCNAOBundle:Observation')->findBy(
              array('status' => false), // Critere
              array('datetime' => 'desc'),        // Tri
              5,                              // Limite
              0                               // Offset
            );

            return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
              'user' => $user,
              'Listobservation' => $Listobservation,
              'Listobservationvalidate' => $Listobservationvalidate,
            ));
              //break;

          case 'ROLE_ADMIN':
          echo "admin a faire";
              break;
      }

        // return $this->render('OCNAOBundle:BackOffice:backoffice.html.twig', array(
        //   'user' => $user,
        //   'Listobservation' => $Listobservation,
        // ));
    }

    /**
     *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
      public function validateAction($id)
      {
        $em = $this->getDoctrine()->getManager();
        $obs = $em->getRepository('OCNAOBundle:Observation')->find($id);
        $obs->setStatus(true);
        echo "test validation";
        exit;
        $em->persist($obs);
        $em->flush();

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
    //  //demande pour de venir naturalist
    //  //envoi email administrateur
    //  $userManager = $this->get('fos_user.user_manager');//recuperre le service
    //  $user = $this->setStatus('demande');
    //  $userManager->updateUser($user);
     //
    //  //envoi email administrateur
    //  $content = "???????????";
     //
    //  $mailer = $this->container->get('mailer');
    //  $message =  \Swift_Message::newInstance($object)
    //    ->setTo('EmailDestinataire')
    //    ->setFrom($this->getEmail(), 'Nos Amis les Oiseaux')
    //    ->setBody($content, 'text/html')
    //    ;
    //  $mailer->send($message);
     //
    //  $this->addFlash('info', 'La demande est en cours un administrateur vous contactera pas email');
    //  return $this->redirectToRoute('ocnao_backoffice');

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

        return $this->redirectToRoute('ocnao_backoffice');
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

        return $this->redirectToRoute('ocnao_backoffice');
    }
}
