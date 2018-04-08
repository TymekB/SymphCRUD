<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 3,
     *     max = 255,
     *     minMessage = "Name must be at least {{ limit }} characters long",
     *     maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     *
     */
    private $name;

    /**
     * @ORM\Column(type="decimal")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "Price must be at least {{ limit }}$",
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 0,
     *      max = 9999,
     *      minMessage = "Quantity be at least {{ limit }}",
     *      maxMessage = "Quantity cannot be greater than {{ limit }}"
     * )
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=11)
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"available", "unavailable"}, message="Choose a valid option.")
     */
    private $status;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
