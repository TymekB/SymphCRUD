<?php

namespace App\Controller;

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
        return $this->render('Product/list.html.twig');
    }

    /**
     * @Route("/product/create", name="product_create")
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
