<?php

namespace App\Controller\Admin;

use App\Entity\Banque;
use App\Form\BanqueType;
use App\Repository\BanqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/banque")
 */
class BanqueController extends AdminSharedController
{
    /**
     * @var BanqueRepository;
     */
    private $banqueRepository;

    public function __construct(
        BanqueRepository $banqueRepository
    ) {
        $this->banqueRepository = $banqueRepository;
    }

    /**
     * @Route("/", name="banque_index", methods={"GET"})
     */
    public function index()
    {
        try {
            
            return $this->render($this->layoutAdmin, [
                'contenu' => 'admin/banque/index.html.twig',
                'banques' => $this->banqueRepository->findBy(['status' => true]),
                'current_menu' => 'current_banque',
            ]);
        } catch (\Throwable $th) {
            dd($th);
            die();
        }
    }

    /**
     * @Route("/new", name="banque_new", methods={"GET","POST"})
     */
    function new(Request $request): Response
    {
        try {
            $banque = new Banque();
            $form = $this->createForm(BanqueType::class, $banque);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $banque->setUserCreated($this->getUser());
                $entityManager->persist($banque);
                $entityManager->flush();
                $this->addFlash('success', 'Ajout banque: ' . $banque->getName() . " réussie");
                return $this->redirectToRoute('banque_index');
            }

            return $this->render($this->layoutAdmin, [
                'contenu' => 'admin/banque/new.html.twig',
                'banque' => $banque,
                'form' => $form->createView(),
                'action' => 'Ajouter',
                'current_menu' => 'current_banque',
            ]);
        } catch (\Throwable $th) {
            dd($th);
            die();
        }
    }

    /**
     * @Route("/{id}/edit", name="banque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, $id): Response
    {
        $banque = $this->banqueRepository->findOneBy(['id' => $id, 'status' => true]);
        if ($banque == null) {
            $this->addFlash('error', "echec cette banque n'existe pas ou bien n'est plus active");
            return $this->redirectToRoute("banque_index");
        }
        $form = $this->createForm(BanqueType::class, $banque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $banque->setUserCreated($this->getUser());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Modification banque ' . $banque->getName() . ' réussie');
            return $this->redirectToRoute('banque_index');
        }
        return $this->render($this->layoutAdmin, [
            'contenu' => 'admin/banque/edit.html.twig',
            'banque' => $banque,
            'form' => $form->createView(),
            'current_menu' => 'current_banque',
            'action' => 'Modification',
        ]);
    }

    /**
     * @Route("/{id}", name="banque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, $id): Response
    {
        $banque = $this->banqueRepository->findOneBy(['id' => $id, 'status' => true]);

        if ($banque == null) {
            $this->addFlash('error', "echec cette banque n'existe pas ou bien n'est plus active");
            return $this->redirectToRoute("banque_index");
        }

        if ($this->isCsrfTokenValid('delete' . $banque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $banque->setUserCreated($this->getUser());
            $banque->setStatus(false);
            $entityManager->flush();
            $this->addFlash('success', 'suppression banque: ' . $banque->getName() . " réussie");
        }

        return $this->redirectToRoute('banque_index');
    }
}
