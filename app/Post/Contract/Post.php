<?php

namespace App\Post\Contract;

use App\Post\Entity\PostEntity;

interface Post
{
    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @param string $body
     */
    public function setBody(string $body): void;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return int
     */
    public function getId(): int;
}
