<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DatabaseFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function  __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $objectManager)
    {
        $subject1 = new Subject();
        $subject1->setName('Teoretyczne Podstawy Informatyki');
        $subject1->setDescription('Poznasz wszystkie runy śródziemia znane przez największego maga, jakgiego zna ten świat.');

        $subject2 = new Subject();
        $subject2->setName('Medody Numeryczne');
        $subject2->setDescription('Kontynuacja tajemnej nauki z naciskiem na krasnoludzkie runy III ery.');

        $type1 = new Type();
        $type1->setName('Wykład');

        $type2 = new Type();
        $type2->setName('Ćwiczenia');

        $type3 = new Type();
        $type3->setName('Laboratoria');

        $type4 = new Type();
        $type4->setName('Seminarium');

        $type5 = new Type();
        $type5->setName('Szkolenie');

        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setPassword($this->userPasswordEncoder->encodePassword($user1, 'admin'));
        $user1->setRoles('ROLE_ADMIN');

        $user2 = new User();
        $user2->setUsername('janek');
        $user2->setPassword($this->userPasswordEncoder->encodePassword($user2, '123'));
        $user2->setRoles('ROLE_TEACHER');

        $user3 = new User();
        $user3->setUsername('tomek');
        $user3->setPassword($this->userPasswordEncoder->encodePassword($user3, '123'));
        $user3->setRoles('ROLE_TEACHER');

        $user4 = new User();
        $user4->setUsername('marcin');
        $user4->setPassword($this->userPasswordEncoder->encodePassword($user4, '123'));
        $user4->setRoles('ROLE_USER');

        $user5 = new User();
        $user5->setUsername('edek');
        $user5->setPassword($this->userPasswordEncoder->encodePassword($user5, '123'));
        $user5->setRoles('ROLE_USER');

        $objectManager->persist($subject1);
        $objectManager->persist($subject2);

        $objectManager->persist($type1);
        $objectManager->persist($type2);
        $objectManager->persist($type3);
        $objectManager->persist($type4);
        $objectManager->persist($type5);

        $objectManager->persist($user1);
        $objectManager->persist($user2);
        $objectManager->persist($user3);
        $objectManager->persist($user4);
        $objectManager->persist($user5);

        $objectManager->flush();
    }
}
