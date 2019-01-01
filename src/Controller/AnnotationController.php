<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Annotation;
use App\Form\AnnotationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/annotation")
 */
class AnnotationController extends AbstractController
{
    /**
     * @Route("/", name="annotation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $qb = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('a')
            ->from(Annotation::class, 'a')
            ->join('a.book', 'b')
            ->join('b.author', 'at')
            ->addOrderBy('at.lastName', 'asc')
            ->addOrderBy('a.page', 'asc')
        ;

        // Group annotations
        $annotations = $qb->getQuery()->getResult();
        $groupedAnnotations = [];
        $books = [];
        $authors = [];
        foreach($annotations as $annotation) {
            $authors[$annotation->getBook()->getAuthor()->getId()] = $annotation->getBook()->getAuthor();
            $books[$annotation->getBook()->getId()] = $annotation->getBook();
            $groupedAnnotations[$annotation->getBook()->getAuthor()->getId()][$annotation->getBook()->getId()][$annotation->getPage()] = $annotation;
        }  

        return $this->render('annotation/index.html.twig', [
            'annotations' => $annotations, 
            'groupedAnnotations' => $groupedAnnotations,
            'books' => $books,
            'authors' => $authors
        ]);

    }

    /**
     * @Route("/new", name="annotation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $annotation = new Annotation();
        if($request->query->get('bookId')) {
            $book = $this->getDoctrine()->getRepository(Book::class)->find($request->query->get('bookId'));            
            $annotation->setBook($book);
        }
        $form = $this->createForm(AnnotationType::class, $annotation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $annotation->setUser($this->getUser());
            $entityManager->persist($annotation);
            $entityManager->flush();

            return $this->redirectToRoute('annotation_index');
        }

        return $this->render('annotation/new.html.twig', [
            'annotation' => $annotation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{annotationId}", name="annotation_show", methods={"GET"})
     */
    public function show(Annotation $annotation): Response
    {
        $this->denyAccessUnlessGranted('view', $annotation);
        return $this->render('annotation/show.html.twig', ['annotation' => $annotation]);
    }

    /**
     * @Route("/{annotationId}/edit", name="annotation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annotation $annotation): Response
    {
        $this->denyAccessUnlessGranted('edit', $annotation);
        $form = $this->createForm(AnnotationType::class, $annotation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annotation_index', ['annotationId' => $annotation->getAnnotationId()]);
        }

        return $this->render('annotation/edit.html.twig', [
            'annotation' => $annotation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{annotationId}", name="annotation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Annotation $annotation): Response
    {
        $this->denyAccessUnlessGranted('delete', $annotation);
        if ($this->isCsrfTokenValid('delete'.$annotation->getAnnotationId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annotation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annotation_index');
    }
}
