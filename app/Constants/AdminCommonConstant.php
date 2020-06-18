<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class AdminCommonConstant extends AbstractConstants
{

    const EACH_PAGE = 20 ;// 每页默认显示数量

    ## 默认id倒序
    const ORDER_BY = "id";
    const ORDER_WAY = "desc";


}
