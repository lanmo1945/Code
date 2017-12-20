<?php
/**
 * @name   NumberConverter.php
 * @time   2017/12/19 21:39
 * @author Tony Lewis
 * @desc   把数字转换为中文大写(使用bc_math库，适用于整数，负数，小数，大数字也适用)
 */
class NumberConverter
{
    /**
     * 整数部分填充'零'字符标记
     */
    const FLAG_NO_ZERO = 1;

    /**
     * GBK编码输出标记
     */
    const FLAG_IS_GBK = 2;

    /**
     * @var int $_flag 标记
     */
    private static $_flag = 0;

    /**
     * @var int $_flagNoZero
     */
    private static $_flagNoZero = 0;

    /**
     * @var array $_unitMap 单位列表(在先除后取余时，依次从大到小进行)
     */
    private static $_unitMap = array(
        '1000000000000' => '兆',
        '100000000' => '亿',
        '10000' => '万',
        '1000' => '仟',
        '100' => '佰',
        '10' => '拾',
        '1' => '',
    );

    /**
     * @var array $_numberMap 数字列表(在先除后取余时，依次从大到小进行)
     */
    private static $_numberMap = array(
        '9' => '玖',
        '8' => '捌',
        '7' => '柒',
        '6' => '陆',
        '5' => '伍',
        '4' => '肆',
        '3' => '叁',
        '2' => '贰',
        '1' => '壹',
        '0' => '零',
    );

    /**
     * @desc  设置Flag
     * @param $flag
     */
    public static function setFlag($flag)
    {
        $flag = intval($flag);
        if ($flag <= 0)
        {
            return;
        }

        self::$_flag = $flag;
    }

    /**
     * @desc  转换函数
     * @param $number string 输入数字
     * @return string
     */
    public static function convert($number)
    {
        $number = strval($number);

        //---数字校验（正数，负数，小数）
        if(1 !== preg_match('/^-?(\d+|[1-9]\d+)(\.(\d+)?[1-9])?$/i', $number))
        {
            return '';
        }

        //---如果为0的话直接返回零
        if(0 == bccomp($number, '0'))
        {
            return self::$_numberMap[0];
        }
        $result = '';

        //---如果带负号，添加负并去除数字的负号
        if(0 === strpos($number, '-'))
        {
            $result .= '负';
            $number = ltrim($number, '-');
        }

        //---转换整数部分
        $numPart = explode('.', $number);
        self::$_flagNoZero = self::FLAG_NO_ZERO == (self::$_flag & self::FLAG_NO_ZERO);
        $result .= self::_convertInteger($numPart[0]);

        //---转换小数部分
        if(count($numPart) > 1 && false == empty($numPart[1]) && 1 == bccomp($numPart[1], '0'))
        {
            $result .= '点' . self::_convertDecimal($numPart[1]);
        }

        //---解决中文环境下乱码(本文件为utf-8)
        if(self::FLAG_IS_GBK == (self::$_flag & self::FLAG_IS_GBK))
        {
            return mb_convert_encoding($result, 'gbk');
        }
        return $result;
    }

    /**
     * @desc  小数转换
     * @param $number string 输入数字
     * @return string
     */
    private static function _convertDecimal($number)
    {
        $number = rtrim($number, '0');
        $result = '';
        for($i = 0, $len = strlen($number); $i < $len; $i++)
        {
            $result .= self::$_numberMap[$number{$i}];
        }
        return $result;
    }

    /**
     * @desc  整数转换
     * @param $number string 输入数字
     * @return string
     */
    private static function _convertInteger($number)
    {
        //---如果为0则返回零
        if(0 == bccomp($number, '0'))
        {
            return self::$_numberMap[0];
        }

        $result = '';
        foreach(self::$_unitMap as $unit => $title)
        {
            if(self::$_flagNoZero && -1 == bccomp($number, $unit))
            {
                continue;
            }

            //---先做除法得出单位倍数(例如：100000 = 10 * 10000)，原数字则对单位取出余数
            $n = bcdiv($number, $unit);
            $number = bcmod($number, $unit);

            //---如果倍数为0，拼接零
            if(false == self::$_flagNoZero && 0 == bccomp($n, '0'))
            {
                $result .= self::$_numberMap['0'];
                continue;
            }

            //---如果倍数为0 < $n < 10，则返回对应大写数字和单位(例如：玖万)
            if(-1 == bccomp($n, '10'))
            {
                $result .= self::$_numberMap[$n] . $title;
                continue;
            }

            //---如果$n > 10，则对$n做递归分解和拼接
            $result .= self::_convertInteger($n) . $title;
        }

        //---掐头去尾，去掉两边的多余'零'字符
        return self::$_flagNoZero ? $result : trim($result, self::$_numberMap['0']);
    }
}

//---Test case
//NumberConverter::setFlag(NumberConverter::FLAG_NO_ZERO | NumberConverter::FLAG_IS_GBK);
//NumberConverter::setFlag(NumberConverter::FLAG_NO_ZERO);

echo NumberConverter::convert('1234567890') . PHP_EOL;
echo NumberConverter::convert('1030560890') . PHP_EOL;
echo NumberConverter::convert('1010160101') . PHP_EOL;
echo NumberConverter::convert('-1010160101.0101') . PHP_EOL;
echo NumberConverter::convert('-0.0101') . PHP_EOL;
