<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            
        ]);
    }

    #[Route('/new', name:'new_pro')]
    public function new(EntityManagerInterface $em, ProductRepository $proRepo): JsonResponse
    {
        $pro = new Product();

        $pro->setName('name'.mt_rand(5, 78));

        $em->persist($pro);
        $em->flush();

        return $this->json([
            'id' => $pro->getId(),
            'name' => array_map(function(Product $ele){
                return $ele->getName();
            }, $proRepo->findAll())
        ]);
    }
}
