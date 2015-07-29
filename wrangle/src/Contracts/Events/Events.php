<?php
namespace Wrangle\Contracts\Events;

interface EventsContainer
{
    // 带命名空间的时间有必要性吗?
    // 对事件本身的事件控制重要吗?

    //on
    //newListener
    //once

    //类方法
    //'newContainer'
    //'removeContainer'
    //'newListener'
    //'removeListener'
    //'newEvent'
    //listenerCount 返回指定事件的 listeners 个数
    //setMaxListeners(n) 监听器数目上限.按照哲学或者数学的观点,是要有限制的.

    //emitter.removeListener(event, listener)

    //事件的优先权重要吗?为什么要优先运行呢?
    //  在单进程环境下,优先也只是顺序不同而已.它们有顺序的必要条件是事件之间存在关联.
    //      它们有关联,耦合性就会变大.
    //      没有关联的话,在单进程环境下,总是要执行完所有的监听器才会继续下面的程序.所以意义不大.
    //  在异步执行的情况下,优先更没有谈及的必要性.
    //      它们同时执行
    //更宽泛的一个条件是:监听器执行次数,执行完那么多次后,自动移除.
    public function on($evnet, $listener);

    // 一个应用场景是在一个监听器中绑定另一个事件.
    public function once($evnet, $listener);

    // listener
    //  闭包
    //  字符串,一个类的一个方法. ex.'App\Logic\Post@addVisitNum';这样要依赖与IoC容器,但是这种太常用了.

    // 触发一个事件,params 为传递的参数,可选.索引数组,与监听器参数对应
    public function emit($event, $params);

    // 移除监听器,
    // 两个参数,$event的$listener
    // 一个参数 $event的所有监听器
    // 没有参数 所有事件的所有监听器
    public function removeListener($event, $listener);


    // 有必要要判断一个事件是否要有监听器,这也是一种依赖.是加强了之间的耦合.
    // public function hasListeners($eventName);

    //事件的状态,未触发,已触发.
    //事件触发队列,历史记录
    //监听器状态,未执行,已执行,已移除
    //监听器执行状态

    //对于一个事件本身来说.要有
    // 触发时间,触发者,
}