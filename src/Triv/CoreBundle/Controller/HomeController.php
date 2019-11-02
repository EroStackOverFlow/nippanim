<?phpnamespace Triv\CoreBundle\Controller;use Triv\CoreBundle\Entity\NewsLetter;use Symfony\Bundle\FrameworkBundle\Controller\Controller;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\HttpFoundation\Request;class HomeController extends Controller{    public function indexAction()    {        return $this->render('TrivCoreBundle:Home:index.html.twig');    }		 public function menuAction()  {    $nbMembre = $this->getDoctrine()      ->getManager()      ->getRepository('TrivUserBundle:User')      ->getNb();	  	  $nbCom1 = $this->getDoctrine()      ->getManager()      ->getRepository('TrivForumBundle:Commentaire')      ->getNb();	  	  $nbCom2 = $this->getDoctrine()      ->getManager()      ->getRepository('TrivAnimesBundle:AnimesCommentaire')      ->getNb();	  	  $nbCom =$nbCom2+ $nbCom1;	  	  $nbAnimes = $this->getDoctrine()      ->getManager()      ->getRepository('TrivAnimesBundle:Animes')      ->getNb();	  	  $nbEpisodes = $this->getDoctrine()      ->getManager()      ->getRepository('TrivAnimesBundle:Animes')      ->getNb();	  	  $nbQuizz = $this->getDoctrine()      ->getManager()      ->getRepository('TrivQuizzBundle:Quizz')      ->getNb();    return $this->render('TrivCoreBundle:Home:menu.html.twig', array(      'nbMembre' => $nbMembre,	  'nbCom'    => $nbCom,	  'nbAnimes' => $nbAnimes,	  'nbep'     => $nbEpisodes,	  'nbQuizz'  => $nbQuizz     ));	}public function contactAction(Request $request)   {                          return $this->render('TrivCoreBundle:Home:contact.html.twig');  }	 	public function contactsendAction(Request $request)   {	 	   $name =  $this->getRequest()->query->get('name');	   $Email =  $this->getRequest()->query->get('Email');	   $phone =  $this->getRequest()->query->get('phone');	   $message =  $this->getRequest()->query->get('message');	   	   $mail = \Swift_Message::newInstance()		->setSubject('contact d\'un membre')		->setFrom($Email)		->setTo('fw4256@gmail.com')		->setContentType('text/html')		->setBody('Expediteur :'.$name.'      '.'    telephone: '.$phone.'    '.'   contenu:   '.$message.''); 				if (! $this->get('mailer')->send($mail)) {					// Il y a eu un problème donc on traite l'erreur					throw new Exception('Le mail n\'a pas pu être envoyé');				}      $request->getSession()->getFlashBag()->add('notice', 'Message bien envoye.');      return $this->redirect($this->generateUrl('triv_core_homepage'));      }		public function newsletterAction(Request $request)   {	   $letter = new NewsLetter();       $mail = $this->getRequest()->request->get('m') ;	  $letter->setEmail($mail);      $em = $this->getDoctrine()->getManager();      $em->persist($letter);      $em->flush();      return $this->redirect($this->generateUrl('triv_core_homepage'));      }		}