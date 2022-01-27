<?php

namespace App\Entity;


use App\Entity\Image;
use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserProfileRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=UserProfileRepository::class)
 */
class UserProfile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $User;

    /**
     * @ORM\Column(type="text")
     */
    private $Biography;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity=Medias::class, mappedBy="UserProfile")
     */
    private $medias;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

   

  
   
    public function __construct()
   {
       $this->medias = new ArrayCollection();
      $this->image = new ArrayCollection();
     // $this->categories = new ArrayCollection();
     // $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->Biography;
    }

    public function setBiography(string $Biography): self
    {
        $this->Biography = $Biography;

        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }



    /**
     * @return Collection|Medias[]
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Medias $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setUserProfile($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getUserProfile() === $this) {
                $media->setUserProfile(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

   
   
}
