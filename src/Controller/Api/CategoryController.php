<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\MagentoApi;

class CategoryController extends AbstractController
{
    private $path = 'http://localhost/magento_1/';
    private $apiUser = 'category';
    private $apiKey = 'vanhuyb15dcvt195';

    public $magentoApi;

    public function __construct(MagentoApi $magentoApi)
    {
        $this->magentoApi = $magentoApi;
    }
    /**
     * @Route("/category/get", name="get_tree")
     */
    public function getTree()
    {
        return $this->json($this->magentoApi->getCategoryTree($this->path, $this->apiUser, $this->apiKey));
    }

}