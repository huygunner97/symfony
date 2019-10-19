<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\MagentoApi;

class ProductController extends AbstractController
{
    private $path = 'http://localhost/magento_1/';
    private $apiUser = 'product';
    private $apiKey = 'vanhuyb15dcvt195';

    public $magentoApi;

    public function __construct(MagentoApi $magentoApi)
    {
        $this->magentoApi = $magentoApi;
    }

    /**
     * @Route("/product/get-multi", name="get_multi_product")
     */
    public function getMultiCall()
    {
        return $this->json($this->magentoApi->getProduct($this->path, $this->apiUser, $this->apiKey));
    }

}