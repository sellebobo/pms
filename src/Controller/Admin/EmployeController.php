<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Banque;
use App\Entity\Compte;
use App\Entity\Folder;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\CompteRepository;
use App\Repository\FolderRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/employe")
 */
class EmployeController extends AdminSharedController
{

    /**
     * @var UserRepository;
     */
    private $userRepository;

    /**
     * @var UserPasswordEncoderInterface;
     */
    private $encoder;

    /**
     * @var CompteRepository;
     */
    private $compteRepository;

    /**
     * @var FolderRepository;
     */
    private $folderRepository;

    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $encoder,
        FolderRepository $folderRepository,
        CompteRepository $compteRepository
    ) {
        $this->userRepository = $userRepository;
        $this->compteRepository = $compteRepository;
        $this->encoder = $encoder;
        $this->folderRepository = $folderRepository;
    }


    /**
     * @Route("/", name="employe_index", methods={"GET"})
     */
    public function index(): Response
    {
        try {

            return $this->render($this->layoutAdmin, [
                'contenu' => 'admin/employe/index.html.twig',
                'employes' => $this->userRepository->findBy(['status' => true]),
                'current_menu' => 'current_user',
                'current_sub_menu' => 'current_employe',
            ]);
        } catch (\Throwable $th) {
            dd($th);
            die();
        }
    }

    /**
     * @Route("/new", name="employe_new", methods={"GET","POST"})
     */
    function new(Request $request, EntityManagerInterface $em): Response
    {
        try {

            $em->getConnection()->beginTransaction();
            $employe = new User();
            $form = $this->createForm(UserType::class, $employe, [
                'type_form' => 'form_with_password',
            ]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $employe
                    ->setMatricule($this->userRepository->getMatricule())
                    ->setPassword($this->encoder->encodePassword($employe, $employe->getPassword()));
                $em->persist($employe);
                $em->flush();

                // Folder
                $folder = new Folder();
                $folder->setEmploye($employe);
                $em->persist($folder);
                $em->flush();

                $banque= $this->getDoctrine()->getRepository(Banque::class)->findOneBy(['name'=>'PMS']);
                if ($banque == null) {
                    $this->addFlash('error', 'Veuillez ajouter la banque par defaut PMS');
                    return $this->redirectToRoute('employe_index');
                }

                // savingAccount
                $savingAccount = (new Compte())->setNumCpte($this->BankNum());
                $savingAccount->setBanque($banque)->setType('SAVING')->setOpeningFees(0);
                $em->persist($savingAccount);
                $folder->addCompte($savingAccount);
                $em->flush();

                //currentAccount
                $currentAccount = (new Compte())->setNumCpte($this->BankNum());
                $currentAccount->setBanque($banque)->setType('CURRENT')->setOpeningFees(0);
                $em->persist($currentAccount);
                $folder->addCompte($currentAccount);
                $em->flush();

                $em->getConnection()->commit();
                $this->addFlash('success', 'Employé crée avec success');
                return $this->redirectToRoute('employe_index');
            }
            // $errors = (string) $form->getErrors(true, false);
            // dd($errors);
            return $this->render($this->layoutAdmin, [
                'contenu' => 'admin/employe/new.html.twig',
                'employe' => $employe,
                'form' => $form->createView(),
                'current_menu' => 'current_user',
                'current_sub_menu' => 'current_employe',
            ]);
        } catch (\Throwable $th) {
            $em->getConnection()->rollBack();
            dd($th);
            die();
        }
    }
}
