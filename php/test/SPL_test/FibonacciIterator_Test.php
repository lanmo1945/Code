<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 19:39
 */
class FibonacciIteratorTest implements Iterator
{
    private $_previous = 1;
    private $_current = 0;
    private $_key = 0;

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->_current;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $newPrevious = $this->_current;
        $this->_current += $this->_previous;
        $this->_previous = $newPrevious;
        $this->_key++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->_key;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return true;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->_previous = 1;
        $this->_current = 0;
        $this->_key = 0;
    }
}

//---run
foreach((new FibonacciIteratorTest()) as $k => $v)
{
    if('INF' == strval($v))
    {
        break;
    }
    echo "$k => $v" . PHP_EOL;
//    sleep(1);
}