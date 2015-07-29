<?php
namespace Wrangle\Contracts\Events;

interface EventsContainer
{
    // �������ռ��ʱ���б�Ҫ����?
    // ���¼�������¼�������Ҫ��?

    //on
    //newListener
    //once

    //�෽��
    //'newContainer'
    //'removeContainer'
    //'newListener'
    //'removeListener'
    //'newEvent'
    //listenerCount ����ָ���¼��� listeners ����
    //setMaxListeners(n) ��������Ŀ����.������ѧ������ѧ�Ĺ۵�,��Ҫ�����Ƶ�.

    //emitter.removeListener(event, listener)

    //�¼�������Ȩ��Ҫ��?ΪʲôҪ����������?
    //  �ڵ����̻�����,����Ҳֻ��˳��ͬ����.������˳��ı�Ҫ�������¼�֮����ڹ���.
    //      �����й���,����Ծͻ���.
    //      û�й����Ļ�,�ڵ����̻�����,����Ҫִ�������еļ������Ż��������ĳ���.�������岻��.
    //  ���첽ִ�е������,���ȸ�û��̸���ı�Ҫ��.
    //      ����ͬʱִ��
    //������һ��������:������ִ�д���,ִ������ô��κ�,�Զ��Ƴ�.
    public function on($evnet, $listener);

    // һ��Ӧ�ó�������һ���������а���һ���¼�.
    public function once($evnet, $listener);

    // listener
    //  �հ�
    //  �ַ���,һ�����һ������. ex.'App\Logic\Post@addVisitNum';����Ҫ������IoC����,��������̫������.

    // ����һ���¼�,params Ϊ���ݵĲ���,��ѡ.��������,�������������Ӧ
    public function emit($event, $params);

    // �Ƴ�������,
    // ��������,$event��$listener
    // һ������ $event�����м�����
    // û�в��� �����¼������м�����
    public function removeListener($event, $listener);


    // �б�ҪҪ�ж�һ���¼��Ƿ�Ҫ�м�����,��Ҳ��һ������.�Ǽ�ǿ��֮������.
    // public function hasListeners($eventName);

    //�¼���״̬,δ����,�Ѵ���.
    //�¼���������,��ʷ��¼
    //������״̬,δִ��,��ִ��,���Ƴ�
    //������ִ��״̬

    //����һ���¼�������˵.Ҫ��
    // ����ʱ��,������,
}