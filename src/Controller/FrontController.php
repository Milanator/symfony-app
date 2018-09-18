<?php

namespace App\Controller;

use App\Entity\TodoItem;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends AbstractController {

    public function index() {
        $items = $this->getDoctrine()->getRepository(TodoItem::class)->findAll();

        return $this->render('front/index.html.twig', [
            'items' => $items
        ]);
    }

    public function item(Request $request, $id) {

        $itemData = $this->getDoctrine()->getRepository(TodoItem::class)->find($id);

        $form = $this->createFormBuilder($itemData)
            ->add('description', TextType::class, ['label' => 'hovno'])
            ->add('dateTime', DateType::class)
            // ->add('isDone', )
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $itemData      = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemData);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        
        return $this->render('front/item.html.twig', [
            'itemForm' => $form->createView(),
            'item'     => $itemData
        ]);
    }

    public function newItem(Request $request) {

        $item = new TodoItem();
        $form = $this->createForm(UserType::class,$item);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){

            $form = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form);
            $entityManager->flush();

            return $this->redirectToRoute('newItem');
        }

        return $this->render('front/newItem.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteItem(Request $request) {

        $id = json_decode($request->getContent(), true)['itemId'];

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(TodoItem::class);
        $product = $repository->findOneBy(array('id' => $id));

        $em->remove($product);
        $em->flush();
        return new Response('succesfull');
    }

    public function isDone(Request $request) {

        $id = json_decode($request->getContent(), true)['itemId'];
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(TodoItem::class);
        $item = $repository->find($id);
        $item->setIsDone($item->getIsDone() == 1 ? 0 : 1);
        $em->flush();

        return new Response($item->getIsDone() ? 1 : 0);
    }


}
