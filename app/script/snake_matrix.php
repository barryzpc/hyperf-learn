<?php
/**
 * 输入一个整数n，要求输出一个N×N蛇形阵（n<10），比如输入整数4，则输出如下蛇形阵：
 * 1    2   3   4
 * 12   13  14  5
 * 11   16  15  6
 * 10   9   8   7
 * Created by PhpStorm.
 * User: barry
 * Date: 2020/4/20
 * Time: 11:04
 */

//收到的参数
$param = getopt("n:");
$input_num = $param['n'];
$value = 1; //矩阵的值
$matrix_arr = [];
$circle_num = ceil($input_num / 2);  //根据观察总结，转的圈数为行数除以2，如果行数为奇数，则向上取整，即+1
for ($i = 1; $i <= $circle_num; $i++) {//一圈一圈的来

    //用于每一圈判断第一行
    for ($j = $i; $j < $input_num - $i; $j++) {
        $matrix_arr[$i][$j] = $value++;
    }
    if ($i == 1){
        print_r($matrix_arr);
    }
    //用于判断每圈的最后一列
    for ($j = $i + 1; $j < $input_num  - $i - 1 ; $j++){
        $matrix_arr[$j][$input_num -$i -1] = $value++;
    }

    if ($i == 1){
        print_r($matrix_arr);
    }

    //用于判断每圈的最后一行
    for ($j = $input_num - $i -1 ; $j > $i; $j--){
        $matrix_arr[$input_num - $i -1][$j] = $value++;
    }

    if ($i == 1){
        print_r($matrix_arr);
    }

    //用于判断每圈的第一列
    for($j = $input_num - $i -1 ; $j > $i; $j--){
        $matrix_arr[$j][$i] = $value++;
    }

    if ($i == 1){
        print_r($matrix_arr);
    }

}
die;
foreach ($matrix_arr as $key => $val) {
    ksort($val);
    $str = "";
    foreach ($val as $value) {
        echo $value;
        echo " ";

    }
    echo PHP_EOL;
}
