<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\AdminSharedController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AdminSharedController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function index(): Response
    {
        return $this->getRenderCustomiz('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
