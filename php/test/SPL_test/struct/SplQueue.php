<?php
/**
 * @desc The SplQueue class provides the main functionalities
 * of a queue implemented using a doubly linked list.
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 23:11
 */
$splQueue = new SplQueue();
$splQueue->setIteratorMode(SplQueue::IT_MODE_KEEP);

$splQueue->enqueue(1);
$splQueue->enqueue(2);
$splQueue->enqueue(3);
assert(3 == $splQueue->count());

assert(1 == $splQueue->dequeue());
assert(2 == $splQueue->dequeue());
assert(3 == $splQueue->dequeue());
assert($splQueue->isEmpty());