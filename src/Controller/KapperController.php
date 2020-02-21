<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 2-2-2020
 * Time: 08:27
 */

namespace App\Controller;


use App\Entity\Behandeling;
use DateTime;
use MongoDB\BSON\Decimal128;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KapperController extends AbstractController
{
    /**
     * @Route("/", name="kapper_home")
    */
    public function homeAction()
    {
        $date = new DateTime(date('Y-m-d')); //per week worden drie records bijgehouden
        $week = $date->format("W");
        $behandelingen = $this->getDoctrine()->getRepository(Behandeling::class)->findBy(
            [
                'week'=>$week
            ]
        );
        if(count($behandelingen) == 0)
        {
            $this->fillWeek($week); // als voor deze week nog geen behandelingen zijn toegevoegd, worden ze aangemaakt.
        }

        $omzet = 0;
        foreach  ($behandelingen as $behandeling )
        {
            $omzet = $omzet + ($behandeling->getPrijs() * $behandeling->getAantal());
        }
        return $this->render('kapper/home.html.twig', [
            'behandelingen'=>$behandelingen,
            'omzet'=>$omzet,
            'week'=>$week
        ]);
    }

    private function fillWeek($week)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $behandeling = new Behandeling('knippen', 7.50, $week);
        $entityManager->persist($behandeling);
        $behandeling = new Behandeling('scheren',12,  $week);
        $entityManager ->persist($behandeling);
        $behandeling = new Behandeling('kleuren',35.75,  $week);
        $entityManager->persist($behandeling);
        $entityManager->flush();
    }

    /**
     * @Route("/behandeling/opslaan/{naam}", name="behandeling_opslaan")
     */
    public function behandelingOpslaanAction(string $naam)
    {
        $date = new DateTime(date('Y-m-d')); //per week worden drie records bijgehouden
        $week = $date->format("W");
        $behandeling = $this->getDoctrine()->getManager()->getRepository(Behandeling::class)->findOneBy([
            'week'=>$week,
            'naam'=>$naam
        ]);
        $behandeling->setAantal($behandeling->getAantal() + 1);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($behandeling);
        $entityManager->flush();


        return $this->RedirectToRoute('kapper_home');

    }

}