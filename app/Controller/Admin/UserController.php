<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Logics\Admin\UserLogic;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Controller\BaseController;
use App\Logics\Common\ResponseLogic;
use Qbhy\HyperfAuth\Annotation\Auth;
use App\Middleware\OperateLogMiddleware;
use App\Constants\ErrorCode;
use Hyperf\HttpServer\Annotation\Middlewares;
use Hyperf\HttpServer\Annotation\Middleware;

class UserController extends BaseController
{

    public function __construct(UserLogic $userLogic)
    {
        parent::__construct();
        $this->logic = $userLogic;
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

        $this->logic->storeOrUpdate($input);

        return $this->response->json(ResponseLogic::successData([]));
    }

    /**
     * 修改密码
     * @Auth("jwt")
     * @Middlewares({
     *     @Middleware(OperateLogMiddleware::class)
     * })
     */
    public function changePassword(){

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

