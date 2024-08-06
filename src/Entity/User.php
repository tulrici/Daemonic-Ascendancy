<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Room>
     */
    #[ORM\ManyToMany(targetEntity: Room::class, mappedBy: 'users')]
    private Collection $rooms;

    /**
     * @var Collection<int, League>
     */
    #[ORM\ManyToMany(targetEntity: League::class, mappedBy: 'users')]
    private Collection $leagueScore;

    /**
     * @var Collection<int, Ladder>
     */
    #[ORM\OneToMany(targetEntity: Ladder::class, mappedBy: 'user')]
    private Collection $ladders;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'user')]
    private Collection $score;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->leagueScore = new ArrayCollection();
        $this->ladders = new ArrayCollection();
        $this->score = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->addUser($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->rooms->removeElement($room)) {
            $room->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, League>
     */
    public function getLeagueScore(): Collection
    {
        return $this->leagueScore;
    }

    public function addLeagueScore(League $leagueScore): static
    {
        if (!$this->leagueScore->contains($leagueScore)) {
            $this->leagueScore->add($leagueScore);
            $leagueScore->addUser($this);
        }

        return $this;
    }

    public function removeLeagueScore(League $leagueScore): static
    {
        if ($this->leagueScore->removeElement($leagueScore)) {
            $leagueScore->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ladder>
     */
    public function getLadders(): Collection
    {
        return $this->ladders;
    }

    public function addLadder(Ladder $ladder): static
    {
        if (!$this->ladders->contains($ladder)) {
            $this->ladders->add($ladder);
            $ladder->setUser($this);
        }

        return $this;
    }

    public function removeLadder(Ladder $ladder): static
    {
        if ($this->ladders->removeElement($ladder)) {
            // set the owning side to null (unless already changed)
            if ($ladder->getUser() === $this) {
                $ladder->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getScore(): Collection
    {
        return $this->score;
    }

    public function addScore(Game $score): static
    {
        if (!$this->score->contains($score)) {
            $this->score->add($score);
            $score->addUser($this);
        }

        return $this;
    }

    public function removeScore(Game $score): static
    {
        if ($this->score->removeElement($score)) {
            $score->removeUser($this);
        }

        return $this;
    }
}
