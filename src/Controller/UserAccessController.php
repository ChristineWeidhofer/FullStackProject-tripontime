<?php

namespace App\Controller;

use App\Entity\Accommodation;
use App\Entity\Activity;
use App\Entity\Features;
use App\Entity\Restaurant;
use App\Repository\FeaturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user')]

class UserAccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_user_access')]
    public function index(): Response
    {


        return $this->render('user_access/index.html.twig', [
            'controller_name' => 'UserAccessController',
        ]);
    }

    #[Route('/profile', name: 'app_user_profile', methods: ['GET'])]
    public function indexProfile(): Response
    {
        $features = $this->entityManager->getRepository(Features::class)->findAll();

        // Create an empty array to hold the restaurants for each Features entity
        $restaurantsByFeatures = [];
        $accommodationsByFeatures = [];
        $activitiesByFeatures = [];

        // Loop over the Features entities and retrieve the associated restaurants
        foreach ($features as $feature) {
            $restaurantsByFeatures[$feature->getId()] = $feature->getMyrestaurants();
            $accommodationsByFeatures[$feature->getId()] = $feature->getMytrip();
            $activitiesByFeatures[$feature->getId()] = $feature->getMyactivities();
        }



        return $this->render('user_access/profile.html.twig', [
            'features' => $features,
            'restaurantsByFeatures' => $restaurantsByFeatures,
            'accommodationByFeatures' => $accommodationsByFeatures,
            'activitiesByFeatures' => $activitiesByFeatures,
            'controller_name' => 'UserProfileController',
            'user' => $this->getUser(),
        ]);
    }


    #[Route('restaurant/{id}', name: 'app_restaurant_show', methods: ['GET'])]
    public function showRestaurant(Restaurant $restaurant): Response
    {
        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }


    #[Route('accommodation/{id}', name: 'app_accommodation_show', methods: ['GET'])]
    public function showAccommodation(Accommodation $accommodation): Response
    {
        return $this->render('accommodation/show.html.twig', [
            'accommodation' => $accommodation,
        ]);
    }


    #[Route('activity/{id}', name: 'app_activity_show', methods: ['GET'])]
    public function showActivity(Activity $activity): Response
    {
        return $this->render('activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    #[Route('/newtrip', name: 'app_features_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FeaturesRepository $featuresRepository): Response
    {
        $feature = new Features();
        // $form = $this->createForm(Features::class, $feature);
        // $form->handleRequest($request);
        $feature->setFkUser($this->getUser());

        $featuresRepository->save($feature, true);

        return $this->redirectToRoute('features_filter', [], Response::HTTP_SEE_OTHER);
    }
}
