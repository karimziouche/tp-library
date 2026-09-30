<?php

class Author
{
    private int $id;
    private string $firstname;
    private string $lastname;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getFirstName(): string
    {
        return $this->firstname;
    }
    public function setFirstName(string $firstname): void
    {
        $this->firstname = $firstname;
    }
    public function getLastName(): string
    {
        return $this->lastname;
    }
    public function setLastName(string $lastname): void
    {
        $this->lastname = $lastname;
    }
}