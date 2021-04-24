<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Promocode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Plaing SQL Query to join product with promocodes
     *   SELECT prod.id, prod.name, MAX(promo.percentage) FROM `product` as prod
     *   LEFT JOIN `promocode` as promo
     *   ON
     *       ( promo.field='sku' AND promo.value=prod.sku ) OR
     *       ( promo.field='category' AND promo.value=prod.category )
     *   GROUP BY prod.id;
     * @param null $criteria
     * @return \Doctrine\ORM\Query
     */
    public function findProductWithDiscount($criteria = null)
    {
        $query = $this->createQueryBuilder('product')
            ->select('product.id', 'product.sku', 'product.name', 'product.category',  'product.price', 'MAX(promocode.percentage) as percentage')
            ->leftJoin(Promocode::class, 'promocode', Join::WITH,
                "(promocode.field='sku' AND promocode.value=product.sku) OR 
                (promocode.field='category' AND promocode.value=product.category)")
            ->groupBy('product.id');

        if(!empty($criteria)) {
            foreach ($criteria as $key => $value) {
                $query->andWhere("product.{$key} = :{$key}")
                ->setParameter($key, $value);
            }
        }

        return $query->getQuery();
    }

}
