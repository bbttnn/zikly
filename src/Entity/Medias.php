<?php

namespace App\Entity;

use App\Repository\MediasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediasRepository::class)
 */
class Medias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="medias")
     */
    private $UserProfile;

    /**
     * @ORM\Column(type="text")
     */
    private $Legend;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Audio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Video;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLegend(): ?string
    {
        return $this->Legend;
    }

    public function setLegend(string $Legend): self
    {
        $this->Legend = $Legend;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->Path;
    }

    public function setPath(string $Path): self
    {
        $this->Path = $Path;

        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->Audio;
    }

    public function setAudio(string $Audio): self
    {
        $this->Audio = $Audio;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->Video;
    }

    public function setVideo(string $Video): self
    {
        $this->Video = $Video;

        return $this;
    }
}
