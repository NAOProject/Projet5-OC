<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use OC\NAOBundle\Entity\Observation;
use OC\NAOBundle\Entity\Recherche;
use OC\NAOBundle\Form\ObservationType;
use OC\NAOBundle\Form\RechercheType;

class ObservationController extends Controller
{
  //Fonction permettant l'ajout d'observations
  public function observationAction(Request $request)
  {
    $observation = new Observation();
    $form = $this->createForm(ObservationType::class, $observation);

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $user = $this->getUser();
        if ($user->hasRole('ROLE_ADMIN') OR $user->hasRole('ROLE_NATURE')) {
          $observation->setStatus(true);
          $this->addFlash('success', 'Votre observation à été publiée.');
        } else {
          $observation->setStatus(false);
          $this->addFlash('info', 'Votre observation à été envoyé, elle sera publiée après validation par un Naturaliste.');
        }
        $date = new \DateTime();
        $observation->setDatetime($date);
        $observation->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($observation);
        $em->flush();

        return $this->redirectToRoute('ocnao_homepage');
      }

    return $this->render('OCNAOBundle:Default:observation.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function autocompleteAction(Request $request)
  {
      if($request->isXmlHttpRequest())
      {
          $oiseau = $request->get('oiseau');
          $em = $this->getDoctrine()->getManager();
          $listeEspece = $em->getRepository('OCNAOBundle:Taxref')->listeEspece($oiseau);
          $response = new Response(json_encode($listeEspece));
          //$response->headers->set('Content-Type', 'application/json');
          return $response;
      }
  }

  //Fonction permettant la recherche d'observations
  public function rechercheAction(Request $request)
  {
    $recherche = new Recherche();
    $form = $this->createForm(RechercheType::class, $recherche);

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $espece = $recherche->getEspece();

        $results = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->listeObsEspece($espece);

        if($results) {
          return $this->render('OCNAOBundle:Default:results.html.twig', array(
            'results' => $results,
          ));
        }else{
          $this->addFlash('info', 'Aucune observation trouvé pour cette éspèce.');
          return $this->redirectToRoute('ocnao_recherche');
        }
      }

    //Derniere observations
    $lastObs = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->lastObs();

    return $this->render('OCNAOBundle:Default:recherche.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
