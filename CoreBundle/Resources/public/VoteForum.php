
<?php

namespace Triv\ForumBundle\Controller;


use Triv\ForumBundle\Entity\Forum;
use Triv\CoreBundle\Entity\Vote;
use Triv\ForumBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class VoteForum

/**
   * @Security("has_role('ROLE_USER')")
   */ 
   public function voteforumAction(Request $request)
  {
    
	if($request->getMethod() != 'POST'){
		http_response_code(403);
		die();
	}
	
	$ref_id  = $_POST['ref_id'];
	$ref  = $_POST['ref'];
	$vote  = $_POST['vote'];
	
	   
       $vot = new Vote();
	   $user = $this->getUser();
       $em = $this->getDoctrine()->getManager();
	   $advert = $em->getRepository('TrivForumBundle:Forum')->find($ref_id);

    // On vérifie que l'annonce avec cet id existe bien
    if ($advert === null) {
      throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
    }
			
	  if($vote == 1){
		  $this->like($ref,$ref_id,$user->getId(),$vot);
	  }else{
		  $this->dislike($ref,$ref_id,$user->getId(),$vot);	  
	  }
	    
		$advert->setLikeCount($this->updateVote($ref,$ref_id,1));
	    $advert->setDisLikeCount($this->updateVote($ref,$ref_id,-1));
		$em->flush();
	
    return true;
	}
  
  
  
  
      public function like($ref,$ref_id,$user_id,$vot){
		  $em = $this->getDoctrine()->getManager();
	
    $vote = false;
		$vote = $em->getRepository('TrivCoreBundle:Vote')->findoneBy(array('ref' => $ref,'refId' => $ref_id,'userId' => $user_id)	);
	if(null !==$vote){
		
		if($vote->getVote() == -1){
			$vote->setVote(1);
			$vote->setCreatedAt(new \Datetime());
			$em->flush();
			
			return true;
		}
				
		return true;
		 
	}    
		  		  
		  $vot->setRef($ref);
		  $vot->setRefId($ref_id);
		  $vot->setVote(1);
		  $vot->setUserId($user_id);
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($vot);
		  $em->flush();
		  
		  return true;
			  
	  }
	  
	    public function dislike($ref,$ref_id,$user_id,$vot){
			$em = $this->getDoctrine()->getManager();
	
    $vote = false;
		$vote = $em->getRepository('TrivCoreBundle:Vote')->findoneBy(array('ref' => $ref,'refId' => $ref_id,'userId' => $user_id)	);
	if(null !==$vote){
		
		if($vote->getVote() == 1){
			$vote->setVote(-1);
			$vote->setCreatedAt(new \Datetime());
			$em->flush();
				
			return true;
		}
		
		return true;
		 
	}    
		      $vot->setRef($ref);
			  $vot->setRefId($ref_id);
			  $vot->setVote(-1);
			  $vot->setUserId($user_id);
			  $em = $this->getDoctrine()->getManager();
			  $em->persist($vot);
			  $em->flush();
		  
		      return true;
	  }
	  
         /**
		 * permet d'ajouter une classe is-liked ou is-disliked
		 *
		 * @param $vote mixed false/PDRow
		 */
  
          public  function getClass($vote){
		      if($vote){
				  return $vote == 1 ? 'is-liked' : 'is-disliked' ;
			  }
			   return null;
		      
	  }
	  