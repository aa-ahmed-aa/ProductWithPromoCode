<?php


namespace App\Service;


use App\Repository\ProductRepository;
use App\Repository\PromocodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Container\ContainerInterface;

class ProductService extends AbstractService
{
    /** @var ProductRepository */
    private $productReposiory;

    /** @var PromocodeRepository */
    private $promocodeRepository;


    /**
     * ProductService constructor.
     * @param ContainerInterface $container
     * @param PaginatorInterface $paginator
     * @param EntityManagerInterface $em
     * @param ProductRepository $productReposiory
     * @param PromocodeRepository $promocodeRepository
     */
    public function __construct(
        ContainerInterface $container,
        PaginatorInterface $paginator,
        EntityManagerInterface $em,
        ProductRepository $productReposiory,
        PromocodeRepository $promocodeRepository
    ) {
        parent::__construct($container, $paginator, $em);
        $this->productReposiory = $productReposiory;
        $this->promocodeRepository = $promocodeRepository;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getProductWithDiscount($page = 1, $limit = 10)
    {
        $query = $this->productReposiory->findProductWithDiscount();
        $paginator = $this->paginator->paginate(
            $query,
            $page,
            $limit
        );
        return $paginator;
    }
}
