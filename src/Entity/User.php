<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TodoItem", mappedBy="user_id")
     */
    private $todoItems;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TodoItem", mappedBy="owner")
     */
    private $getItems;

    public function __construct()
    {
        $this->todoItems = new ArrayCollection();
        $this->getItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(){
        return [
            'ROLE_USER'
        ];
    }

    public function getSalt() {

    }

    public function eraseCredentials() {
        
    }

    /**
     * @return Collection|TodoItem[]
     */
    public function getTodoItems(): Collection
    {
        return $this->todoItems;
    }

    public function addTodoItem(TodoItem $todoItem): self
    {
        if (!$this->todoItems->contains($todoItem)) {
            $this->todoItems[] = $todoItem;
            $todoItem->setUserId($this);
        }

        return $this;
    }

    public function removeTodoItem(TodoItem $todoItem): self
    {
        if ($this->todoItems->contains($todoItem)) {
            $this->todoItems->removeElement($todoItem);
            // set the owning side to null (unless already changed)
            if ($todoItem->getUserId() === $this) {
                $todoItem->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TodoItem[]
     */
    public function getGetItems(): Collection
    {
        return $this->getItems;
    }

    public function addGetItem(TodoItem $getItem): self
    {
        if (!$this->getItems->contains($getItem)) {
            $this->getItems[] = $getItem;
            $getItem->setOwner($this);
        }

        return $this;
    }

    public function removeGetItem(TodoItem $getItem): self
    {
        if ($this->getItems->contains($getItem)) {
            $this->getItems->removeElement($getItem);
            // set the owning side to null (unless already changed)
            if ($getItem->getOwner() === $this) {
                $getItem->setOwner(null);
            }
        }

        return $this;
    }
}
