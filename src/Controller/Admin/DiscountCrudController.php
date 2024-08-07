<?php

namespace App\Controller\Admin;

use App\Entity\Discount;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;

class DiscountCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Discount::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            PercentField::new('percentage')
                ->setLabel('Discount (%)')
                ->setHelp('Enter the discount percentage')
                ->setNumDecimals(0)
                ->setStoredAsFractional(false),
            DateTimeField::new('startDate'),
            DateTimeField::new('endDate'),
            AssociationField::new('product')
        ];
    }
}
