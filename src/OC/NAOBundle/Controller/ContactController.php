<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OCNAOBundle\Form\ContactType;

class ContactController extends Controller
{

  public function contactAction(Request $request)
  {
      $contact = new Contact();
      $form = $this->createForm(ContactType::class, $contact);

      $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

          $email = $contact->getEmail();
          $object = $contact->getObject();

          //**************A faire*************************
          $content = $this->twig->render(
            'OCNAOBundle:Email:email.html.twig',
            array('contact' => $contact
            ));

          $mailer = $this->container->get('mailer');
          $message =  \Swift_Message::newInstance($object)
            ->setTo('EmailDestinataire')
            ->setFrom($email, 'Nos Amis les Oiseaux')
            ->setBody($content, 'text/html')
            ;
          $mailer->send($message);

          $this->addFlash('info', 'Votre message a bien été envoyé');
          return $this->redirectToRoute('ocnao_contact');// ***************** ou la page accueil ?????????????
        }
        //**************A faire*************************
      // return $this->render('OCNAOBundle::contact.html.twig', array(
      //     'form' => $form->createView()
      ));
  }


}
