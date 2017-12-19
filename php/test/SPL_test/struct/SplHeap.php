<?php
/**
 * @desc The SplHeap class provides the main functionalities of a Heap.
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 23:18
 */
class IntHeap extends SplHeap
{

    /**
     * Compare elements in order to place them correctly in the heap while sifting up.
     * @link http://php.net/manual/en/splheap.compare.php
     * @param mixed $value1 <p>
     * The value of the first node being compared.
     * </p>
     * @param mixed $value2 <p>
     * The value of the second node being compared.
     * </p>
     * @return int Result of the comparison, positive integer if <i>value1</i> is greater than <i>value2</i>, 0 if they are equal, negative integer otherwise.
     * </p>
     * <p>
     * Having multiple elements with the same value in a Heap is not recommended. They will end up in an arbitrary relative position.
     * @since 5.3.0
     */
    protected function compare($value1, $value2)
    {
        return $value2[0] - $value1[0];
    }
}

$intHeap = new IntHeap();
$intHeap->insert([9, 11]);
$intHeap->insert([0, 1]);
$intHeap->insert([1, 2]);
$intHeap->insert([1, 3]);
$intHeap->insert([1, 4]);
$intHeap->insert([1, 5]);
$intHeap->insert([3, 6]);
$intHeap->insert([2, 7]);
$intHeap->insert([3, 8]);
$intHeap->insert([5, 9]);
$intHeap->insert([9, 10]);

//var_dump($intHeap->top());
//var_dump($intHeap->count());

var_dump($intHeap->extract());
var_dump($intHeap->count());
$intHeap->recoverFromCorruption();
for($intHeap->top(); $intHeap->valid(); $intHeap->next())
{
    list($pId, $id) = $intHeap->current();
    echo "$id ($pId)" . PHP_EOL;
}