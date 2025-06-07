<?php
namespace App\DataTransferObjects;

class TaskDataDto
{
    public function __construct(
        public readonly string $userId,
        public readonly string $id,
        public readonly string $title,
        public readonly string $completed,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data['userId'],
            id: $data['id'],
            title: $data['title'],
            completed: $data['completed'],
        );
    }
}