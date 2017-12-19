<?php
// each, list
// foreach 迭代数组的副本，each迭代数组本身
$items = [[1, 2], [3, 4],[5, 6],[7, 8],[9, 10],[11, 12],];
reset($items);
while (list($n1, $n2) = each($items)) {
	# code...
}

for ($i = 0, $len = count($items); $i < $len; $i++) {
	# code...
}

for ($i = count($items) - 1; $i >= 0 ; $i--) {
	# code...
}

for (reset($items); $key = key($items); next($items)) {
	# code...
}

// array_map
// is_array, settype
settype($items, 'array'); // 强制类型转换

// unset, array_splice
// array_splice 自动重置索引
// array_values 重置索引
// array_shift 删除数组第一个元素
// array_pop 删除数组最后一个元素
// array_pad 扩大数组
// array_splice 删除数组元素，缩小数组
// join, implode 合并数组
// array_key_exists, isset
// in_array
in_array('a', $items, true);

// array_flip
// array_search
// array_filter
// max, min
// arsort, asort
// array_reverse
// sort, asort, arsort, rsort, usort
// array_mutisort

$data = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ];
$reversedata = array_reverse($data, true);
var_dump($reversedata);
sort($reversedata, SORT_NUMERIC);
var_dump($reversedata);

$natsortarray = ['test1.php', 'test10.php', 'test11.php', 'test2.php'];
//natsort($natsortarray);

function natsortfunc($a, $b)
{
	return strnatcmp($a, $b);
}

usort($natsortarray, 'natsortfunc');
var_dump($natsortarray);

// array_mutisort
// usort($data, 'funcname')
// usort($data, array('classname', 'funcname'))
// usort($data, array($obj, 'funcname'))
// shuffle 打乱数组
// array_unique
// array_flip
// array_walk, array_walk_recursive
// array_intersect, array_diff, array_merge, array_map

// FakeArray class
class FakeArray implements ArrayAccess
{
	private $_elements;
	public function __construct()
	{
		$this->_elements = [];
	}

	public function offsetExists($offset)
	{
		return isset($this->_elements[$offset]);
	}

	public function offsetGet($offset)
	{
		return $this->_elements[$offset];
	}

	public function offsetSet($offset, $value)
	{
		$this->_elements[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->_elements[$offset]);
	}
}

$farray = new FakeArray;
$farray['name'] = 'tony';
var_dump($farray);
var_dump($farray['name']);
var_dump(isset($farray['name']));
unset($farray['name']);
var_dump(isset($farray['name']));



