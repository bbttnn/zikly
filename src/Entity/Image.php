<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserProfile;

    public function getId(): ?int
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

    public function getUserProfile(): ?UserProfile
    {
        return $this->UserProfile;
    }

    public function setUserProfile(?UserProfile $UserProfile): self
    {
        $this->UserProfile = $UserProfile;

        return $this;
    }
}
