<?php

namespace App\Model\Entity;

use DateTime;

class Article extends AbstractEntity
{

    private string $title;
    private string $content;
    private DateTime $dateAdd;
    private User $user;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateAdd(): DateTime
    {
        return $this->dateAdd;
    }

    /**
     * @param DateTime $dateAdd
     * @return Article
     */
    public function setDateAdd(DateTime $dateAdd): self
    {
        $this->dateAdd = $dateAdd;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Article
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

}