<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perex;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    #[ORM\OneToOne(targetEntity: TextPost::class, inversedBy: 'post')]
    #[ORM\JoinColumn(name: 'text_post_id', referencedColumnName: 'id')]
    private TextPost|null $textPost = null;

    #[ORM\OneToOne(targetEntity: AudioPost::class, inversedBy: 'post')]
    #[ORM\JoinColumn(name: 'audio_post_id', referencedColumnName: 'id')]
    private AudioPost|null $audioPost = null;

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
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

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }

    public function getPerex(): ?string
    {
        return $this->perex;
    }

    public function setPerex(?string $perex): self
    {
        $this->perex = $perex;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getTextPost(): ?TextPost
    {
        return $this->textPost;
    }

    public function setTextPost(?TextPost $textPost): void
    {
        $this->textPost = $textPost;
    }

    public function getAudioPost(): ?AudioPost
    {
        return $this->audioPost;
    }

    public function setAudioPost(?AudioPost $audioPost): void
    {
        $this->audioPost = $audioPost;
    }
}
