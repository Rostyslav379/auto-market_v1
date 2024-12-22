<?php

namespace App\Document;

use App\Repository\UserRepository;
use MongoDB\BSON\ObjectId;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

#[ODM\HasLifecycleCallbacks]
#[ODM\Document(repositoryClass: UserRepository::class)]
class User implements UserInterface,\Serializable, PasswordAuthenticatedUserInterface
{
    const ROLE_USER = 'ROLE_USER';
    #[ODM\Id]
    private ObjectId|string $id;
    #[ODM\Field(type: 'string', nullable: false)]
    private string $email;
    #[ODM\Field(type: 'string', nullable: false)]
    private string $username;
    #[ODM\Field(type: 'string', nullable: false)]
    private string $password;
    #[ODM\Field(type: 'string', nullable: false)]
    private string $phone;

    #[ODM\Field(type: 'collection', nullable: false)]
    private array $roles = [];

    #[ODM\Field(type: 'date', nullable: false)]
    private \DateTimeImmutable|\DateTime $createdAt;

    /**
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $phone
     */
    public function __construct(
        string $email, string $username, string $phone)
    {
        $this->id = new ObjectId();
        $this->email = $email;
        $this->username = $username;
        $this->phone = $phone;
    }


    public function serialize()
    {
    }

    public function unserialize(string $data)
    {
    }

    public function getPassword(): ?string
    {
        return  $this->password;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = self::ROLE_USER;
        }
        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    public function __unserialize(array $data): void
    {
    }

    public function getId(): string
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCreatedAt(): \DateTimeImmutable|\DateTime
    {
        return $this->createdAt;
    }
    #[ODM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function setCreatedAt(\DateTimeImmutable|\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }



}