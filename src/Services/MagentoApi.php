<?php

namespace App\Services;

class MagentoApi
{

    public function getProduct($path, $apiUser, $apiKey)
    {
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

        return $products;
    }

    public function getCategoryTree($path, $apiUser, $apiKey)
    {
        // Create remote adapter which wrap soapclient
        $adapter  = new \Smalot\Magento\RemoteAdapter($path, $apiUser, $apiKey);

        // Call any module's class
        $categoryManager = new \Smalot\Magento\Catalog\Category($adapter);
        $tree            = $categoryManager->getTree()->execute();

        return $tree;
    }

}