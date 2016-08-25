<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;
use yii\caching\FileCache;

class AnalyticsPhone extends ActiveRecord
{
    public static function tableName()
    {
        return 'analytics_phone';
    }

    public static function totalStats($cacheDuration = 300)
    {
        $cacheKey = 'AnalyticsPhone_totalStats';

        $cache = new FileCache;
        $stats = $cache->get($cacheKey);

        if ($stats === false) {
            $stats = array(
                'total_calls' => '',
                'total_in_calls' => '',
                'total_out_calls' => '',
                'avg_duration_calls' => '',
                'max_numbers_b' => array(),
            );

            $query = AnalyticsPhone::find();

            $stats['total_calls'] = $query->count();
            $stats['total_in_calls'] = $query->where(['call_direction' => 'inbound'])->count();
            $stats['total_out_calls'] = $query->where(['call_direction' => 'outbound'])->count();
            $stats['avg_duration_calls'] = self::avgDurationCalls();
            $stats['max_numbers_b'] = self::maxNumbersB();

            $cache->set($cacheKey, $stats,$cacheDuration);
        }

        return $stats;

    }

    public static function avgDurationCalls()
    {
        $query = new Query();
        $query->select
            (['id',
                'date_end',
                'date_connect',
                'SEC_TO_TIME(avg(UNIX_TIMESTAMP(date_end) - UNIX_TIMESTAMP(date_connect))) AS avg',
            ])
            ->from(self::tableName())
            ->where('1=1');

        $command = $query->createCommand();
        $result = $command->queryAll();

        if (isset($result['0']['avg'])) {
            return $result['0']['avg'];
        } else {
            return 0;
        }
    }

    public static function maxNumbersB()
    {
        $stats['max_numbers_b'] = array();

        $query = (new \yii\db\Query())->from(self::tableName());

        $countCallsNumberB = $query->select(['COUNT(*) AS cnt', 'number_b'])
            ->orderBy(['cnt' => SORT_DESC])
            ->groupBy(['number_b'])
            ->all();

        $max_count = false;
        foreach ($countCallsNumberB as $numberB) {
            if ($max_count === false) {
                $max_count = $numberB['cnt'];
            }

            if ($max_count == $numberB['cnt']) {
                $stats['max_numbers_b'][] = $numberB['number_b'];
            } else {
                break;
            }
        }
        return $stats['max_numbers_b'];
    }

    public function create($fields)
    {
        $fields = $fields + array(
                'number_a',
                'number_b',
                'date_start',
                'date_connect',
                'date_end',
                'call_direction',
                'comment',
            );


        $customer = new AnalyticsPhone();
        $customer->number_a = $fields['number_a'];
        $customer->number_b = $fields['number_b'];
        $customer->date_start = $fields['date_start'];
        $customer->date_connect = $fields['date_connect'];
        $customer->date_end = $fields['date_end'];
        $customer->call_direction = $fields['call_direction'];
        $customer->comment = $fields['comment'];
        return $customer->save();
    }

    public function delete($all = false)
    {
        if ($all) {
            $customer = new AnalyticsPhone();
            return $customer->deleteAll('1=1');
        }
    }

}