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
     * Ϊ�¼�ע�������
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
     * �����¼�
     *
     * @param string $event
     * @param mixed $args
     * @return bool û��ע���¼�����false
     */
    public function emit($event, $args=[])
    {
        if (array_key_exists($event, $this->listeners)) {

            if (!is_array($args)) {
                $args = [$args];
            }

            foreach ($this->listeners[$event] as $listener) {
                // ���Ҫ���ؽ��,����һ�ּ�ǿ���.��Ҫ��ϸ˼��д����¼����Ƶ�Ŀ����ʲô? $response =
                call_user_func_array($this->makeListener($listener), $args);
            }
        }
        return false;
        // todo Ҫ��Ҫ׼ȷ�жϼ������費��Ҫ����
    }

    /**
     * �Ƴ��¼�
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

        // todo ����������д��
        //      ׼ȷ����,����.
        //      ��Ĭ����,���Բ�����key�Ĵ���.
        // �ڲ�ȷ���Ƿ�ע�����¼�ȴ�ֲ����ж��¼��Ƿ�ע����������,�޷�����.
        // ����Ϊʲô����ֲ�֪���Ƿ�ע�����Ǹ��¼���.
        // ��������һ��Э���������.�ͺ������ǲ�֪���û��Ƿ���д��ע�����ĳЩ�ֶ�һ��.��������Ӧ�ó����������ڵĳ�����
        throw new Exception('û��ע����¼�');
    }

    /**
     * ����������,����������
     * @param $listener
     * @throws Exception
     */
    private function makeListener($listener)
    {
        return is_string($listener) ? $this->createClassListener($listener) : $listener;
    }

    /**
     * ���˼�����
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
        // todo ������֧��
        throw new Exception('������ֻ��Ϊ�Ϸ��ַ����Ϳɵ��ñ���');
    }

    /**
     * ͨ���ַ�������������
     * @param $listener
     * @throws Exception
     */
    public function createClassListener($listener)
    {
        // todo �ַ���,������`IoC`
        throw new Exception('��ʱ����֧���ַ���');
    }
}