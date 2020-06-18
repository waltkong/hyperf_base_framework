<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Di\Annotation\Inject;

class BaseController extends AbstractController
{

    /**
     * @Inject()
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    protected $logic;

    public function __construct()
    {
    }

}