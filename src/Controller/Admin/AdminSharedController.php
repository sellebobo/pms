<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSharedController extends AbstractController
{
    public $layoutAdmin = "admin/layout/content.html.twig";

    public function getRenderCustomiz($content, $params = [])
    {
        $result = ["content" => $content] + $params;
        if (!isset($result['current_sub_menu'])) {
            $result['current_sub_menu'] = "";
        }
        return $this->render($this->layoutAdmin, $result);
    }

    public function getIdentity()
    {
        return md5(uniqid() . mt_rand());
    }

    public function  BankNum()
    {
        // $r1 = mt_rand(0, 10);
        // $r2 = mt_rand(0, 10);
        // $start .= strval($r1) . "" . strval($r2);

        // $count = 0;
        // $n = 0;

        // for ($i = 0; $i < 12; $i++) {
        //     if ($count == 4) {
        //         $start .= " ";
        //         $count = 0;
        //     } else {
        //         $n = mt_rand(0, 10);
        //         $start .= strval($n);
        //         $count++;
        //     }
        // }

        $start =strtoupper ( bin2hex((random_bytes(7))));

        return $start;
    }
}
