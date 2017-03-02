<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
     /**
     * @Route("/")
     */
    public function indexAction()
    {   
        $entityManager = $this -> getDoctrine();
        $blague = $entityManager -> getRepository('AdminBundle:Blague') ->findAll();
        return $this->render('default/caca.html.twig', array(
            'blague' => $blague));
    }
}
