<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/get", name="get_tree")
     */
    public function getTree()
    {
        // Init config
        $path    = 'http://localhost/magento_1/';
        $apiUser = 'category';
        $apiKey  = 'vanhuyb15dcvt195';

        // Create remote adapter which wrap soapclient
        $adapter  = new \Smalot\Magento\RemoteAdapter($path, $apiUser, $apiKey);

        // Call any module's class
        $categoryManager = new \Smalot\Magento\Catalog\Category($adapter);
        $tree            = $categoryManager->getTree()->execute();

        return $this->json($tree);
    }


}