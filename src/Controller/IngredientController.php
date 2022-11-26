<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{

    public function __construct(
        private IngredientRepository $ingredientRepository
    ) {}

    // READ CRUD

    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(): Response
    {

        $ingredients = $this->ingredientRepository->findAll();

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }

    // CREATE

    #[Route('/ingredient/ajouter', name: 'ingredient.add')]
    public function add(): Response
    {
        // appeler le formType qui va construire le formulaire : fAIT
        // envoyer le formulaire dans la vie

        $form = $this->createForm(IngredientType::class, new Ingredient);

        // verifier que le formulaire est soumis et est correct
        // recuperer les données du formulaire
        // envoyer dans la BDD

        return $this->render('ingredient/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
