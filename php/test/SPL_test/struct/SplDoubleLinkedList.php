<?php
/**
 * @desc   双链表 (DLL) 是一个链接到两个方向的节点列表。当底层结构是 DLL时,
 * 迭代器的操作、对两端的访问、节点的添加或删除都具有 O (1) 的开销。因此,
 * 它为栈和队列提供了一个合适的实现。
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 21:05
 */
$splDLL = new SplDoublyLinkedList();
for($i = 0; $i < 100; $i++)
{
    $splDLL->add($i, $i + 1);
}

assert(100 == $splDLL->count(), 'expected count is 100!');
foreach($splDLL as $k => $v)
{
    assert($v == ($k + 1));
}

assert(false == $splDLL->isEmpty());
assert(isset($splDLL[99]));
assert(100 == $splDLL[99]);
unset($splDLL[99]);
assert(false == isset($splDLL[99]));
assert(99 == $splDLL->count());

assert(1 == $splDLL->bottom());
assert(99 == $splDLL->top());

assert(99 == $splDLL->pop());
$splDLL->push(10086);
assert(10086 == $splDLL->pop());

assert(1 == $splDLL->shift());
$splDLL->unshift(666);
assert(666 == $splDLL->shift());

$splDLL->rewind();
$splDLL->prev();
assert(null == $splDLL->current());

$splDLL->rewind();
$splDLL->next();
assert(3 == $splDLL->current());

SplDoublyLinkedList::IT_MODE_FIFO;
SplDoublyLinkedList::IT_MODE_LIFO;
SplDoublyLinkedList::IT_MODE_KEEP;
SplDoublyLinkedList::IT_MODE_DELETE;
$splDLL->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP);
//foreach($splDLL as $k => $v)
//{
//    echo "$k => $v" . PHP_EOL;
//}
//echo $splDLL->getIteratorMode() . PHP_EOL;

$splDLL->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_KEEP);
//foreach($splDLL as $k => $v)
//{
//    echo "$k => $v" . PHP_EOL;
//}
//echo $splDLL->getIteratorMode() . PHP_EOL;

$splDLL->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_DELETE);
foreach($splDLL as $k => $v)
{
//    echo "$k => $v" . PHP_EOL;
}
//echo $splDLL->getIteratorMode() . PHP_EOL;
assert($splDLL->isEmpty());

