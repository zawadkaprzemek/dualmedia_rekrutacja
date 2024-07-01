<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product', name: 'app_product_')]
class ProductController extends AbstractController
{
    public function __construct(protected readonly ProductRepository $productRepository)
    {
    }

    #[Route('/list', name: 'list')]
    public function index(): JsonResponse
    {
        $products = $this->productRepository->findAll();

        return $this->json([
            'products' => $products,
            Response::HTTP_OK,
            [],
            ['groups' => 'product:read']
        ]);
    }
}
