<?php

namespace Projet1\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class TestController extends Controller
{
    public function indexAction()
    {

	//	$user = $this->getUser();
	//	if (null === $user) {
  		// Ici, l'utilisateur est anonyme ou l'URL n'est pas derrière un pare-feu
	//	} else {
  	//	// Ici, $user est une instance de notre classe User
    //	$user->getUsername();
	//	}
        return $this->render('Projet1TestBundle:Default:index.html.twig');
    }

	public function LoginAction()
	{
	    $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
 	if ($_POST){
	 		return $this->render('Projet1TestBundle:Default:index.html.twig');
}
    	return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:login.html.twig', array(
	        'last_username' => null,
	        'error'         => null,
	        'csrf_token'    => $csrfToken
	    ));
	}
	public function DeleteAction(){

		$userManager = $this->get('fos_user.user_manager');

		//Recuperer le user 'TOTO':
		$user = $userManager->findUserBy(array('username' => 'toto'));

		//Delete User Recuperer:
		$userManager->deleteUser($user);
		return $this->render('Projet1TestBundle:Default:toto.html.twig');

    }
	public function UpdateAction(){
		$userManager = $this->get('fos_user.user_manager');

		//Recuperer le user 'TOTO':
		$user = $userManager->findUserBy(array('username' => 'toto'));
	    $user->setId('2');
		$userManager->updateUser($user); 
	}
}
