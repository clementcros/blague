<?php

namespace AdminBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AdminBundle\Entity\Blague;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
     /**
     * @Route("/add")
     */
      public function newBlague(Request $request)
     
    {
        // je crée un nouvelle objet blague  
        $blague = new blague();
        // je récupère mon formulaire stocker dans BlagueType
        $form = $this->createForm('AdminBundle\Form\BlagueType', $blague);
        // je lie mon formulaire avec des champs
        $form->handleRequest($request);
        // on appelle l'entity manager ( em=diminutif )
         $em = $this->getDoctrine()->getManager();
         // Condition du formulaire 
        if ($form->isSubmitted() && $form->isValid()) {
           // je sauvegarde
            $em->persist($blague);
            //on le push
            $em->flush($blague);
           
            
            
        }
        // on récupère tous les champs de la table Blague
         $blague = $em -> getRepository('AdminBundle:Blague') ->findAll();
        // on retourne la vue
        return $this->render('default\new.html.twig', array(
            // on rend disponible la variable blague dans la vue
            'blague' => $blague,
            //on rend disponible la variable form dans la vue
            'form' => $form->createView(),
            
        ));

    
    }
}
