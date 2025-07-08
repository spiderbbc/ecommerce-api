<?php

namespace App\Infrastructure\Http\Controller;

use App\Shared\Utils\TokenValidatorService;

use App\Application\Service\CreateProductUseCase;
use App\Application\Service\SearchProductsUseCase;
use App\Shared\DTO\PaginatedResponseDTO;
use App\Application\DTO\CreateProductRequestDTO;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    private CreateProductUseCase $createProductUseCase;
    private SearchProductsUseCase $searchProductsUseCase;

    private TokenValidatorService $tokenValidator;

    public function __construct(
        CreateProductUseCase $createProductUseCase,
        SearchProductsUseCase $searchProductsUseCase,
        TokenValidatorService $tokenValidator
        ) {
        $this->createProductUseCase = $createProductUseCase;
        $this->searchProductsUseCase = $searchProductsUseCase;
        $this->tokenValidator = $tokenValidator;
    }

    #[Route('/products', methods: ['POST'])]
    public function createProduct(Request $request): JsonResponse
    {
        $this->tokenValidator->validate($request);
        $data = json_decode($request->getContent(), true);

        try {
            $productRequest = new CreateProductRequestDTO($data);
            $product = $this->createProductUseCase->execute(
                $productRequest->name, 
                $productRequest->price, 
                $productRequest->taxRate
            );
            return new JsonResponse([
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate(),
                'finalPrice' => $product->getFinalPrice(),
            ], Response::HTTP_CREATED);
        } catch (\InvalidArgumentException $e) { // Puedes crear excepciones de dominio más específicas
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    #[Route('/products', methods: ['GET'])]
    public function getAllProducts(Request $request): JsonResponse
    {
        $name = $request->query->get('name');
        $page = (int) $request->query->get('page', 1) ?? 1;
        $limit = (int) $request->query->get('limit', 10) ?? 10;
        

        $result = $this->searchProductsUseCase->execute($name, $page, $limit);

        $data = [];
        foreach ($result['products'] as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'taxRate' => $product->getTaxRate(),
                'finalPrice' => $product->getFinalPrice(),
            ];
        }
        $responseDTO = new PaginatedResponseDTO(
            $data,
            $result['total'],
            $page,
            $limit
        );
        return new JsonResponse($responseDTO->toArray());
    }
}