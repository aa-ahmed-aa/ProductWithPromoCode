<?php


namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Container\ContainerInterface;

class AbstractService
{
    /** @var ContainerInterface  */
    protected $container;

    /** @var PaginatorInterface  */
    protected $paginator;

    /** @var EntityManagerInterface  */
    protected $em;

    /**
     * AbstractService constructor.
     * @param ContainerInterface $container
     * @param PaginatorInterface $paginator
     * @param EntityManagerInterface $em
     */
    public function __construct(
        ContainerInterface $container ,
        PaginatorInterface $paginator,
        EntityManagerInterface $em
    ) {
        $this->container = $container;
        $this->paginator = $paginator;
        $this->em = $em;
    }
}
