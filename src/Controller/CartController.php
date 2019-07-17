<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart", name="cart_")
 * @IsGranted("ROLE_USER")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Session $session)
    {
        $items = $session->get('booking');
        $totalPrice = 0;
        if ($items){
            foreach ($items as $item) {
                $totalPrice += $item['event']->getPrice() * $item['quantity'];
            }
        }
        return $this->render('cart/index.html.twig', [
            'items' => $items,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * @Route("/add", name="add", methods={"POST"})
     */
    public function add(Request $request, EventRepository $eventRepository, Session $session) : Response
    {
        $event = $eventRepository->find($request->request->get('eventId'));

        if (empty($session->get('booking')[$event->getId()])) {
            $session->set('booking', [
                $event->getId() => [
                    'event' => $event,
                    'quantity' => 1
                ]
            ]);
        } else {
            $events = $session->get('booking');
            $quantity = $events[$event->getId()]['quantity'] + 1;
            $events[$event->getId()] = [
                'event' => $event,
                'quantity' => $quantity
            ];
            $session->set('booking', $events);
        }

        return $this->json([]);
    }

    /**
     * @Route("/{index}", name="delete", methods={"DELETE"})
     */
    public function delete(Session $session, $index)
    {
        $items = $session->get('booking');
        $items[$index]['quantity']--;
        if ($items[$index]['quantity'] === 0) {
            unset($items[$index]);
        }
        $session->set('booking', $items);
        return $this->json([]);
    }
}
