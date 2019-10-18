<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/get-multi", name="get_multi_product")
     */
    public function getMultiCall()
    {
        // Init config
        $path    = 'http://localhost/magento_1/';
        $apiUser = 'product';
        $apiKey  = 'vanhuyb15dcvt195';

        // Create remote adapter which wrap soapclient
        $adapter  = new \Smalot\Magento\RemoteAdapter($path, $apiUser, $apiKey);

        // Build the queue for multicall
        $queue = new \Smalot\Magento\MultiCallQueue($adapter);

        // Call any module's class
        $productManager = new \Smalot\Magento\Catalog\Product($adapter);
        $productManager->getInfo(10)->addToQueue($queue);
        $productManager->getInfo(11)->addToQueue($queue);
        $productManager->getInfo(12)->addToQueue($queue);

        // Request in one multicall information of 3 products (#10, #11, #12)
        $products = $queue->execute();


        return $this->json($products);
    }

}