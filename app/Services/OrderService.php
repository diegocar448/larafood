<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class OrderService
{
    protected $serviceRepository, $tenantRepository, $tableRepository, $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function ordersByClient()
    {
        $idClient = $this->getClientIdByOrder();

        return $this->orderRepository->getOrdersByClientId($idClient);
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function createNewOrder(array $order)
    {
        //verificase o produto existe caso não exista ele passa um array vazio
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);


        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder([$productsOrder]);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($order['uuid'] ?? '');
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;

        /* string $identify,
        float $total,
        string $status, 'open'
        int $tenantId,
        $clientId = '',
        $tableId = '' */
    }

    private function getIdentifyOrder(float $qtyCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwyz');

        $numbers = (((date("Ymd") / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        //$specialCharacters = str_shuffle('!@#$%*-');

        //$characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters . $numbers;


        $identify = substr(str_shuffle($characters), 0, $qtyCaraceters);


        /////////////////////////////////////////////////////////////////////////////////////////////////
        //Verificar se existe outro pedido com essa identificação, se houver faz roda novamente o metodo
        /////////////////////////////////////////////////////////////////////////////////////////////////
        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaraceters + 1);
        }

        return $identify;
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    //Aqui ele devolver os produtos formatados
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    private function getProductsByOrder(array $productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {

            $product = $this->productRepository->getProductByUuid($productOrder['identify']);

            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price
            ]);
        }

        return $products;
    }

    private function getTotalOrder(array $products): float
    {
        $total = 0;


        foreach ($products[0] as $key => $product) {


            $total += $product['price'] * $product['qty'];
        }



        return (float) $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {

        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);

            return $table->id;
        }


        return '';
    }

    private function getClientIdByOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }
}
