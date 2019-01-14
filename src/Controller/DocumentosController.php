<?php

namespace App\Controller;

use App\Entity\Documentos;
use App\Form\DocumentosType;
use App\Repository\DocumentosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/documentos")
 */
class DocumentosController extends AbstractController
{
    /**
     * @Route("/", name="documentos_index", methods={"GET"})
     */
    public function index(DocumentosRepository $documentosRepository): Response
    {
        return $this->render('documentos/index.html.twig', [
            'documentos' => $documentosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="documentos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $documento = new Documentos();
        $form = $this->createForm(DocumentosType::class, $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($documento);
            $entityManager->flush();

            return $this->redirectToRoute('documentos_index');
        }

        return $this->render('documentos/new.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="documentos_show", methods={"GET"})
     */
    public function show(Documentos $documento): Response
    {
        return $this->render('documentos/show.html.twig', [
            'documento' => $documento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="documentos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Documentos $documento): Response
    {
        $form = $this->createForm(DocumentosType::class, $documento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documentos_index', [
                'id' => $documento->getId(),
            ]);
        }

        return $this->render('documentos/edit.html.twig', [
            'documento' => $documento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="documentos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Documentos $documento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($documento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('documentos_index');
    }
}
