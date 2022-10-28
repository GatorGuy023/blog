<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CustomerContact::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $customerContacts;

    public function __construct()
    {
        $this->customerContacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CustomerContact>
     */
    public function getCustomerContacts(): Collection
    {
        return $this->customerContacts;
    }

    public function addCustomerContact(CustomerContact $customerContact): self
    {
        if (!$this->customerContacts->contains($customerContact)) {
            $this->customerContacts->add($customerContact);
            $customerContact->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomerContact(CustomerContact $customerContact): self
    {
        if ($this->customerContacts->removeElement($customerContact)) {
            // set the owning side to null (unless already changed)
            if ($customerContact->getCustomer() === $this) {
                $customerContact->setCustomer(null);
            }
        }

        return $this;
    }
}
