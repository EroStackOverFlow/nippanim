<?php
// src/Triv/AdminBundle/Controller/AdminController.php

namespace Triv\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Triv\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{
  public function indexAction()
  {
 
    return $this->render('TrivAdminBundle:Admin:index.html.twig');
  }
  
   public function userAction(Request $request)
   {
        
      $em = $this->getDoctrine()->getManager();
       $userlist = $em->getRepository('TrivUserBundle:User')->findBy(array(),
                   array('username' => 'ASC'),        
						1000000,                          
						0      								
					);
	    
	    if ($userlist === null) {
      throw $this->createNotFoundException("pas encore de user.");
    }
	   
    return $this->render('TrivAdminBundle:Admin:user.html.twig', array(
      'userlist' => $userlist,
    ));
  }
  
   public function letterAction()
  {
    
    $listMail = $this->getDoctrine()
      ->getManager()
      ->getRepository('TrivCoreBundle:NewsLetter')
      ->findAll()
    ;

    // On donne toutes les informations nécessaires à la vue
    return $this->render('TrivAdminBundle:Admin:newsletter.html.twig', array(
      'listMail' => $listMail
    ));
  }
   
   
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
   public function promoteAction(User $user, $role)
   {
      if($role == "admin"){
		  
		  $rol = array('ROLE_ADMIN');
         $user->setRoles($rol);
	  }
	  elseif($role == "ajouteur"){
		  
		  $rol = array('ROLE_AJOUTEUR');
          $user->setRoles($rol);
	  }
	  elseif($role == "user"){
		  
		  $rol = array('ROLE_USER');
          $user->setRoles($rol);
	  }
	  
	  
	  $em = $this->getDoctrine()->getManager();
      $em->flush();
	  
	   
   return $this->redirect($this->generateUrl('triv_admin_user'));
   
  }
   
   
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
   public function deleteAction(User $user)
   {
      
	  $em = $this->getDoctrine()->getManager();
	  $em->remove($user);
      $em->flush();
	  
	   
   return $this->redirect($this->generateUrl('triv_admin_user'));
   
  }
  
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
   public function desactiveAction(User $user)
   {
      
	  $em = $this->getDoctrine()->getManager();
	  $user->setLocked(true);
      $this->get('fos_user.user_manager')->updateUser($user);
      $em->flush();
	  
	   
   return $this->redirect($this->generateUrl('triv_admin_user'));
   
  }
}
