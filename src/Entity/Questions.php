<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulty;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correct_answer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $incorrect0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $incorrect1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $incorrect2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCorrectAnswer(): ?string
    {
        return $this->correct_answer;
    }

    public function setCorrectAnswer(string $correct_answer): self
    {
        $this->correct_answer = $correct_answer;

        return $this;
    }

    public function getIncorrect0(): ?string
    {
        return $this->incorrect0;
    }

    public function setIncorrect0(string $incorrect0): self
    {
        $this->incorrect0 = $incorrect0;

        return $this;
    }

    public function getIncorrect1(): ?string
    {
        return $this->incorrect1;
    }

    public function setIncorrect1(?string $incorrect1): self
    {
        $this->incorrect1 = $incorrect1;

        return $this;
    }

    public function getIncorrect2(): ?string
    {
        return $this->incorrect2;
    }

    public function setIncorrect2(?string $incorrect2): self
    {
        $this->incorrect2 = $incorrect2;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
