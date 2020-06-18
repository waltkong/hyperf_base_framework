<?php
namespace App\Logics\Common;

class DatabaseLogic{

    /**
     *  过滤掉数据表中不存在的数据
     * @param $modelClass
     * @param array $data
     * @return array
     */
    public static function filterTableData(array $tableFields , array $data){

        $fields = array_merge($tableFields, ['created_at', 'updated_at', 'deleted_at']);

        $result = [];

        foreach ($data as $k => $v){
            if(in_array($k,$fields)){
                $result[$k] = $v;
            }
        }

        return $result;
    }


    /**
     * 通用的插入
     * @param $modelClass
     * @param array $data
     * @return mixed
     */
    public static function commonInsertData($modelClass, array $data){

        $fields = $modelClass::FIELDS;

        $data = self::filterTableData($fields, $data);

        if(auth()->guard('jwt')->check()){

            $user = auth()->guard('jwt')->user();

            //多拼接一个所属公司id
            if(in_array('company_id',$fields) && !isset($data['company_id'])){
                $data['company_id'] = $user->company_id  ;
            }
        }

        return $modelClass::query()->insertGetId($data);

    }


    /**
     *  通用的编辑
     * @param $modelClass
     * @param $qs
     * @param array $data
     * @return mixed
     */
    public static function commonUpdateData($modelClass, $qs, array $data){

        $fields = $modelClass::FIELDS;

        $data = self::filterTableData($fields, $data);

        if(auth()->guard('jwt')->check()){

            $user = auth()->guard('jwt')->user();

            //多拼接一个所属公司id
            if(in_array('company_id',$fields) && !isset($data['company_id'])){
                $data['company_id'] = $user->company_id  ;
            }

            //有user_id 也存当前用户
            if(in_array('user_id',$fields) && !isset($data['user_id'])){
                $data['user_id'] = $user->company_id  ;
            }

        }

        return $qs->update($data);

    }

}