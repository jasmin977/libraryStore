<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $this->Categorieload($manager);
        $this->Livreload($manager);
        $this->auteurload($manager);
    }

    private function Categorieload(ObjectManager $manager)
    {
        for ($i=0;$i<=7;$i++){
            $categorie = new Categorie();
            $categorie->setNom('category'.$i);
            $manager->persist($categorie);
            $this->addReference('categorie_'.$i,$categorie);
        }
        $manager->flush();
    }


    private function Livreload(ObjectManager $manager)
    {
        for ($i=1;$i<=7;$i++){

            $livre = new \App\Entity\Livre();
            $livre->settitre('titre'.$i);
            $livre->setannee(2020+$i);
            $cat =   $this->getReference("categorie_" . rand(0,7));
            $livre->setPrix(2000+$i);
            $livre->setEdition('Edition '.$i);
            $livre->setImage('Image'.$i);
            $livre->setCategorie($cat);
            $manager->persist($livre);

        }
        $manager->flush();
    }
    private function auteurload(ObjectManager $manager)
    {
        for ($i=1;$i<=7;$i++){
            $autreur = new Auteur();
            $autreur->setNom('auteur_'.$i);
            $autreur->setPrenom('prenom'.$i);

            $manager->persist($autreur);
        }

        $manager->flush();
    }


}
