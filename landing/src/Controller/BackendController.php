<?php

namespace App\Controller;



use App\Entity\Items;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BackendController extends Controller {


    /**
     * @Route("admin/login/", name="admin_login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
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

    /**
     * @Route("admin/articles", name="admin_articles")
     */
    public function adminArticles(Request $request) {

        $items = $this->getDoctrine()->getRepository(Items::class)->findAll();

        $item = new Items();

        $form = $this->createFormBuilder($item)
            ->setMethod('POST')
            ->add('title', TextType::class, array('attr' => ['class' => 'form-control']))
            ->add('image_path', TextType::class, array('attr' => ['class' => 'form-control']))
            ->add('description', TextType::class, array('attr' => ['class' => 'form-control']))
            ->add('link', TextType::class, array('attr' => ['class' => 'form-control']))
            ->add('expiration', DateType::class)
            ->add('submit', SubmitType::class, array('label' => 'Salva', 'attr' => ['class' => 'btn btn-success']))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('admin_articles');
        }

        return $this->render('backend/articles.html.twig', [
            'form' => $form->createView(),
            'items' => $items
        ]);
    }

    /**
     * @Route("admin/articles/delete/{id}", name="admin_articles_delete")
     */
    public function adminArticleDelete($id ) {


        $item = $this->getDoctrine()->getRepository(Items::class)->find($id);

        if (!$item) {
            throw $this->createNotFoundException('No item found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();

        return $this->redirectToRoute('admin_articles');
    }

    /**
     * @Route("admin/articles/{id}", name="admin_articles_view")
     */
    public function adminArticleView($id) {

        $item = $this->getDoctrine()->getRepository(Items::class)->find($id);


        return $this->render('', [
            'item' => $item
        ]);

    }
}