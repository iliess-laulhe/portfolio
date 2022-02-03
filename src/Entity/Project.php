<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *@ORM\Column(type="string", length=255)
     */
    private  string $title;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;
    /**
     * @ORM\Column(type="datetime")
     */
    private  $createdAT;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $projectLink;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $githubLink;
    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="projects")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageProject;

    public function getId(): ?int
    {
        return $this->id;
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
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAT = new \DateTime();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAT(): ?\DateTimeInterface
    {
        return $this->createdAT;
    }

    public function setCreatedAT(\DateTimeInterface $createdAT): self
    {
        $this->createdAT = $createdAT;

        return $this;
    }

    public function getProjectLink(): ?string
    {
        return $this->projectLink;
    }

    public function setProjectLink(string $projectLink): self
    {
        $this->projectLink = $projectLink;

        return $this;
    }

    public function getGithubLink(): ?string
    {
        return $this->githubLink;
    }

    public function setGithubLink(string $githubLink): self
    {
        $this->githubLink = $githubLink;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImageProject(): ?string
    {
        return $this->imageProject;
    }

    public function setImageProject(string $imageProject): self
    {
        $this->imageProject = $imageProject;

        return $this;
    }
}
