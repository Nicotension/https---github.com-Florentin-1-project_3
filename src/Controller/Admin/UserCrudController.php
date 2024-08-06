<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $banAction = Action::new('banFor24Hours', 'Ban for 24 hours')
            ->linkToCrudAction('banFor24Hours')
            ->addCssClass('btn btn-warning');

        return $actions
            ->add(Crud::PAGE_INDEX, $banAction)
            ->add(Crud::PAGE_EDIT, $banAction);
    }

    #[Route('/admin/user/ban/{id}', name: 'admin_user_ban_for_24_hours')]
    public function banFor24Hours(EntityManagerInterface $entityManager, int $id): RedirectResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        if ($user) {
            $user->setBannedUntil(new \DateTime('+24 hours'));
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password')->onlyOnForms(),
            TextField::new('fname'),
            TextField::new('lname'),
            TextField::new('phone'),
            DateField::new('dateOfBirth'),
            BooleanField::new('isBanned')
        ];
    }
}




// namespace App\Controller\Admin;

// use App\Entity\User;
// use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
// use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

// class UserCrudController extends AbstractCrudController
// {
//     public static function getEntityFqcn(): string
//     {
//         return User::class;
//     }

    
//     public function configureFields(string $pageName): iterable
//     {
//         return [
//             EmailField::new('email'),
//             TextField::new('password'),
//             TextField::new('fname'),
//             TextField::new('lname'),
//             TextField::new('phone'),
//             DateField::new('dateOfBirth'),
//             BooleanField::new('isBanned'),
//         ];
//     }
    
// }
