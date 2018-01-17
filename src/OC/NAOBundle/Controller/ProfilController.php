<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use OC\UserBundle\Entity\User;
use OC\UserBundle\Entity\Observation;

class ProfilController extends Controller
{
const nbPerPage = 4;

  /**
   *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function UserObservationAction($page)
  {

      if ($page < 1) {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }
    $nbPerPage = SELF::nbPerPage;
    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');
    $user = $this->getUser();

    // On récupère notre objet Paginator
    $observationList = $repository->userObservation($user, $page, $nbPerPage);

    // On calcule le nombre total de pages
    $nbPages = ceil(count($observationList) / $nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
    //$route = 'ocnao_userobservation';
    $route = 1;
    // On donne toutes les informations nécessaires à la vue
    return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'route' => $route,

    ));
  }

  /**
   *@Security("has_role('ROLE_OBSERVER')")
   */
  public function PendingObservationAction($page)
  {
    if ($page < 1) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
    $nbPerPage = SELF::nbPerPage;
    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');
    $user = $this->getUser();
    // On récupère notre objet Paginator
    $observationList = $repository->userPendingObservation($user, $page, $nbPerPage);

    // On calcule le nombre total de pages
    $nbPages = ceil(count($observationList) / $nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

    //$route = 'ocnao_pendingrobservation';
    $route = 2;
    // On donne toutes les informations nécessaires à la vue
    return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'route' => $route,
    ));
  }

  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function ObservationValidateAction($page)
  {

      if ($page < 1) {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }
    $nbPerPage = SELF::nbPerPage;
    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');
    $user = $this->getUser();

    // On récupère notre objet Paginator
    $observationList = $repository->userObservationValidate($user, $page, $nbPerPage);

    // On calcule le nombre total de pages
    $nbPages = ceil(count($observationList) / $nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
    //$route = 'ocnao_observationvalidate';
    $route = 3;
    // On donne toutes les informations nécessaires à la vue
    return $this->render('OCNAOBundle:Profil:userobservation.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'route' => $route,

    ));
  }

  /**
   *@Security("has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
   */
  public function ObservationAtValidateAction($page)
  {

      if ($page < 1) {
        throw $this->createNotFoundException("La page ".$page." n'existe pas.");
      }
    $nbPerPage = SELF::nbPerPage;
    $em = $this->getDoctrine()->getManager();
    $repository = $em->getRepository('OCNAOBundle:Observation');
    $user = $this->getUser();

    // On récupère notre objet Paginator
    $observationList = $repository->ObservationAtValidate($user, $page, $nbPerPage);

    // On calcule le nombre total de pages
    $nbPages = ceil(count($observationList) / $nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
    // On donne toutes les informations nécessaires à la vue
    return $this->render('OCNAOBundle:Default:observationatvalidate.html.twig', array(
      'observationList' => $observationList,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
  }
  // /**
  //  *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
  //  */
  //   public function indexAction()
  //   {
  //     $em = $this->getDoctrine()->getManager();
  //     $repository = $em->getRepository('OCNAOBundle:Observation');
  //     $user = $this->getUser();
  //     $role = $user->getRoles()[0];
  //     // dump($role);
  //     // exit;
  //     $observationList = $repository->userObservation($user);
  //     // dump($observationList);
  //     // exit;
  //
  //     if ($role == 'ROLE_OBSERVER') {
  //
  //       $pendingObservationList = $repository->userPendingObservation($user);
  //
  //       return $this->render('OCNAOBundle:Profil:profil.html.twig', array(
  //         'user' => $user,
  //         'observationList' => $observationList,
  //         'pendingObservationList' => $pendingObservationList,
  //       ));
  //     }else {
  //
  //       $observationValidateList = $repository->userObservationvalidate($user);
  //
  //       return $this->render('OCNAOBundle:Profil:profil.html.twig', array(
  //         'user' => $user,
  //         'observationList' => $observationList,
  //         'observationValidateList' => $observationValidateList,
  //       ));
  //     }
  //   }

    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function ParameterAction()
    {
      $user = $this->getUser();
        return $this->render('OCNAOBundle:Profil:parameter.html.twig', array(
            'user' => $user,

          ));;
    }


    /**
     *@Security("has_role('ROLE_ADMIN')")
     */
    public function UsersAction(){
      $result = false;
      if (($request->isMethod('POST'))) {
        $username = $this->get('request')->request->get('pseudo');

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('OCNAOBundle:Observation');
        $result = true;
      }

        return $this->render('OCNAOBundle:Profil:users.html.twig', array(
            'user' => $user,
            'result' => $result,

          ));
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
      //   return $this->render('OCNAOBundle:Profil:profil.html.twig');
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
    //  return $this->redirectToRoute('ocnao_profil');

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

        return $this->redirectToRoute('ocnao_profil');
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

        return $this->redirectToRoute('ocnao_profil');
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

        return $this->redirectToRoute('ocnao_profil');
    }
}
