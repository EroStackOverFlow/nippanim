<?php

namespace Triv\QuizzBundle\Controller;

use Triv\QuizzBundle\Entity\Quizz;
use Triv\QuizzBundle\Form\QuizzType;
use Triv\QuizzBundle\Form\QuizzEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class QuizzController extends Controller
{
    public function indexAction()
    {
		
		$listQuizz = $this->getDoctrine()
		  ->getManager()
		  ->getRepository('TrivQuizzBundle:Quizz')
		  ->findAll();
		  
	  if ($listQuizz === null) {
     return $this->redirect($this->generateUrl('triv_quizz_add'));
    }
	      $Quizz = $this->getDoctrine()
		  ->getManager()
		  ->getRepository('TrivQuizzBundle:Quizz')
		  ->find(1);
		  
	 if ($Quizz === null) {
     return $this->redirect($this->generateUrl('triv_quizz_add'));
    }  
     
	   
	  return $this->render('TrivQuizzBundle:Quizz:index.html.twig', array(
      'listQuizz' => $listQuizz,
	  'Quizz'     => $Quizz
    ));

    }
	/**
   * @Security("has_role('ROLE_AJOUTEUR')")
   */
	public function addAction(Request $request)
   {
    
   
      $quizz = new Quizz();
   $form = $this->createForm(new QuizzType(), $quizz);

    if ($form->handleRequest($request)->isValid()) {
	  $em = $this->getDoctrine()->getManager();
      $em->persist($quizz);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'quizz bien enregistrée.');

      return $this->redirect($this->generateUrl('triv_quizz_home'));
    }

    return $this->render('TrivQuizzBundle:Quizz:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function playAction($name ,Request $request)
  {  
    
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();
	
	
		$listQuizz = $this->getDoctrine()
		  ->getManager()
		  ->getRepository('TrivQuizzBundle:Quizz')
		  ->findAll();
		  
    $Quizz = $em->getRepository('TrivQuizzBundle:Quizz')
	              ->findOneBy(array('name' => $name));
	
    // On vérifie que l'annonce avec cet id existe bien
    if ($Quizz === null) {
      throw $this->createNotFoundException("Le quizz  ".$name." n'existe pas.");
    }
  

    // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
    return $this->render('TrivQuizzBundle:Quizz:play.html.twig', array(
	  'listQuizz' 		 =>$listQuizz,
	  'Quizz'            =>$Quizz
    ));
	
	
  }
  
  
  /**
   * @Security("has_role('ROLE_AJOUTEUR')")
   */
   public function editAction($id, Request $request)
  {
     // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $quizz = $em->getRepository('TrivQuizzBundle:Quizz')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($quizz == null) {
      throw $this->createNotFoundException("Le quizz d'id ".$id." n'existe pas.");
    }

     $form = $this->createForm(new QuizzEditType(), $quizz);
	 
	 if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($quizz);
      $em->flush();
	   return $this->redirect($this->generateUrl('triv_quizz_play', array('name' => $quizz->getName())));
	  }
	 
    return $this->render('TrivQuizzBundle:Quizz:edit.html.twig', array(
      'quizz' => $quizz,
	  'form' => $form->createView()
    ));
}
  
   /**
   * @Security("has_role('ROLE_AJOUTEUR')")
   */
  public function deleteAction($id, Request $request)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $quizz = $em->getRepository('TrivQuizzBundle:Quizz')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($quizz == null) {
      throw $this->createNotFoundException("Le Quizz d'id ".$id." n'existe pas.");
    }

    if ($request->isMethod('POST')) {
      // Si la requête est en POST, on deletea l'article
            $em->remove($quizz);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "Le Quizz a bien été supprimée.");
			return $this->redirect($this->generateUrl('triv_quizz_home'));
      // Puis on redirige vers l'accueil
      
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de delete
    return $this->render('TrivQuizzBundle:Quizz:delete.html.twig', array(
      'quizz' => $quizz
    ));
  }

  
  }
