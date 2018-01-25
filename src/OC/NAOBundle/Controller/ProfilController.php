<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use OC\UserBundle\Entity\User;
use OC\UserBundle\Entity\Observation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfilController extends Controller
{



    // affiche les paramètres de l'utilisateur
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
    public function UsersAction(Request $request){

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
                 ->add('name', TextType::class)
                 ->add('submit', SubmitType::class)
                 ->getForm();

       $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

           $em = $this->getDoctrine()->getManager();
           $repository = $em->getRepository('OCUserBundle:User');
           $data = $form->getData()['name'];
           $user = $repository->findBy(array('username' => $data));
           $result = true;
           return $this->render('OCNAOBundle:Profil:users.html.twig', array(
               'user' => $user[0],
               'result' => $result,
             ));
         }
//faire recherche pour nombre utilisateur, obs,nat,adm


       $result = false;
       return $this->render('OCNAOBundle:Profil:users.html.twig', array(
           'form' => $form->createView(),
           'result' => $result,
         ));

    }

    //Pour l'autocompletion du champ recherche utilisateur
    public function userAutoCompAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $username = $request->get('username');

            $em = $this->getDoctrine()->getManager();
            $username = $em->getRepository('OCUserBundle:User')->getUsersList($username);

            $response = new Response(json_encode($username));
            return $response;
        }
    }

    //Pour changer de role
    // /**
    //  *@Security("has_role('ROLE_ADMIN')")
    //  */
    public function RoleAction(Request $request)
    {

      $username = $request->get('username');
      $role = $request->get('role');

      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      $user = $userManager->findUserBy(array('username' => $username ));
      $user->setStatus(false);
      $user->setRoles(array($role));// enregistre le role
      $userManager->updateUser($user);

        switch ($role) {
          case 'ROLE_OBSERVER':
            $rolename = 'Observateur';
            break;
          case 'ROLE_NATURALIST':
            $rolename = 'Naturaliste';
            break;
          case 'ROLE_ADMIN':
            $rolename = 'Administrateur';
            break;
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('OCUserBundle:User');
        $user = $repository->findBy(array('username' => $username));

        $this->addFlash('info', "$username, a obtenu le role $rolename, un email lui a était envoyer pour le prevenir");

        // faire email
        //  //envoi email
        //  $content = "???????????";
        //
        //  $mailer = $this->container->get('mailer');
        //  $message =  \Swift_Message::newInstance($object)
        //    ->setTo($user->getEmail())
        //    ->setFrom('email expediteur (le site)', 'Nos Amis les Oiseaux')
        //    ->setBody($content, 'text/html')
        //    ;
        //  $mailer->send($message);

        $result = true;
        return $this->render('OCNAOBundle:Profil:users.html.twig', array(
            'user' => $user[0],
            'result' => $result,
          ));
    }

   public function ObserverAction()
   {
     echo "devenir naturalist, email a mettre";
    //  //demande pour de venir naturalist
    //  //envoi email administrateur
    //  $userManager = $this->get('fos_user.user_manager');//recuperre le service
    //  $user = $this->setStatus(true);
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
    //  return $this->redirectToRoute('ocnao_profil_parameter');

   }

   /**
    *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
    */
   public function removeAction(Request $request)
   {
     $username = $request->get('usernameremove');
     //$userManager = $this->get('fos_user.user_manager');
     $this->addFlash('info', "la supression est desactiver pour le dev");

       if (empty($username)) {
          $user = $this->getUser();
          //$userManager->deleteUser($user);
          $this->addFlash('info', "Votre compte a été supprimé");
          return $this->redirectToRoute('ocnao_homepage');
        }else {
          $this->addFlash('info', "Le compte $username a été supprimé");
          //$userManager->deleteUser($user);
          return $this->redirectToRoute('ocnao_profil_users');
        }


   }


   /**
    *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
    */
   public function newsletterAction(Request $request)
   {

     $userManager = $this->get('fos_user.user_manager');//recuperre le service
     $news = $request->get('newsletter');
     $user = $this->getUser();

     if ($news == "true") {
       $user->setNewsletter(true);
       $this->addFlash('info', "Vous venez de vous inscrire à la newletter, merci.");
     }else {
       $user->setNewsletter(false);
       $this->addFlash('info', "Vous venez de vous désinscrire de la newletter.");
     }
      $userManager->updateUser($user);

      return $this->redirectToRoute('ocnao_profil_parameter');
   }




      ///////////////a suprimer le dev fini//////////////////////////////

    /**
     *@Security("has_role('ROLE_OBSERVER') or has_role('ROLE_NATURALIST') or has_role('ROLE_ADMIN')")
     */
    public function admAction()
    {
      // obtenir role administrateur
      $userManager = $this->get('fos_user.user_manager');//recuperre le service
      $user = $this->getUser();
      $user->setRoles(array('ROLE_ADMIN'));// enregistre le role naturalist
      $userManager->updateUser($user);

        return $this->redirectToRoute('ocnao_profil_parameter');
    }

}
