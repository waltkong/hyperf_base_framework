<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constants\ErrorCode;
use App\Controller\BaseController;
use App\Logics\Admin\CompanyLogic;
use App\Logics\Common\ResponseLogic;
use App\Middleware\OperateLogMiddleware;
use Qbhy\HyperfAuth\Annotation\Auth;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;

class CompanyController extends BaseController
{

    public function __construct(CompanyLogic $companyLogic)
    {
        parent::__construct();
        $this->logic = $companyLogic;
    }

    /**
     * 列表
     * @Auth("jwt")
     */
    public function dataList()
    {
        $input = $this->request->all();

        $result = $this->logic->dataList($input);

        return $this->response->json(ResponseLogic::successData($result));
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

        $validator = $this->validationFactory->make($input,
            [
                'name' => 'required|between:2,100',
            ],
            [
                'name.required' => '名称必要',
            ]
        );
        if ($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return $this->response->json(ResponseLogic::errorData(ErrorCode::ERROR, $errorMessage));
        }

        $this->logic->storeOrUpdate($input);

        return $this->response->json(ResponseLogic::successData());
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

