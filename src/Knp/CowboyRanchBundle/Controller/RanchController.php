<?php

namespace Knp\CowboyRanchBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\CowboyRanchBundle\Entity\Cow;
use Knp\CowboyRanchBundle\Form\Type\CowType;
use Knp\CowboyRanchBundle\Form\Model\CowAdd;

/**
 * @author Pierre PLAZANET <pierre.plazanet@knplabs.com>
 **/

class RanchController extends Controller
{
    
    public function indexAction()
    {
        $form = $this->createForm(
            new CowType(new CowAdd())
        );

        return $this->render('KnpCowboyRanchBundle::index.html.twig', array( 
            'cows' => $this->container->get('knp_cowboyranch.ranch')->getCows(),
            'form' => $form->createView(),
            'cow_limit' => $this->container->getParameter('ranch_cow_limit'),
        ));
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(
            new CowType(new CowAdd())
        );
        $form->bindRequest($request);

        if($form->isValid()){
            $newCow = new Cow();
            $newCow->setName($form['name']->getData());
            $this->container->get('knp_cowboyranch.ranch')->add($newCow);
        }else{
            throw new \Exception('The form data is invalid');
        }

        return $this->redirect($this->generateUrl(
            '_home'
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $cow = $this->container->get('knp_cowboyranch.ranch')->getCow($id);

        if(null !== $cow){
            $this->container->get('knp_cowboyranch.ranch')->remove($cow);
        }

        return $this->redirect($this->generateUrl(
            '_home'
        ));
    }

}