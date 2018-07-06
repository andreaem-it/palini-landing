<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends Controller
{
    /**
     * @Route("/",name="index")
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $this->render('base/index.html.twig');
    }
}