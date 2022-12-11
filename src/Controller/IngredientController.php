<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{

    public function __construct(
        private IngredientRepository $ingredientRepository
    ) {}

    // READ CRUD

    #[Route('/ingredient', name: 'ingredient.index')]
    public function index(): Response
    {

        $ingredients = $this->ingredientRepository->findAll();

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }

    // CREATE

    #[Route('/ingredient/ajouter', name: 'ingredient.add')]
    public function add(Request $request): Response
    {
        // appeler le formType qui va construire le formulaire
        // envoyer le formulaire dans la vie

        $form = $this->createForm(IngredientType::class, new Ingredient);

        // verifier que le formulaire est soumis et est correct

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // recuperer les données du formulaire
    
            $ingredient = $form->getData();
    
            // envoyer dans la BDD
    
            $this->ingredientRepository->save($ingredient, true);

            return $this->redirectToRoute('ingredient.index');
        }


        return $this->render('ingredient/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // UPDATE
    
    #[Route('/ingredient/modifier/{id}', name: 'ingredient.update')]
    public function update(Ingredient $ingredient, Request $request): Response 
    {

        
        // Récupérer l'entité qu'on veut modifier : fait ==> $ingredient

        // Appeller le formulaire
        // Lier l'entité et le formulaire
        $form = $this->createForm(IngredientType::class, $ingredient);

        // Afficher le formulaire

        // Vérifier que le formulaire est valide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
    
            // Récupérer les nouvelles données
            $ingredient = $form->getData();
  
            // Remplacer les ancienens données par les nouvelles
            $this->ingredientRepository->save($ingredient, true);

            // Redirection vers tous les ingrédients
            return $this->redirectToRoute('ingredient.index');
        }

        return $this->render('ingredient/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // DELETE
    #[Route('/ingredient/supprimer/{id}', name: 'ingredient.delete')]
    public function delete(Ingredient $ingredient) 
    {
        $this->ingredientRepository->remove($ingredient, true);

        return $this->redirectToRoute('ingredient.index');
    }

}
