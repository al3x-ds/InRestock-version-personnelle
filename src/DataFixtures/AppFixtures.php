<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Stock;
use App\Entity\Product;
use Cocur\Slugify\Slugify;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $em)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=0; $i < 5 ; $i++) { 
            $product = new Product();
            $product->setName('Product'.$i.'');
            
            $slugify = new Slugify();
            $slug = $slugify->slugify($product->getName());
            $product->setSlug($slug);
            $em->persist($product);

            $stock = new Stock();
            $stock->setStock(15);
            $stock->setProduct($product);
            $em->persist($stock);
        }

        $roleAdmin = new Role();
        $roleAdmin->setCode("ROLE_ADMIN").
        $roleAdmin->setName("Admin");
        $em->persist($roleAdmin);

        $roleUser = new Role();
        $roleUser->setCode("ROLE_USER");
        $roleUser->setName("Utilisateur");
        $em->persist($roleUser);


        $admin = new User();
        $admin->setName("admin");
        $admin->setUsername("admin");
        $admin->setEmail("admin@admin.fr");
        $hash = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPassword($hash);
        $admin->setRole($roleAdmin);
        $em->persist($admin);

        $user = new User();
        $user->setName("user");
        $user->setUsername("user");
        $user->setEmail("user@user.fr");
        $hash = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($hash);
        $user->setRole($roleUser);        
        $em->persist($user);

        $em->flush();
    }
}
