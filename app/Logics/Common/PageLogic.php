<?php
namespace App\Logics\Common;

use App\Constants\AdminCommonConstant;

class PageLogic{


    /**
     *  根据 用户表单参数，获取分页和排序参数
     * @param array $input
     * @return array
     */
    public static function getPageParams(array $input){

        $page_index = $input['page_index'] ?? 1;
        $each_page = $input['each_page'] ?? AdminCommonConstant::EACH_PAGE;
        $page_offset = ((int)$each_page) * ((int)$page_index - 1);
        $order_by = $input['order_by'] ?? AdminCommonConstant::ORDER_BY;
        $order_way = $input['order_way'] ?? AdminCommonConstant::ORDER_WAY;

        return [
            'page_index' => $page_index,
            'each_page' => $each_page,
            'page_offset' => $page_offset,
            'order_by' => $order_by,
            'order_way' => $order_way
        ];
    }


    /**
     *  查询构造器 拼接 分页和排序 ，返回查询构造器
     * @param $querySet
     * @param array $input
     * @return mixed
     */
    public static function getPaginateListQuerySet($querySet, array $input){

        $pageParams = self::getPageParams($input);

        return  $querySet->orderBy($pageParams['order_by'], $pageParams['order_way'])
            ->offset($pageParams['page_offset'])->limit($pageParams['each_page']);

    }


    /**
     *  通用的列表数据返回
     * @param array $data
     * @return array
     */
    public static function commonListDataReturn($data = []){
        $default = [
            'data' => [],
            'total' => 0,
            'count' => 0,
        ];
        foreach ($data as $k => $v){
            $default[$k] = $v;
        }
        return $default;
    }


}