<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="text_posts")
 */
class TextPost extends Post
{
    /**
     * @ORM\Column(type="text")
     */
    private $text;

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
}
