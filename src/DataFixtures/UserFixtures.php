<?php
namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
 
public function __construct(UserPasswordHasherInterface $hasher)
  {
      $this->hasher = $hasher;
  }

  public function load(ObjectManager $manager)
  {
      $user = new User();
      $user->setEmail("user@gmail.com");
      $user->setFname("user");
      $user->setLname("test");
      $user->setPhone("1234567");
      $dateOfBirth = new \DateTime('2000-01-01');
      $user->setDateOfBirth($dateOfBirth);
      $password = $this->hasher->hashPassword($user, '123456');
      $user->setPassword($password);

      $manager->persist($user);
      $manager->flush();
  }
}
