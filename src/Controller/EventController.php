<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{

    private $em;
    private $eventRepository;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->eventRepository = $this->em->getRepository(Event::class);
        $this->security = $security;
    }

    #[Route('/events', methods: ['GET'], name: 'events')]
    public function index(): Response
    {
        $events = $this->eventRepository->findBy(['user' => $this->security->getUser()], ['date' => 'ASC']);
        return $this->render('events/index.html.twig', [
            "events" => $events
        ]);
    }

    #[Route('/events/create', name: 'create_event')]
    public function create(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newEvent = $form->getData();
            $newEvent->setUser($this->security->getUser());
            $imagePath = $form->get('imagePath')->getData();

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

                $newEvent->setImagePath('/uploads/' . $newFileName);
            }

            $this->em->persist($newEvent);
            $this->em->flush();

            return $this->redirectToRoute('events');
        }

        return $this->render('events/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/events/edit/{id}', name: 'edit_event')]
    public function edit($id, Request $request): Response
    {
        $event = $this->eventRepository->find($id);
        $form = $this->createForm(EventFormType::class, $event);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($event->getImagePath() != null) {
                    if (file_exists($this->getParameter('kernel.project_dir') . $event->getImagePath())) {
                        $this->getParameter('kernel.project_dir') . $event->getImagePath();
                    }
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
                    }

                    $event->setImagePath('/uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('events');
                }
            } else {
                $event->setName($form->get('name')->getData());
                $event->setDate($form->get('date')->getData());
                $event->setDescription($form->get('description')->getData());
                $event->setCategory($form->get('category')->getData());

                $this->em->flush();
                return $this->redirectToRoute('events');
            }
        }

        return $this->render('/events/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView()
        ]);
    }

    #[Route('events/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_event')]
    public function delete($id): Response
    {
        $event = $this->eventRepository->find($id);
        $this->em->remove($event);
        $this->em->flush();

        return $this->redirectToRoute('events');
    }

    #[Route('/events/{id}', methods: ['GET'], name: 'show_event')]
    public function show($id): Response
    {
        $event = $this->eventRepository->find($id);
        return $this->render('events/show.html.twig', [
            "event" => $event
        ]);
    }
}
