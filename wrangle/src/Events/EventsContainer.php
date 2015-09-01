<?php

namespace Wrangle\Events;

use Exception;
use Wrangle\Contracts\Events\EventsContainer as I_EventsContainer;

class EventsContainer implements I_EventsContainer
{

    /**
     * @var array
     */
    private $listeners = [];

    /**
     * 为事件注册监听器
     *
     * @param string|array $events
     * @param string|callable $listener
     * @throws Exception
     */
    public function on($events, $listener)
    {
        foreach ((array)$events as $event) {
            $this->listeners[$event][] = $this->filterListener($listener);
        }
    }

    /**
     * 触发事件
     *
     * @param string $event
     * @param mixed $args
     * @return bool 没有注册事件返回false
     */
    public function emit($event, $args=[])
    {
        if (array_key_exists($event, $this->listeners)) {

            if (!is_array($args)) {
                $args = [$args];
            }

            foreach ($this->listeners[$event] as $listener) {
                // 如果要返回结果,这是一种加强耦合.我要仔细思考写这个事件机制的目的是什么? $response =
                call_user_func_array($this->makeListener($listener), $args);
            }
        }
        return false;
        // todo 要不要准确判断监听器需不需要参数
    }

    /**
     * 移除事件
     *
     * @param string $event
     * @throws Exception
     */
    public function removeListener($event)
    {
        if (array_key_exists($event, $this->listeners)) {
            unset($this->listeners[$event]);
            return;
        }

        // todo 这里有两种写法
        //      准确处理,报错.
        //      隐默处理,忽略不存在key的错误.
        // 在不确定是否注册了事件却又不能判断事件是否注册过的情况下,无法操作.
        // 但是为什么会出现不知道是否注册了那个事件呢.
        // 当两个人一起协作的情况下.就好像我们不知道用户是否填写了注册表单的某些字段一样.但是这种应用场景符合现在的场景吗
        throw new Exception('没有注册该事件');
    }

    /**
     * 制作监听器,解析监听器
     * @param $listener
     * @throws Exception
     */
    private function makeListener($listener)
    {
        return is_string($listener) ? $this->createClassListener($listener) : $listener;
    }

    /**
     * 过滤监听器
     *
     * @param $listener
     * @return mixed
     * @throws Exception
     */
    private function filterListener($listener)
    {
        if (is_callable($listener) || is_string($listener)) {
            return $listener;
        }
        // todo 多语言支持
        throw new Exception('监听器只能为合法字符串和可调用变量');
    }

    /**
     * 通过字符串创建监听器
     * @param $listener
     * @throws Exception
     */
    public function createClassListener($listener)
    {
        // todo 字符串,依赖于`IoC`
        throw new Exception('暂时还不支持字符串');
    }
}