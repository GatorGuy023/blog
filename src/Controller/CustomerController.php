<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /** @var CustomerRepository */
    private $customerRepo;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    #[Route('/customer', name: 'customer_list')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'customers' => $this->customerRepo->findAll()
        ]);
    }

    #[Route('/customer/create', name: 'customer_create')]
    public function createCustomer(Request $request): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $this->customerRepo->add($customer, true);
            return $this->redirectToRoute('customer_list');
        }

        return $this->renderForm('customer/form.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/customer/{id}/edit', name: 'customer_edit')]
    public function editCustomer(Request $request, Customer $customer): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $this->customerRepo->add($customer, true);
            return $this->redirectToRoute('customer_list');
        }

        return $this->renderForm('customer/form.html.twig', [
            'form' => $form
        ]);
    }
}
