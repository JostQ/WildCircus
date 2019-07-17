<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event", name="event_")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(EventRepository $eventRepository)
    {
        $events = $eventRepository->findAllOrderByDate();

        return $this->render('event/index.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show(Event $event)
    {
        return $this->render('event/show.html.twig', [
            'event' => $event
        ]);
    }
}
