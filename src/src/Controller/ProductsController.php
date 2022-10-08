<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request, int $id, SerializerInterface $serializer): Response
    {
        if ($request->headers->has('Force-fail')) {
            return new JsonResponse(
                ['error' => 'Promotion error.'],
                $request->headers->get('Force-fail')
            );
        }

        /** @var LowestPriceEnquiry $lowestPriceEnquiry */
        $lowestPriceEnquiry = $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        $lowestPriceEnquiry->setDiscountedPrice(50);
        $lowestPriceEnquiry->setPrice(100);
        $lowestPriceEnquiry->setPromotionId(3);
        $lowestPriceEnquiry->setPromotionName('Discount');

        return new JsonResponse($lowestPriceEnquiry, Response::HTTP_OK);

        dd($lowestPriceEnquiry);

        return new JsonResponse([
            "quantity" => 5,
            "request_location" => "UK",
            "voucher_code" => "s5df",
            "request_date" => "2022-04-04",
            "product_id" => $id
        ], Response::HTTP_OK);
    }

    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {
    }
}