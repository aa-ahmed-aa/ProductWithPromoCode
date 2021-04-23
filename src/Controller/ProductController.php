<?php

namespace App\Controller;

use App\Service\ProductService;
use App\Traits\ProductParseResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    use ProductParseResponseTrait;

    /** @var ProductService */
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @Route("/products", name="products")
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $paginator = $this->productService->getProductWithDiscount(
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        $products = $this->parse($paginator->getItems());
        return $this->json([
            "total" => $paginator->getTotalItemCount(),
            "currentPage" => $paginator->getCurrentPageNumber(),
            "items" => $products,
        ]);
    }
}
