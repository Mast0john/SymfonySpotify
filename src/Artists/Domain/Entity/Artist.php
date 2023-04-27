<?php

declare(strict_types=1);

namespace App\Artists\Domain\Entity;

use App\Customers\Domain\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Uid\UuidV4;

#[Entity]
class Artist
{
    #[Id, Column(type: 'uuid')]
    private string $id;

    #[Column(length: 255)]
    private ?string $name = null;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'artists')]
    private ?User $user = null;

    #[ManyToMany(targetEntity: Song::class, inversedBy: 'artists')]
    private ?Collection $songs;

    #[OneToMany(mappedBy: 'artist', targetEntity: Album::class)]
    private ?Collection $albums;

    public function __construct()
    {
        $this->id = (string) (new UuidV4());
        $this->songs = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    //Artists
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    //Songs
    public function getSongs(): ?Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): Artist
    {
        $this->songs->add($song);

        return $this;
    }

    public function removeSong(Song $song): Artist
    {
        $this->songs->removeElement($song);

        return $this;
    }

    //Albums (1 seul artiste)
    public function getAlbums(): ?Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): Artist
    {
        $this->albums->add($album);

        return $this;
    }

    public function removeAlbum(Album $album): Artist
    {
        $this->albums->removeElement($album);

        return $this;
    }
}
