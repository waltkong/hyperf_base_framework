<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;

use App\Logics\Admin\ConfigLogic;
use App\Logics\Common\ResponseLogic;
use Qbhy\HyperfAuth\Annotation\Auth;
use App\Middleware\OperateLogMiddleware;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;
use App\Constants\ErrorCode;

class ConfigController extends BaseController
{

    public function __construct(ConfigLogic $configLogic)
    {
        parent::__construct();
        $this->logic = $configLogic;
    }

    /**
     * 列表
     * @Auth("jwt")
     */
    public function dataList()
    {
        $input = $this->request->all();

        return $this->response->json(ResponseLogic::successData([]));
    }

    /**
     * 增or改
     * @Auth("jwt")
     * @Middlewares({
     *     @Middleware(OperateLogMiddleware::class)
     * })
     */
    public function storeOrUpdate()
    {
        $input = $this->request->all();

        return $this->response->json(ResponseLogic::successData([]));
    }


    /**
     * 查一个
     * @Auth("jwt")
     */
    public function getOne()
    {
        $input = $this->request->all();

        $validator = $this->validationFactory->make($input,
            [
                'id' => 'required|numeric',
            ],
            [
                'id.required' => 'id必要',
            ]
        );
        if ($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return $this->response->json(ResponseLogic::errorData(ErrorCode::ERROR, $errorMessage));
        }

        return $this->response->json(ResponseLogic::successData([]));
    }

    /**
     * 删除
     * @Auth("jwt")
     * @Middlewares({
     *     @Middleware(OperateLogMiddleware::class)
     * })
     */
    public function deleteOne()
    {
        $input = $this->request->all();

        $validator = $this->validationFactory->make($input,
            [
                'id' => 'required|numeric',
            ],
            [
                'id.required' => 'id必要',
            ]
        );
        if ($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return $this->response->json(ResponseLogic::errorData(ErrorCode::ERROR, $errorMessage));
        }

        return $this->response->json(ResponseLogic::successData([]));
    }


}

