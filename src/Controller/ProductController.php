<?php

namespace App\Controller;

use App\Entity\Product;
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
     */
    public function create()
    {
        return $this->render('Product/create.html.twig');
    }

    /**
     * @Route("/product/update/{id}", name="product_update")
     * @param $id
     * @return Response
     */
    public function update($id)
    {
        return $this->render('Product/edit.html.twig');
    }

    /**
     * @Route("/product/delete/{id}", name="product_delete")
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        return new Response("Delete product {$id}");
    }
}
