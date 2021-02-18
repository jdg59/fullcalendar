<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(CalendarRepository $calendar): Response
    {
        $events = $calendar->findAll();
        $rdvs = [];
        foreach($events as $events){
            $rdvs[]= [
                'id'=>$events->getId(),
                'start'=>$events->getStart()->format('Y-m-d H:i:s'),
                'end'=>$events->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitle(),
                'description'=>$events->getDescription(),
                'backgroundColor'=>$events->getBackgroundColor(),
                'borderColor'=>$events->getBorderColor(),
                'textColor'=>$events->getTextColor(),
                'allDay'=>$events->getAllDay(),
            ];
        }
        $data = json_encode($rdvs);
        return $this->render('main/index.html.twig', compact('data'));
    }
}
