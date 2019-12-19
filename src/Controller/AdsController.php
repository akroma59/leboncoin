<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Entity\Users;
use App\Form\AdsFormType;
use App\Repository\AdsRepository;
use App\Services\LanguagesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/ad", name="ads")
 */
class AdsController extends AbstractController
{
    /**
     * @Route("s", name=":index", methods={"HEAD","GET"})
     */
    public function index(AdsRepository $adsRepository)
    {
        $ads = $adsRepository->findAll();

        return $this->render('ads/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * @Route("", name=":create", methods={"HEAD","GET","POST"})
     */
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        // Check authenticated user
        $user = $this->getUser();
        
        $ad = new Ads;
        if (null === $user)
        {
            $this->addFlash('warning', "You must be loged to create a new ad !");
            return $this->redirectToRoute('login');
        }


        $form = $this->createForm(AdsFormType::class, $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = $validator->validate($ad);

            if ($form->isValid()) {
                $ad->setCreatedBy($user);
                $ad->setLanguage($user->setLanguage());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ad);
                $entityManager->flush();
    
                return $this->redirectToRoute('ads/index');
            }
           
        }

        $form->createView();
        
        return $this->render('ads/create.html.twig', [
            'adsForm' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name=":read", methods={"HEAD","GET"})
     */
    public function read()
    {
        return $this->render('ads/read.html.twig', [
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update", methods={"HEAD","GET","POST"})
     */
    public function update()
    {
        return $this->render('ads/update.html.twig', [
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete()
    {
        return $this->render('ads/delete.html.twig', [
        ]);
    }
}
