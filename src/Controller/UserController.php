<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    private $em;
    private $userRepository;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->userRepository = $this->em->getRepository(User::class);
        $this->security = $security;
    }

    #[Route('/users/{id}', methods: ['GET'], name: 'show_user')]
    public function showUser($id): Response
    {
        $user = $this->userRepository->findBy(['id' => $id]);
        return $this->render('user/show.html.twig');
    }

    #[Route('/users/edit/{id}', name: 'edit_user')]
    public function editUser($id, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserInterface $currentUser): Response
    {
        $user = $this->userRepository->find($id);
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldPasswordProvided = $user->getPassword();
            $newPasswordProvided = $request->request->get('newPassword');
            $hashedOldPasswordProvided = $userPasswordHasher->hashPassword(
                $user,
                $oldPasswordProvided
            );
            dd($currentUser, $user, $oldPasswordProvided, $hashedOldPasswordProvided, $newPasswordProvided);
            exit;

            if ($currentUser->getPassword() == $hashedOldPasswordProvided) {
                $user->setEmail($form->get('email')->getData());
                $user->setPassword($newPasswordProvided);
                $this->em->flush();
                return $this->redirectToRoute('show_user');
            } else {
                return $this->render('/user/edit.html.twig', [
                    'errorMessage' => "Passwords do not match!",
                    'form' => $form->createView()
                ]);
            }
        }

        return $this->render('/user/edit.html.twig', [
            'errorMessage' => "",
            'form' => $form->createView()
        ]);
    }

    #[Route('/users/admin/manage', methods: ['GET'], name: 'manage_app')]
    public function manageApplication(): Response
    {
        $users = $this->userRepository->findAll();
        $events = $this->em->getRepository(Event::class)->findAll();
        $categories = $this->em->getRepository(Category::class)->findAll();
        return $this->render('admin/manage.html.twig', [
            "users" => $users,
            "events" => $events,
            "categories" => $categories
        ]);
    }

    #[Route('users/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_user')]
    public function delete($id): Response
    {
        $user = $this->userRepository->find($id);
        if (!$this->contains("ROLE_ADMIN", $user->getRoles())) {
            $this->em->remove($user);
            $this->em->flush();
        }
        return $this->redirectToRoute('events');
    }

    function contains($str, array $arr)
    {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false) return true;
        }
        return false;
    }
}
