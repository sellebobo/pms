<?php

namespace App\Controller\Admin;


use App\Repository\ClientRepository;
use App\Repository\CompteRepository;
use App\Repository\FolderRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\AdminSharedController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/client")
 */
class ClientController extends AdminSharedController
{
     /**
     * @var ClientRepository;
     */
    private $clientRepository;

    /**
     * @var CompteRepository;
     */
    private $compteRepository;

    /**
     * @var FolderRepository;
     */
    private $folderRepository;

    public function __construct(
        ClientRepository $clientRepository,
        FolderRepository $folderRepository,
        CompteRepository $compteRepository
    ) {
        $this->clientRepository = $clientRepository;
        $this->compteRepository = $compteRepository;
        $this->folderRepository = $folderRepository;
    }


    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(): Response
    {
        try {
            return $this->render($this->layoutAdmin, [
                'contenu' => 'admin/client/index.html.twig',
                'clients' => $this->clientRepository->findBy(['status' => true]),
                'current_menu' => 'current_user',
                'current_sub_menu' => 'current_client',
            ]);
        } catch (\Throwable $th) {
            dd($th);
            die();
        }
    }

        /**
     * @Route("/dossier/{id}/show", name="client_show", methods={"GET"})
     */
    public function show($id): Response
    {
        $client = $this->userRepository->findOneBy(['id' => $id, 'status' => true]);
        //dd($client);
        if ($client == null) {
            $this->addFlash('error', "Echec cet client a été archivé");
            return $this->redirectToRoute('client_index');
        }
       
    
        return $this->render($this->layoutAdmin, [
            'contenu' => 'admin/client/show.html.twig',
            'client' => $client,
            'current_menu' => 'current_user',
            'current_sub_menu' => 'current_client',
        ]);
    }
}
