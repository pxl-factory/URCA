<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\UE;
use App\Entity\Module;
use DateTimeInterface;
use App\Entity\Bulletin;
use App\Entity\Etudiant;
use App\Entity\Semestre;
use App\Entity\TypeCours;
use App\Entity\Enseignant;
use App\Entity\Entreprise;
use App\Entity\NombreNote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BD extends Fixture
{
    public function load(ObjectManager $manager)
    {


        //Fixtures types cours
        $tp = new TypeCours();
        $tp->setNomCourt("TP")
        ->setNomComplet("Travaux Pratique")
        ;
        $manager->persist($tp);

        $td = new TypeCours();
        $td->setNomCourt("TD")
        ->setNomComplet("Travaux Dirigé")
        ;
        $manager->persist($td);

        $tps = new TypeCours();
        $tps->setNomCourt("TPS")
        ->setNomComplet("Devoir surveillé")
        ;
        $manager->persist($tps);


        //fixtures semestre
        $sem1 = new Semestre();
        $sem1->setNumSemestre(1);

        $manager->persist($sem1);

        $sem2 = new Semestre();
        $sem2->setNumSemestre(2);
        

        $manager->persist($sem2);

        $sem3 = new Semestre();
        $sem3->setNumSemestre(3);
        

        $manager->persist($sem3);

        $sem4 = new Semestre();
        $sem4->setNumSemestre(4);
        

        $manager->persist($sem4);


        //fixture UE
        $ue11 = new UE();
        $ue11->setNom("UE11 Intelligence Artificielle/Apprentissage profond.")
        ->setSemestre($sem1);
        $manager->persist($ue11);

        $ue12 = new UE();
        $ue12->setNom("UE12 Bases de donnees/Collecte et triage de donnees.")
        ->setSemestre($sem1);
        $manager->persist($ue12);
        
        $ue13 = new UE();
        $ue13->setNom("UE13 Analyse des donnees/Optimisation pour la classification.")
        ->setSemestre($sem1);
        $manager->persist($ue13);
        
        $ue14 = new UE();
        $ue14->setNom("UE14 Programmation Python/ Programmation R")
        ->setSemestre($sem1);
        $manager->persist($ue14);
        
        $ue15 = new UE();
        $ue15->setNom("UE15 Anglais/Communication.")
        ->setSemestre($sem1);
        $manager->persist($ue15);
       
        $ue16 = new UE();
        $ue16->setNom("Stage.")
        ->setSemestre($sem2);
        $manager->persist($ue16);

        $ue17 = new UE();
        $ue17->setNom("Stage.")
        ->setSemestre($sem4);
        $manager->persist($ue17);

        $ue18 = new UE();
        $ue18->setNom("Projet Tutoré.")
        ->setSemestre($sem4);
        $manager->persist($ue18);

        //fixture module

        $m1 = new Module();
        $m1->setNom("Introduction à la base de donnée.")
        ->setDescription("Permet d'acquérir les base de la base de donnée")
        ->setUE($ue12)
        ->addTypeCour($tp)
        ->addTypeCour($tps);
        $manager->persist($m1);
        
        $n1= new NombreNote();
        $n1->setnbNote(2)
        ->setRatio1erNote(3/4)
        ->setTypeCours($tp)
        ->setModule($m1);
        $manager->persist($n1);


        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tps)
        ->setModule($m1);
        $manager->persist($n1);



        $m2 = new Module();
        $m2->setNom("Analyse Merise/UML.")
        ->setDescription("Permet d'acquérir les base en analyse de base de donnée")
        ->setUE($ue13)
        ->addTypeCour($td)
        ->addTypeCour($tps);
        $manager->persist($m2);

        $n1= new NombreNote();
        $n1->setnbNote(3)
        ->setRatio1erNote(1/3)
        ->setTypeCours($tps)
        ->setModule($m2);
        $manager->persist($n1);
        $n1= new NombreNote();
        $n1->setnbNote(2)
        ->setRatio1erNote(2/3)
        ->setTypeCours($td)
        ->setModule($m2);
        $manager->persist($n1);




        $m3 = new Module();
        $m3->setNom("Introduction à l'algorithmique et à la programmation.")
        ->setDescription("Introduction à l'algorithmique et à la programmation")
        ->setUE($ue14)
        ->addTypeCour($tp)
        ->addTypeCour($tps)
        ->addTypeCour($td);
        $manager->persist($m3); 

        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tps)
        ->setModule($m3);
        $manager->persist($n1);
        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($td)
        ->setModule($m3);
        $manager->persist($n1);
        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m3);
        $manager->persist($n1);

        $m4 = new Module();
        $m4->setNom("Base de la programmation orienté objet")
        ->setDescription("Base de la programmation orienté objet")
        ->setUE($ue14)
        ->addTypeCour($tp)
        ->addTypeCour($tps)
        ->addTypeCour($td);
        $manager->persist($m4);

        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tps)
        ->setModule($m4);
        $manager->persist($n1);
        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($td)
        ->setModule($m4);
        $manager->persist($n1);
        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m4);
        $manager->persist($n1);


        $m5 = new Module();
        $m5->setNom("Communiquer en anglais")
        ->setDescription("Communiquer en anglais")
        ->setUE($ue15)
        ->addTypeCour($tp)
        ->addTypeCour($tps);
        $manager->persist($m5);


        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tps)
        ->setModule($m5);
        $manager->persist($n1);
  
        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m5);
        $manager->persist($n1);

        $m6 = new Module();
        $m6->setNom("Expression communication")
        ->setDescription("Expression communication")
        ->setUE($ue15)
        ->addTypeCour($tps)
        ->addTypeCour($td);
        $manager->persist($m6);

        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tps)
        ->setModule($m6);
        $manager->persist($n1);$n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($td)
        ->setModule($m6);
        $manager->persist($n1);

        $m7 = new Module();
        $m7->setNom("Stage Semestre 2")
        ->setDescription("Stage Semestre 2")
        ->setUE($ue16)
        ->addTypeCour($tp);
        $manager->persist($m7);


        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m7);
        $manager->persist($n1);

        $m8 = new Module();
        $m8->setNom("Stage Semestre 4")
        ->setDescription("Stage Semestre 4")
        ->setUE($ue17)
        ->addTypeCour($tp);
        $manager->persist($m8);

        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m8);
        $manager->persist($n1);

        $m9 = new Module();
        $m9->setNom("Projet Tutoré")
        ->setDescription("Projet Tutoré")
        ->setUE($ue18)
        ->addTypeCour($tp);
        $manager->persist($m9);

        $n1= new NombreNote();
        $n1->setnbNote(1)
        ->setRatio1erNote(1)
        ->setTypeCours($tp)
        ->setModule($m9);
        $manager->persist($n1);
       

    


        $manager->flush();


    }
}
