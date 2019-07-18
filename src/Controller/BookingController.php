<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

/**
 * @Route("/booking", name="booking_")
 * @IsGranted("ROLE_USER")
 */
class BookingController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $bookings = $this->getUser()->getBooking();
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookings
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"POST"})
     */
    public function add(Session $session, EventRepository $eventRepository, EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $tickets = $session->get('booking');

        if (empty($session->get('booking'))) {
            $this->addFlash('danger', 'Cart empty');
            return $this->redirectToRoute('cart_index');
        }

        foreach ($tickets as $key => $ticket) {
            $booking = new Booking();
            $event = $eventRepository->find((int)$key);

            $booking->setQuantity($ticket['quantity']);
            $booking->setEvent($event);
            $booking->setUser($this->getUser());

            $entityManager->persist($booking);
        }

        $entityManager->flush();

        $mailer->sendMail($tickets, $this->getUser()->getEmail(), 'Order Confirmation', 'booking');

        $this->addFlash('success', 'You validated your cart !');

        return $this->redirectToRoute('booking_index');
    }
}
