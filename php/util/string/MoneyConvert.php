<?php
/**
 * @name   MoneyConvert.php
 * @time   2017/12/19 11:09
 * @author Tony Lewis
 * @desc
 */
class MoneyConvert
{
    /**
     * @var array $_unitMap
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
     * @var array $_numberMap
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
     * @desc  convert
     * @param $money
     * @return string
     */
    public static function convert($money)
    {
        $money = strval($money);

        //---数字匹配（正数，负数，小数）
        if(1 !== preg_match('/^-?(\d+|[1-9]\d+)(\.(\d+)?[1-9])?$/i', $money))
        {
            return '';
        }
        if(0 == bccomp($money, '0'))
        {
            return self::$_numberMap[0];
        }

        $result = '';
        if(0 === strpos($money, '-'))
        {
            $result .= '负';
            $money = ltrim($money, '-');
        }
        $numPart = explode('.', $money);
        $result .= self::_convertSub($numPart[0]);
        if(count($numPart) > 1 && false == empty($numPart[1]) && 1 == bccomp($numPart[1], '0'))
        {
            $result .= '点' . self::_convertDecimal($numPart[1]);
        }
        return $result;
    }

    /**
     * @desc  _convertDecimal
     * @param $money
     * @return string
     */
    private static function _convertDecimal($money)
    {
        $money = rtrim($money, '0');
        $result = '';
        for($i = 0, $len = strlen($money); $i < $len; $i++)
        {
            $result .= self::$_numberMap[$money{$i}];
        }
        return $result;
    }

    /**
     * @desc  _convertSub
     * @param $money
     * @return string
     */
    private static function _convertSub($money)
    {
        if(0 == bccomp($money, '0'))
        {
            return self::$_numberMap[0];
        }

        $result = '';
        foreach(self::$_unitMap as $n => $t)
        {
            $d = bcdiv($money, $n);
            $money = bcmod($money, $n);
            if(0 == bccomp($d, '0'))
            {
                $result .= self::$_numberMap[$d];
                continue;
            }

            if($d < 10)
            {
                $result .= self::$_numberMap[$d] . $t;
                continue;
            }
            $result .= self::_convertSub($d) . $t;
        }

        //---零：掐头去尾
        return trim($result, self::$_numberMap[0]);
    }
}

echo MoneyConvert::convert('1234567890') . PHP_EOL;
echo MoneyConvert::convert('1030560890') . PHP_EOL;
echo MoneyConvert::convert('1010160101') . PHP_EOL;
echo MoneyConvert::convert('-1010160101.0101') . PHP_EOL;
echo MoneyConvert::convert('-0.0101') . PHP_EOL;
