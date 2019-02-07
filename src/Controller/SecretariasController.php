<?php

namespace App\Controller;

use App\Entity\Secretarias;
use App\Form\SecretariasType;
use App\Repository\SecretariasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/secretarias")
 */
class SecretariasController extends AbstractController
{
    /**
     * @Route("/", name="secretarias_index", methods={"GET"})
     */
    public function index(SecretariasRepository $secretariasRepository): Response
    {
        return $this->render('secretarias/index.html.twig', [
            'secretarias' => $secretariasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="secretarias_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $secretaria = new Secretarias();
        $form = $this->createForm(SecretariasType::class, $secretaria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($secretaria);
            $entityManager->flush();

            return $this->redirectToRoute('secretarias_index');
        }

        return $this->render('secretarias/new.html.twig', [
            'secretaria' => $secretaria,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretarias_show", methods={"GET"})
     */
    public function show(Secretarias $secretaria): Response
    {
        return $this->render('secretarias/show.html.twig', [
            'secretaria' => $secretaria,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="secretarias_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Secretarias $secretaria): Response
    {
        $form = $this->createForm(SecretariasType::class, $secretaria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secretarias_index', [
                'id' => $secretaria->getId(),
            ]);
        }

        return $this->render('secretarias/edit.html.twig', [
            'secretaria' => $secretaria,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secretarias_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Secretarias $secretaria): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secretaria->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($secretaria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('secretarias_index');
    }
}
