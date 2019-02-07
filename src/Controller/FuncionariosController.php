<?php

namespace App\Controller;

use App\Entity\Funcionarios;
use App\Form\FuncionariosType;
use App\Repository\FuncionariosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/funcionarios")
 */
class FuncionariosController extends AbstractController
{
    /**
     * @Route("/", name="funcionarios_index", methods={"GET"})
     */
    public function index(FuncionariosRepository $funcionariosRepository): Response
    {
        return $this->render('funcionarios/index.html.twig', [
            'funcionarios' => $funcionariosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="funcionarios_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $funcionario = new Funcionarios();
        $form = $this->createForm(FuncionariosType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($funcionario);
            $entityManager->flush();
            return $this->redirectToRoute('funcionarios_index');
        }

        return $this->render('funcionarios/new.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="funcionarios_show", methods={"GET"})
     */
    public function show(Funcionarios $funcionario): Response
    {

        //dump($funcionario->getImagem());

        return $this->render('funcionarios/show.html.twig', [
            'funcionario' => $funcionario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="funcionarios_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Funcionarios $funcionario): Response
    {
        $form = $this->createForm(FuncionariosType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('funcionarios_index', [
                'id' => $funcionario->getId(),
            ]);
        }

        return $this->render('funcionarios/edit.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="funcionarios_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Funcionarios $funcionario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$funcionario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($funcionario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('funcionarios_index');
    }
    
}
