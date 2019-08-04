<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(BookRepository $bookRepository)
    {
        $books = $bookRepository->getLatestWithLimit(15);

        return $this->render('app/home.html.twig', [
            'books' => $books,
        ]);
    }
}
