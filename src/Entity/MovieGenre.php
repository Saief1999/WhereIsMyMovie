<?php

namespace App\Entity;

use App\Repository\MovieGenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MovieGenreRepository::class)
 */
class MovieGenre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("moviegenre:list")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("moviegenre:list")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=RegisteredUser::class, mappedBy="favoriteGenres")
     */
    private $registeredUsers;

    public function __construct()
    {
        $this->registeredUsers = new ArrayCollection();
    }

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

    /**
     * @return Collection|RegisteredUser[]
     */
    public function getRegisteredUsers(): Collection
    {
        return $this->registeredUsers;
    }

    public function addRegisteredUser(RegisteredUser $registeredUser): self
    {
        if (!$this->registeredUsers->contains($registeredUser)) {
            $this->registeredUsers[] = $registeredUser;
            $registeredUser->addFavoriteGenre($this);
        }

        return $this;
    }

    public function removeRegisteredUser(RegisteredUser $registeredUser): self
    {
        if ($this->registeredUsers->contains($registeredUser)) {
            $this->registeredUsers->removeElement($registeredUser);
            $registeredUser->removeFavoriteGenre($this);
        }

        return $this;
    }
}
