<?php

namespace Triv\NewsBundle\Controller;

use Triv\NewsBundle\Entity\News;
use Triv\NewsBundle\Form\NewsType;
use Triv\NewsBundle\Form\NewsEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class NewsController extends Controller
{
    public function indexAction()
    {
		
		$listNews = $this->getDoctrine()
		  ->getManager()
		  ->getRepository('TrivNewsBundle:News')
		  ->findBy(array(),
                   array('date' => 'desc'),        
						1000,                          
						0      								
					);
		  
	  if ($listNews === null) {
     return $this->redirect($this->generateUrl('triv_news_add'));
    }
       
	  return $this->render('TrivNewsBundle:News:index.html.twig', array(
      'listNews' => $listNews
            ));
    }
	
	/**
   * @Security("has_role('ROLE_ADMIN')")
   */
	public function addAction(Request $request)
   {
    
      $news = new News();
   $form = $this->createForm(new NewsType(), $news);

    if ($form->handleRequest($request)->isValid()) {
	  $em = $this->getDoctrine()->getManager();
      $em->persist($news);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'news bien enregistrée.');

      return $this->redirect($this->generateUrl('triv_news_index'));
    }

    return $this->render('TrivNewsBundle:News:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
	
	 /**
   * @Security("has_role('ROLE_ADMIN')")
   */
   public function editAction($id, Request $request)
  {
     // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $news = $em->getRepository('TrivNewsBundle:News')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($news == null) {
      throw $this->createNotFoundException("La news d'id ".$id." n'existe pas.");
    }

     $form = $this->createForm(new NewsEditType(), $news);
	 
	 if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($news);
      $em->flush();
	   return $this->redirect($this->generateUrl('triv_news_index'));
	  }
	 
    return $this->render('TrivNewsBundle:News:edit.html.twig', array(
      'news' => $news,
	  'form' => $form->createView()
    ));
}
	
	
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
	
	public function deleteAction($id, Request $request)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $news = $em->getRepository('TrivNewsBundle:News')->find($id);

    // Si l'annonce n'existe pas, on affiche une erreur 404
    if ($news == null) {
      throw $this->createNotFoundException("La news d'id ".$id." n'existe pas.");
    }

    if ($request->isMethod('POST')) {
      // Si la requête est en POST, on deletea l'article
            $em->remove($news);
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', "La news a bien été supprimée.");
			return $this->redirect($this->generateUrl('triv_news_index'));
      // Puis on redirige vers l'accueil
      
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de delete
    return $this->render('TrivNewsBundle:News:delete.html.twig', array(
      'news' => $news
    ));
  }

  public function menuAction($limit)
  {
    $listNews = $this->getDoctrine()
      ->getManager()
      ->getRepository('TrivNewsBundle:News')
      ->findBy(
        array(),                 // Pas de critère
        array('date' => 'desc'), // On trie par date décroissante
        $limit,                  // On sélectionne $limit annonces
        0                        // À partir du premier
    );

    return $this->render('TrivNewsBundle:News:menu.html.twig', array(
      'listNews' => $listNews
    ));
  }
  
  }
