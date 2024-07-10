<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="text_posts")
 */
class TextPost
{
    /**
     * @ORM\Column(type="text")
     */
    private $text;

    #[ORM\OneToOne(targetEntity: Post::class, mappedBy: 'textPost')]
    private Post $post;

    // Getters and setters
    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}
