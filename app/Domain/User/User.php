<?php

namespace App\Domain\User;

class User
{
    private ?int $id;

    private ?string $userID;

    private ?bool $isAdmin;

    private ?string $firstname;

    private ?string $lastname;

    private ?string $address;

    private ?int $contactNumber;

    private ?string $image;

    private ?string $email;

    private ?string $password;

    private ?bool $isDeleted;

    private ?string $createdAt;

    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        ?string $userID = null,
        ?bool $isAdmin = null,
        ?string $firstname = null,
        ?string $lastname = null,
        ?string $address = null,
        ?int $contactNumber = null,
        ?string $image = null,
        ?string $email = null,
        ?string $password = null,
        ?bool $isDeleted = null,
        ?string $createdAt = null,
        ?string $updatedAt = null,
    ) {
        $this->id = $id;
        $this->userID = $userID;
        $this->isAdmin = $isAdmin;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->contactNumber = $contactNumber;
        $this->image = $image;
        $this->email = $email;
        $this->password = $password;
        $this->isDeleted = $isDeleted;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // return an array.
    public function toArray()
    {
        return [
            'id' => $this->id,
            'userID' => $this->userID,
            'isAdmin' => $this->isAdmin,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'contactNumber' => $this->contactNumber,
            'image' => $this->image,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?string
    {
        return $this->userID;
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function getFirstName(): ?string
    {
        return $this->firstname;
    }

    public function getLastName(): ?string
    {
        return $this->lastname;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getContactNumber(): ?int
    {
        return $this->contactNumber;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
