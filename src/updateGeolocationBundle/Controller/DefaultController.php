<?php

namespace updateGeolocationBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example

        $form = $this->createFormBuilder()
            ->setMethod('GET')
            ->add('search', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new length(['min' => 2])
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        $this->getDoctrine()

        if ($form->isSubmitted() && $form->isValid()){
            die('aquiiii');
        }

        return $this->render('updateGeolocationBundle:Default:index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
