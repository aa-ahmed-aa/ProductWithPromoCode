<?php


namespace App\Tests\Unit;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ProductRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function test_can_fetch_product(): void
    {
        $product = $this->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['sku' => '000003'])
        ;

        $this->assertIsNumeric($product->getPrice());
        $this->assertIsString($product->getName());
    }

    public function test_find_products_with_discount(): void
    {
        $products = $this->entityManager
            ->getRepository(Product::class)->findProductWithDiscount()->execute();

        $this->assertNotEmpty($products);
        $this->assertIsArray($products);
        $this->assertArrayHasKey('sku', $products[0]);
        $this->assertArrayHasKey('category', $products[0]);
        $this->assertArrayHasKey('price', $products[0]);
        $this->assertArrayHasKey('percentage', $products[0]);
    }

    public function test_is_category_with_00003_has30_percent_discount(): void
    {
        $product = $this->entityManager
            ->getRepository(Product::class)
            ->findProductWithDiscount(['sku' => '000003', 'category' => 'boots'])->execute()[0];

        $this->assertIsArray($product);
        $this->assertEquals(89000, $product['price']);
        $this->assertEquals("boots", $product['category']);
        $this->assertEquals("30",$product['percentage']);

    }
}
