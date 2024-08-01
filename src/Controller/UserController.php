<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\Questions;
use App\Entity\Review;
use App\Entity\User;
use App\Form\OrdersType;
use App\Form\QuestionsType;
use App\Form\ReviewType;
use App\Form\UserType;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
 

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {   
       

        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
           
        ]);
    }

    // #[Route('/myorders', name: 'app_orders_index', methods: ['GET'])]
    // public function indexOrder(OrdersRepository $ordersRepository): Response
    // {
    //     return $this->render('orders/index.html.twig', [
    //         'orders' => $ordersRepository->findAll(),
    //     ]);
    // }



    // #[Route('/order', name: 'app_orders_new', methods: ['GET', 'POST'])]
    // public function addToCart(ProductRepository $productRepository, UserRepository $userRepository, $id, Product $product, Request $request , EntityManagerInterface $entityManager): Response
    // {   
    //     // $user =$this->getUser();
    //     // $order = new Orders();
    //     // $order->setUser($user);
    //     // $order->setProduct($product);
    //     $user =$this->getUser();
    //     $order = new Orders();
    //     $form = $this->createForm(OrdersType::class, $order);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($order);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('order/index.html.twig', [
    //         'order' => $order,
    //         'form' => $form,
    //     ]);

       
    // }


    #[Route('/order/{id}', name: 'app_orders', methods: ['GET','POST'])]
    public function AddToCart(Request $request, EntityManagerInterface $entityManager, Product $product): Response
    {
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);
        $now = new \DateTime('now');
    
        

        
            $user =$this->getUser();
            $order = new Orders();
            $order->setUser($user);
            $order->setProduct($product);
            $order->setDateTime($now);


            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('app_orders_index', [], Response::HTTP_SEE_OTHER);
        

       
    }








       
    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        $user =$this->getUser();
        return $this->render('user/show.html.twig', [
            'user' => $user,
            $user =$this->getUser(),
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->flush();

            return $this->redirectToRoute('app_homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/question/{id}', name: 'app_questions', methods: ['GET','POST'])]
    public function addQuestion(Request $request, EntityManagerInterface $entityManager, Product $product): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $question->setUser($user);
            $question->setProduct($product);

            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('app_questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('questions/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/review/{id}', name: 'app_reviews', methods: ['GET','POST'])]
    public function addReview(Request $request, EntityManagerInterface $entityManager, Product $product): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $review->setUser($user);
            $review->setProduct($product);

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('app_orders_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('review/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}





