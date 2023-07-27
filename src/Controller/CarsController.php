<?php

namespace App\Controller;

use App\Entity\Car;
use App\Service\Form;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarsController extends AbstractController
{
    public function list(EntityManagerInterface $entityManager): Response
    {
        $cars = $entityManager->getRepository(Car::class)->findAll();
        return $this->json($cars);
    }

    public function get(EntityManagerInterface $entityManager, int $id): Response
    {
        $car = $entityManager->getRepository(Car::class)->findById($id);

        if (!$car) {
            return $this->json(null, JsonResponse::HTTP_NOT_FOUND);
        }

        return $this->json($car);
    }

    public function add(
        Request $request,
        Form $form,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $data = $request->toArray();
        $missingFields = $form->validateRequiredFields($data, Car::getRequiredFields());
        
        if ($missingFields) {
            return $this->json(
                ['requiredFields' => $missingFields],
                JsonResponse::HTTP_BAD_REQUEST,
            );
        }

        $car = Car::fromArray($data);
        $errors = $form->validate($car);

        if ($errors) {
            return $this->json($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->json($entityManager->getRepository(Car::class)->save($car));
    }

    public function update(
        Request $request,
        Form $form,
        EntityManagerInterface $entityManager,
        int $id,
    ): Response
    {
        $repository = $entityManager->getRepository(Car::class);
        $car = $repository->findById($id, false);
        $car->update($request->toArray());

        $errors = $form->validate($car);

        if ($errors) {
            return $this->json($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        return $this->json($entityManager->getRepository(Car::class)->save($car));
    }

    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $repository = $entityManager->getRepository(Car::class);
        $car = $repository->findById($id, false);

        if (!$car) {
            return $this->json(null, JsonResponse::HTTP_NOT_FOUND);
        }

        $repository->delete($car);

        return $this->json(['id' => $id]);
    }
}
