<?php

class Book
{
    private int $id;
    private string $title;
    private string $publication_date;
    private int $author_id;
    private Author $author;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title):void
    {
        $this->title = $title;
    }
    public function getPublication_date(): string
    {
        return $this->publication_date;
    }
    public function setPublication_date(string $publication_date): void
    {
        $this->publication_date = $publication_date;
    }
    public function getAuthor_id(): int
    {
        return $this->author_id;
    }
    public function setAuthor_id(int $author_id): void
    {
        $this->author_id = $author_id;
    }
    public function getAuthor(): Author
    {
        return $this->author;
    }
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }
}