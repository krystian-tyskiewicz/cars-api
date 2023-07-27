<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car extends Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    private ?string $vin = null;

    #[ORM\Column(length: 255)]
    private ?string $make = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(nullable: true)]
    private ?int $yearOfProduction = null;

    public function __construct($vin, $make, $model)
    {
        $this->vin = $vin;
        $this->make = $make;
        $this->model = $model;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function setMake(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getYearOfProduction(): ?int
    {
        return $this->yearOfProduction;
    }

    public function setYearOfProduction(?int $yearOfProduction): static
    {
        $this->yearOfProduction = $yearOfProduction;

        return $this;
    }

    public static function getRequiredFields(): array
    {
        return ['vin', 'make', 'model'];
    }

    public static function fromArray(array $data): static
    {
        $car = new static($data['vin'], $data['make'], $data['model']);

        if (array_key_exists('color', $data)) {
            $car->setColor($data['color']);
        }

        if (array_key_exists('yearOfProduction', $data)) {
            $car->setYearOfProduction($data['yearOfProduction']);
        }

        return $car;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'vin' => $this->vin,
            'make' => $this->make,
            'model' => $this->model,
            'color' => $this->color,
            'yearOfProduction' => $this->yearOfProduction,
        ];
    }
}
