<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\NAOBundle\Entity\Contact;
use OC\NAOBundle\Form\ContactType;

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

          $content = $this->renderView(
            'OCNAOBundle:Contact:emailcontact.html.twig',
            array('contact' => $contact
            ));

          $message =  (new \Swift_Message($object))
            ->setTo($email)
            ->setFrom('NAO@exemple.com', 'Nos Amis les Oiseaux')
            ->setBody($content, 'text/html')
            ;
          $this->get('mailer')->send($message);

//$spool = $mailer->getTransport()->getSpool();
//$transport = $this->get('swiftmailer.transport.real');
//$spool->flushQueue($transport);

          $this->addFlash('info', 'Votre message a bien été envoyé');
          return $this->redirectToRoute('ocnao_contact');
        }

      return $this->render('OCNAOBundle:Contact:contact.html.twig', array(
          'form' => $form->createView()
      ));
  }


}
