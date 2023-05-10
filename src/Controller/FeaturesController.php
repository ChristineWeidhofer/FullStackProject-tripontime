<?php

namespace App\Controller;

use App\Entity\Features;
use App\Form\FeaturesType;
use App\Repository\FeaturesRepository;

use App\Entity\Accommodation;
use App\Entity\Activity;
use App\Entity\Location;
use App\Entity\Packinglist;
use App\Entity\Preferences;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/features')]
class FeaturesController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/showall/test", name="show_features")
     */
    public function features(Request $request): Response
    {

        // Retrieve all the countries
        $countries = $this->entityManager->getRepository(Location::class)->getAllCountries();
        // dd($countries);
        // Retrieve the selected country (if any) from the query parameters
        $selectedCountry = null; // Initialize the variable
        if (isset($_GET['country'])) {
            $selectedCountry = $_GET['country'];
        }

        $preferences = $this->entityManager->getRepository(Preferences::class)->getAllPreferences();
        // dd($preferences);
        $selectedPreferences = null; // Initialize the variable
        if (isset($_GET['name'])) {
            $selectedPreferences = $_GET['name'];
        }


        // Retrieve the Location entity for the selected country
        $location = $this->entityManager->getRepository(Location::class)->findOneBy(['country' => $selectedCountry]);

        // Retreive the preferences entity for the sleected activity

        $preferences = $this->entityManager->getRepository(Preferences::class)->findOneBy(['name' => $selectedPreferences]);
        // Retrieve the accommodations filtered by the Location entity
        $accommodations = $this->entityManager->getRepository(Accommodation::class)->findBy(['location' => $location]);

        // Retrieve the restaurants filtered by the Location entity
        $restaurants = $this->entityManager->getRepository(Restaurant::class)->findBy(['location' => $location]);

        // Retrieve the activities filtered by the Location entity
        $activities = $this->entityManager->getRepository(Activity::class)->findBy(['location' => $location]);

        // Retrieve the packing list of the activities 

        $packinglists = $this->entityManager->getRepository(Packinglist::class)->findBy(['fk_preferences' => $preferences]);

        return $this->render('features/showfeatures.html.twig', [
            'countries' => $countries,
            'selectedCountry' => $selectedCountry,
            'accommodations' => $accommodations,
            'restaurants' => $restaurants,
            'activities' => $activities,
            'packinglists' => $packinglists,
            'selectedPreferences' => $selectedPreferences,
        ]);
    }

    #[Route('/filter', name: 'features_filter')]
    public function filter(Request $request): Response
    {
        // Retrieve the selected country from the form submission
        if ($request->request->get('country')) {
            $selectedCountry = $request->request->get('country');
        } else {
            $selectedCountry = 'Austria';
        }

        if ($request->request->get('name')) {
            $selectedPreferences = $request->request->get('name');
        } else {
            $selectedPreferences = '--Select a Preference--';
        }


        // Retrieve the accommodations, restaurants, and activities filtered by country (if a country is selected)
        $accommodations = $this->entityManager->getRepository(Accommodation::class)->findByCountry($selectedCountry);
        $restaurants = $this->entityManager->getRepository(Restaurant::class)->findByCountry($selectedCountry);
        $activities = $this->entityManager->getRepository(Activity::class)->findByCountry($selectedCountry);

        //Retreive all packinglist items by preference (if a preference is selected)
        $packinglists = $this->entityManager->getRepository(Packinglist::class)->findByPreferences($selectedPreferences);


        return $this->render('features/showfeatures.html.twig', [
            'accommodations' => $accommodations,
            'restaurants' => $restaurants,
            'activities' => $activities,
            'selectedCountry' => $selectedCountry,
            'packinglists' => $packinglists,
            'selectedPreferences' => $selectedPreferences,
        ]);
    }

    #[Route('/', name: 'app_features_index', methods: ['GET'])]
    public function index(FeaturesRepository $featuresRepository): Response
    {
        return $this->render('features/index.html.twig', [
            'features' => $featuresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_features_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FeaturesRepository $featuresRepository): Response
    {
        $feature = new Features();
        // $form = $this->createForm(Features::class, $feature);
        // $form->handleRequest($request);
        $feature->setFkUser($this->getUser());

        $featuresRepository->save($feature, true);

        return $this->redirectToRoute('app_features_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}', name: 'app_features_show', methods: ['GET'])]
    public function show(Features $feature): Response
    {
        return $this->render('features/show.html.twig', [
            'feature' => $feature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_features_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FeaturesRepository $featuresRepository, $id): Response
    {
        $feature = $featuresRepository->find($id);
        $form = $this->createForm(FeaturesType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $featuresRepository->save($feature, true);

            return $this->redirectToRoute('app_features_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('features/edit.html.twig', [
            'feature' => $feature,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_features_delete', methods: ['POST'])]
    public function delete(Request $request, FeaturesRepository $featuresRepository, $id): Response
    {
        $feature = $featuresRepository->find($id);

        if ($this->isCsrfTokenValid('delete' . $feature->getId(), $request->request->get('_token'))) {
            $featuresRepository->remove($feature, true);
        }

        return $this->redirectToRoute('app_features_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/addAccomodation/{id}', name: 'app_add_accomodation', methods: ['GET'])]
    public function addAccomodation(FeaturesRepository $featuresRepository, Accommodation $acco)
    {
        $ourTrip = $featuresRepository->findBy(["fk_user" => $this->getUser()]);
        if ($ourTrip) {
            $current = end($ourTrip)->addMytrip($acco);
            $featuresRepository->save($current, true);
        } else {
            $feature = new Features();
            $feature->setFkUser($this->getUser());
            $feature->addMytrip($acco);
            $featuresRepository->save($feature, true);
        }



        // dd($ourTrip, $current, $acco);

        return $this->redirectToRoute('features_filter');
    }


    #[Route('/addActivities/{id}', name: 'app_add_activity', methods: ['GET'])]
    public function addActivities(FeaturesRepository $featuresRepository, Activity $act)
    {
        $ourTrip = $featuresRepository->findBy(["fk_user" => $this->getUser()]);
        if ($ourTrip) {
            $current = end($ourTrip)->addMyactivity($act);
            $featuresRepository->save($current, true);
        } else {
            $feature = new Features();
            $feature->setFkUser($this->getUser());
            $feature->addMyactivity($act);
            $featuresRepository->save($feature, true);
        }


        return $this->redirectToRoute('features_filter');
    }


    #[Route('/addRestaurants/{id}', name: 'app_add_restaurant', methods: ['GET'])]
    public function something(FeaturesRepository $featuresRepository, Restaurant $resta)
    {
        $ourTrip = $featuresRepository->findBy(["fk_user" => $this->getUser()]);
        if ($ourTrip) {
            $current = end($ourTrip)->addMyrestaurant($resta);
            $featuresRepository->save($current, true);
        } else {
            $feature = new Features();
            $feature->setFkUser($this->getUser());
            $feature->addMyrestaurant($resta);
            $featuresRepository->save($feature, true);
        }

        return $this->redirectToRoute('features_filter');
    }
}
