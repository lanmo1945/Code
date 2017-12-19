<?php
/**
 * @desc SplStack类通过使用一个双向链表来提供栈的主要功能。
 * the SplStack is  simply a SplDoublyLinkedList with
 * an iteration mode IT_MODE_LIFO and IT_MODE_KEEP
 * @author 刘阳(lanmo1945@163.com)
 * @date   2017/12/17 23:03
 */
$splStack = new SplStack();
//$splStack->setIteratorMode(SplStack::IT_MODE_KEEP);
var_dump($splStack->getIteratorMode());
