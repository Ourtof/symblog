<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{

    public function __construct(
        private IngredientRepository $ingredientRepository
    ) {}

    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(): Response
    {
        // appelle le repository : fait
        // appelle les ingrédients : fait
        // on veut tous les ingrédients : fait

        $ingredients = $this->ingredientRepository->findAll();

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }
}
