<?php

namespace Projet1\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBudle\Doctrine\UserManager;
use Symfony\Component\HttpFoundation\Response;

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
        $is_admin = false;
        $roles = $this->container->get('security.context')->getToken()->getUser()->getRoles();
        if(is_array($roles))
        {
            if (in_array("ROLE_ADMIN", $roles)) {
                $is_admin = true;
                return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:index.html.twig', array(
                    'is_admin' => $is_admin
                ));
            }

        }
        return $this->render('Projet1TestBundle:Default:index.html.twig', array(
            'is_admin' => $is_admin
        ));
    }

	public function LoginAction()
	{
	    $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');
    	return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:login.html.twig', array(
	        'last_username' => null,
	        'error'         => null,
	        'csrf_token'    => $csrfToken
	    ));
	}


    public function ChangePasswordAction()
    {
        return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:ChangePassword.html.twig');
    }

    public function AdminAction()
    {
        $repository = $this->getDoctrine()->getRepository('Projet1TestBundle:User');
        $info = $repository->findAll();
       return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:Admin.html.twig', array(
           'info' => $info
       ));
    }

    public function showProfilAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:show.html.twig', array(
            'user' => $user
        ));
    }

    public function EditProfilAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        return $this->container->get('templating')->renderResponse('Projet1TestBundle:Default:edit.html.twig', array(
            'user' => $user
        ));
    }

	public function DeleteAction($id){

		$userManager = $this->get('fos_user.user_manager');

		$user = $userManager->findUserBy(array('id' => $id));
        if($user) {
            //Delete User Recuperer:
            $userManager->deleteUser($user);
        }
        $repository = $this->getDoctrine()->getRepository('Projet1TestBundle:User');
        $info = $repository->findAll();
		return $this->render('Projet1TestBundle:Default:Admin.html.twig', array(
            'info' => $info
        ));

    }

//	public function UpdateAction(){
//		$userManager = $this->get('fos_user.user_manager');
//
//		//Recuperer le user 'TOTO':
//		$user = $userManager->findUserBy(array('username' => 'toto'));
//	    $user->setId('2');
//		$userManager->updateUser($user);
//	}
}
