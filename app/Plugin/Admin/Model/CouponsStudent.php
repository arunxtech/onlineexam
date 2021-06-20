<?php

class CouponsStudent extends AppModel
{
    public $belongsTo = array('Coupon', 'Student');
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('name' => array('field' => 'Coupon.name', 'type' => 'like'),
        'start_date' => array('type' => 'expression', 'method' => 'UsedDate', 'field' => 'CouponsStudent.redeem_date BETWEEN ? AND ?'),
        'end_date' => array('type' => 'query', 'method' => 'CreationDateRangeCondition'),
    );

    public function UsedDate($data = array())
    {
        return array(CakeTime::format('Y-m-d', $data['start_date']) . ' 00:00:00', CakeTime::format('Y-m-d', $data['end_date']) . ' 23:59:59');
    }

    public function GeneretaeDate($data = array())
    {
        return array($data['gstart_date'], $data['gend_date']);
    }

    function showCouponData($post, $dtmFormat)
    {
        $showData = array(array(__('Coupon Name'), __('Coupon Code'), __('Generate Date'), __('Student Name'), __('Student Email'), __('Used Date')));
        foreach ($post as $value) {
            $showData[] = array(
                $value['Coupon']['name'],
                $value['Coupon']['code'],
                CakeTime::format($dtmFormat, $value['Coupon']['created']),
                $value['Student']['name'],
                $value['Student']['email'],
                CakeTime::format($dtmFormat, $value['CouponsStudent']['redeem_date'])
            );
        }
        return $showData;
    }
}

?>