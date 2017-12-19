<?php
/**
 * @desc
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/16 17:10
 */
class RecursiveFileFilterIterator extends FilterIterator
{
    protected $ext = array('jpg', 'gif');

    /**
     * RecursiveFileFilterIterator constructor.
     * @param $path
     */
    public function __construct($path)
    {
        parent::__construct(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)));
    }

    /**
     * @desc   accept
     * @return bool
     */
    public function accept()
    {
        /**
         * @var $item RecursiveDirectoryIterator
         */
        $item = $this->getInnerIterator();
        return $item->isFile() && in_array($item->getExtension(), $this->ext);
    }
}

//---test
foreach(new RecursiveFileFilterIterator('D:\Go') as $k => $v)
{
    echo "$k => $v" . PHP_EOL;
}