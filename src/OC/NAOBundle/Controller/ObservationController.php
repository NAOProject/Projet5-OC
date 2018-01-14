<?php

namespace OC\NAOBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use OC\NAOBundle\Entity\Observation;
use OC\NAOBundle\Entity\Picture;
use OC\NAOBundle\Entity\Recherche;
use OC\NAOBundle\Form\ObservationType;
use OC\NAOBundle\Form\RechercheType;

use web\assets\images;

class ObservationController extends Controller
{
  //Fonction permettant l'ajout d'observation
  public function addObservationAction(Request $request)
  {
    $observation = new Observation();
    $form = $this->createForm(ObservationType::class, $observation);

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $user = $this->getUser();
        if ($user->hasRole('ROLE_ADMIN') OR $user->hasRole('ROLE_NATURALIST')) {
          $observation->setStatus(true);
        } else {
          $observation->setStatus(false);
        }
        $date = new \DateTime();
        $observation->setDatetime($date);
        $observation->setUser($user);

        if ($observation->getPicture() != null) {
          $file = $observation->getPicture()->getImage();

          $fileName = md5(uniqid()).'.'.$file->guessExtension();

          $file->move(
              $this->getParameter('picture_directory'),
              $fileName
          );
          $picture = $observation->getPicture()->setImage($fileName);
          $observation->setPicture($picture);
        }


        $em = $this->getDoctrine()->getManager();
        $em->persist($observation);
        $em->flush();

        if($observation->getStatus() == true) {
          $this->addFlash('success', 'Votre observation à été publiée.');
        }else {
          $this->addFlash('info', 'Votre observation à été envoyé, elle sera publiée après validation par un Naturaliste.');
        }

        return $this->redirectToRoute('ocnao_homepage');
      }

    return $this->render('OCNAOBundle:Default:addObservation.html.twig', array(
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
        $_SESSION['espece'] = $espece;
        return $this->redirectToRoute('ocnao_results');
      }
    $_SESSION['espece'] = null;
    //Derniere observations
    $lastObs = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->lastObs();

    return $this->render('OCNAOBundle:Default:recherche.html.twig', array(
      'form' => $form->createView(),
      'lastObs' => $lastObs,
      'session' => $_SESSION,
    ));
  }

  //Affiche la liste des resultats pour la recherche
  public function resultsAction(Request $request)
  {
    $recherche = new Recherche();
    $form = $this->createForm(RechercheType::class, $recherche);

    $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()){
        $espece = $recherche->getEspece();
        $_SESSION['espece'] = $espece;
        return $this->redirectToRoute('ocnao_results');
      }
    $espece = $_SESSION['espece'];
    $results = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->listeObsEspece($espece);

    if($results) {
      return $this->render('OCNAOBundle:Default:results.html.twig', array(
        'form' => $form->createView(),
        'results' => $results,
        'session' => $_SESSION,
      ));
    }else{
      $this->addFlash('info', 'Aucune observation trouvé pour cette éspèce.');
      return $this->redirectToRoute('ocnao_recherche');
    }
  }

  //Afficher une observation, en fonction de son id
  public function observationAction($id)
  {
    $observation = $this->getDoctrine()->getManager()->getRepository('OCNAOBundle:Observation')->observation($id);
    return $this->render('OCNAOBundle:Default:observation.html.twig', array(
      'observation' => $observation,
      'session' => $_SESSION,
    ));
  }
}
