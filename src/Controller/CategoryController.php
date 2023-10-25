<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private $em;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->categoryRepository = $this->em->getRepository(Category::class);
    }

    #[Route('/categories/create', name: 'create_category')]
    public function create(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $newCategory = $form->getData();
            $imagePath = $form->get('imagePath')->getData();
            $color = $form->get('color')->getData();
            $newCategory->setColor($color);

            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();
                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
                }

                $newCategory->setImagePath('/uploads/' . $newFileName);
            }

            $this->em->persist($newCategory);
            $this->em->flush();

            return $this->redirectToRoute('manage_app');
        }

        return $this->render('categories/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('categories/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_category')]
    public function delete($id): Response
    {
        $event = $this->categoryRepository->find($id);
        $this->em->remove($event);
        $this->em->flush();

        return $this->redirectToRoute('manage_app');
    }
}
