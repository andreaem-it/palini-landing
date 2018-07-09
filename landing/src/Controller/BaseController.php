<?php
namespace App\Controller;

use App\Entity\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends Controller
{
    /**
     * @Route("/{slug}",name="index")
     * @throws \Exception
     */
    public function index($slug)
    {
        //if ($id) {
            $items = $this->getDoctrine()->getRepository(Items::class)->findBy(['slug' => $slug]);


            $images = explode(';',$items[0]->getImagePath());

            return $this->render('base/index.html.twig', [
                'items' => $items,
                'images' => $images
            ]);
       /* } else {
            $this->createNotFoundException('Articolo non trovato!');

        }*/

    }
}