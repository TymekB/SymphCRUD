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
        return new Response("Products list");
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function create()
    {
        return new Response("Create product form");
    }

    /**
     * @Route("/product/update/{id}", name="product_update")
     * @param $id
     * @return Response
     */
    public function update ($id)
    {
        return new Response("Edit product {$id}");
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
