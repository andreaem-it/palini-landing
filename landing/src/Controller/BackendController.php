<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BackendController extends Controller {


    /**
     * @Route("admin/login/", name="admin_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {


        return $this->render('backend/login.html.twig');
    }

    /**
     * @Route("admin",name="admin")
     */
    public function admin() {
        return $this->render('backend/dashboard.html.twig');
    }
}