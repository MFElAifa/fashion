<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Look;
use App\Entity\Season;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    private const BRANDS = [
        'Louis Vuitton',
        'Balmain',
        'Isabel Marant',
        'Miu Miu',
        'Hermès',
        'Dolce & Gabbana',
        'Fendi',
        'Mugler'
    ];

    private const SEASONS = [
        'Spring/Summer 2024',
        'Fall/Winter 2023'
    ];

    private const LOOKS = [
        ['https://cdn.tag-walk.com/view/louisvuittonss240001-dbd17e58eaa23aaf6968.JPG','Spring/Summer 2024','Louis Vuitton','beige;dress;belt'],
        ['https://cdn.tag-walk.com/view/louisvuittonss240019-80c2cc92f92e430b37a9.JPG','Spring/Summer 2024','Louis Vuitton','black;hoodie;bag'],
        ['https://cdn.tag-walk.com/view/balmainss240004-de56114c4b991391ce54.JPG','Spring/Summer 2024','Balmain','black;dress;hoes'],
        ['https://cdn.tag-walk.com/view/balmainss240020-5f533474afa3b0b84612.JPG','Spring/Summer 2024','Balmain','white;dress;flowers'],
        ['https://cdn.tag-walk.com/view/isabelmarantss240011-4d84a08e54594729e4bd.JPG','Spring/Summer 2024','Isabel Marant','red;dress'],
        ['https://cdn.tag-walk.com/view/isabelmarantss240019-05b0c98255a9a90e76ea.JPG','Spring/Summer 2024','Isabel Marant','white;pants'],
        ['https://cdn.tag-walk.com/view/miimiuss240058-a72c2cb81a850a9c006c.JPG','Spring/Summer 2024','Miu Miu','blue;shorts;skirt'],
        ['https://cdn.tag-walk.com/view/hermesss240025-b7a95f77d941b30dfce6.jpg','Spring/Summer 2024','Hermès','white;skirt;bra'],
        ['https://cdn.tag-walk.com/view/hermesss240045-f4253478bba2daa8bff4.jpg','Spring/Summer 2024','Hermès','red;coat'],
        ['https://cdn.tag-walk.com/view/dolcegabbanaaw230009-5a3fb41ae19d8368afb0.JPG','','Dolce & Gabbana','black;coat;sunglasses'],
        ['https://cdn.tag-walk.com/view/dolcegabbanaaw230029-73824cfd6b084c6bfa0e.JPG','Fall/Winter 2023','Dolce & Gabbana','black;coat;fur'],
        ['https://cdn.tag-walk.com/view/fendiaw230021-ec055fb28edc15b47881.JPG','Fall/Winter 2023','Fendi','white;dress'],
        ['https://cdn.tag-walk.com/view/mugleraw230031-62855bb6.jpg','Fall/Winter 2023','Mugler','black;dress;boots'],
    ];
    
    private const USERS = [
        [
            'username' => 'antoine_gury',
            'email' => 'admin@tagwalk.com',
            'fullName' => 'Antoine Gury',
            'password' => 'tagwalk123#',
            'roles' => [User::ROLE_EMPLOYE],
            'brand' => 'Louis Vuitton'
        ],
        [
            'username' => 'john_petter',
            'email' => 'john@tagwalk.com',
            'fullName' => 'John Petter',
            'password' => 'tagwalk123#',
            'roles' => [User::ROLE_EMPLOYE],
            'brand' => 'Dolce & Gabbana'
        ],
        [
            'username' => 'will_smith',
            'email' => 'rob@tagwalk.com',
            'fullName' => 'Will Smith',
            'password' => 'tagwalk123#',
            'roles' => [User::ROLE_EMPLOYE],
            'brand' => 'Balmain'
        ],
        [
            'username' => 'jenny_rowling',
            'email' => 'jenny@tagwalk.com',
            'fullName' => 'Jenny Rowling',
            'password' => 'tagwalk123#',
            'roles' => [User::ROLE_USER],
            'brand' => 'Isabel Marant'
        ],
        [
            'username' => 'test_test',
            'email' => 'test@tagwalk.com',
            'fullName' => 'TEST TEST',
            'password' => 'tagwalk123#',
            'roles' => [User::ROLE_USER],
            'brand' => 'Isabel Marant'
        ]
    ];

    public function __construct(private SluggerInterface $slugger,private UserPasswordHasherInterface $passwordHasher)
    {
        
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadBrands($manager);
        $this->loadSeasons($manager);
        $this->loadLooks($manager);
        $this->loadUsers($manager);
    }

    private function loadLooks(ObjectManager $em)
    {
        foreach(self::LOOKS as $row){
            if(empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3])) continue;
            $look = new Look();
            $look->setPicture($row[0])
                ->setSeason($this->getReference($row[1]))
                ->setBrand($this->getReference($row[2]))
                ->setTags($row[3]);
            
            $em->persist($look);
        }

        $em->flush();
    }

    private function loadBrands(ObjectManager $em)
    {
        foreach(self::BRANDS as $name){
            $brand = new Brand();
            $brand->setName($name)
                  ->setSlug($this->slugger->slug($name));
            
            $this->addReference($name, $brand);
            $em->persist($brand);
        }

        $em->flush();
    }

    private function loadSeasons(ObjectManager $em)
    {
        foreach(self::SEASONS as $name){
            $season = new Season();
            $season->setName($name)
                  ->setSlug($this->slugger->slug($name));
            
            $this->addReference($name, $season);
            $em->persist($season);
        }

        $em->flush();
    }
    
    private function loadUsers(ObjectManager $em)
    {
        foreach(SELF::USERS as $userFixture){
            $user = new User();
            $user->setUsername($userFixture['username']);
            $user->setEmail($userFixture['email']);
            $user->setFullName($userFixture['fullName']);
            $hashPassword = $this->passwordHasher->hashPassword($user, $userFixture['password']);
            $user->setPassword($hashPassword);
            $user->setRoles($userFixture['roles']);
            
            $user->addBrand($this->getReference($userFixture['brand']));
            

            $em->persist($user);
        }

        $em->flush();
    }
}
