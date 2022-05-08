<?php
function fieldSort($order)
{
    $filed = $order[0];
    $direction = $order[1];
    $param = request()->query();
    $param['sort'] = $param['sort'] ?? [];

    if($direction == 'desc'){
        unset($param['sort'][$filed]);
        $str = http_build_query($param);
        return $str;
    }

    $direction = $direction == 'asc' ? 'desc' : 'asc';

    $mergedSort = array_merge($param['sort'], [$filed => $direction]);
    $result = array_merge($param, ['sort' => $mergedSort]);
    $str = http_build_query($result);
    return $str;
}