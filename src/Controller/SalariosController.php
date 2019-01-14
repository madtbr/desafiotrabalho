<?php

namespace App\Controller;

use App\Entity\Salarios;
use App\Form\SalariosType;
use App\Repository\SalariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salarios")
 */
class SalariosController extends AbstractController
{
    /**
     * @Route("/", name="salarios_index", methods={"GET"})
     */
    public function index(SalariosRepository $salariosRepository): Response
    {
        return $this->render('salarios/index.html.twig', [
            'salarios' => $salariosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="salarios_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salario = new Salarios();
        $form = $this->createForm(SalariosType::class, $salario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salario);
            $entityManager->flush();

            return $this->redirectToRoute('salarios_index');
        }

        return $this->render('salarios/new.html.twig', [
            'salario' => $salario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salarios_show", methods={"GET"})
     */
    public function show(Salarios $salario): Response
    {
        return $this->render('salarios/show.html.twig', [
            'salario' => $salario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salarios_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salarios $salario): Response
    {
        $form = $this->createForm(SalariosType::class, $salario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salarios_index', [
                'id' => $salario->getId(),
            ]);
        }

        return $this->render('salarios/edit.html.twig', [
            'salario' => $salario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salarios_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salarios $salario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salarios_index');
    }
}
