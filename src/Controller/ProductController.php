<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/product/list", name="product_list")
     */
    public function list()
    {
        $doctrineManager = $this->getDoctrine()->getRepository(Product::class);
        $products = $doctrineManager->findAll();

        return $this->render('Product/list.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/product/create", name="product_create")http://localhost:8000/product/list#
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('price', NumberType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('quantity', NumberType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('status', ChoiceType::class, ['choices' => ['Available' => 'available', 'Unavailable' => "unavailable"], 'attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('create', SubmitType::class, ['label' => 'Create', 'attr' => ['class' => 'btn btn-primary']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute("product_list");
        }

        return $this->render('Product/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/product/update/{id}", name="product_update")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->findOneBy(['id' => $id]);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('price', NumberType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('quantity', NumberType::class, ['attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('status', ChoiceType::class, ['choices' => ['Available' => 'available', 'Unavailable' => "unavailable"], 'attr' => ['class' => 'form-control'], 'error_bubbling' => true])
            ->add('update', SubmitType::class, ['label' => 'Update', 'attr' => ['class' => 'btn btn-success']])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute("product_list");
        }

        return $this->render('Product/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['id' => $id]);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_list');
    }
}
