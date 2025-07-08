<?php

namespace App\Infrastructure\Http\Controller;

use App\Shared\Utils\TokenValidatorService;

use App\Application\Service\CreateProductUseCase;
use App\Domain\Repository\ProductRepositoryInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    private CreateProductUseCase $createProductUseCase;
    private ProductRepositoryInterface $productRepository;

    private TokenValidatorService $tokenValidator;

    public function __construct(
        CreateProductUseCase $createProductUseCase,
        ProductRepositoryInterface $productRepository,
        TokenValidatorService $tokenValidator
        ) {
        $this->createProductUseCase = $createProductUseCase;
        $this->productRepository = $productRepository;
        $this->tokenValidator = $tokenValidator;
    }

    #[Route('/products', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $this->tokenValidator->validate($request);

        $data = json_decode($request->getContent(), true);

        try {
            $product = $this->createProductUseCase->execute($data['name'], (float) $data['price'],$data['taxRate']);
            return new JsonResponse([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate(),
            ], Response::HTTP_CREATED);
        } catch (\InvalidArgumentException $e) { // Puedes crear excepciones de dominio más específicas
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    #[Route('/products', methods: ['GET'])]
    public function getAllProducts(): JsonResponse
    {
        $products = $this->productRepository->findAll();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate(),
                'finalPrice' => $product->getFinalPrice(),
            ];
        }

        return new JsonResponse($data);
    }
}