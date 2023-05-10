<?php

namespace App\Controller;

use App\Entity\Packinglist;
use App\Form\PackinglistType;
use App\Repository\PackinglistRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/packinglist')]
class PackinglistController extends AbstractController
{
    #[Route('/', name: 'app_packinglist_index', methods: ['GET'])]
    public function index(PackinglistRepository $packinglistRepository, TypeRepository $typeRepository): Response
    {
        return $this->render('packinglist/index.html.twig', [
            'packinglists' => $packinglistRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'app_packinglist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PackinglistRepository $packinglistRepository): Response
    {
        $packinglist = new Packinglist();
        $form = $this->createForm(PackinglistType::class, $packinglist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packinglistRepository->save($packinglist, true);

            return $this->redirectToRoute('app_packinglist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('packinglist/new.html.twig', [
            'packinglist' => $packinglist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_packinglist_show', methods: ['GET'])]
    public function show(Packinglist $packinglist): Response
    {
        return $this->render('packinglist/show.html.twig', [
            'packinglist' => $packinglist,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_packinglist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Packinglist $packinglist, PackinglistRepository $packinglistRepository): Response
    {
        $form = $this->createForm(PackinglistType::class, $packinglist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $packinglistRepository->save($packinglist, true);

            return $this->redirectToRoute('app_packinglist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('packinglist/edit.html.twig', [
            'packinglist' => $packinglist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_packinglist_delete', methods: ['POST'])]
    public function delete(Request $request, Packinglist $packinglist, PackinglistRepository $packinglistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $packinglist->getId(), $request->request->get('_token'))) {
            $packinglistRepository->remove($packinglist, true);
        }

        return $this->redirectToRoute('app_packinglist_index', [], Response::HTTP_SEE_OTHER);
    }
}
