<?php

class jqSimple extends jqGrid
{
    protected function init()
    {
        #Set database table
        $this->table = 'analytics_phone';

        #Make all columns editable by default
        $this->cols_default = array('editable' => true);


        #Set columns
        $this->cols = array(

            'id' => array('label' => 'ID',
                'width' => 10,
                'align' => 'center',
                'editable' => false, //id is non-editable
            ),

            'number_a' => array('label' => 'Phone A',
                'width' => 25,
                'align' => 'center',
                'editable' => false,
            ),

            'number_b' => array('label' => 'Phone B',
                'width' => 25,
                'align' => 'center',
                'editable' => false,
            ),

            'date_start' => array('label' => 'Date Start',
                'width' => 40,
                'editable' => false,
                'search_op' => 'date_range',
                'searchoptions' => array('dataInit' => $this->initDateRangePicker(array(
                        'earliestDate' => date('Y-m-d', strtotime("-6 month")),
                        'latestDate' => date('Y-m-d', strtotime("-6 month")),
                        'dateFormat' => 'yy-mm-dd',
                        'onChange' => new jqGrid_Data_Raw('dateRangePicker_onChange'),
                        'presetRanges' => array(
                            array('text' => date('M Y', strtotime("-2 month")), 'dateStart' => date('Y-m-01', strtotime("-2 month")), 'dateEnd' => date('Y-m-t', strtotime("-2 month"))),
                            array('text' => date('M Y', strtotime('previous month')), 'dateStart' => date('Y-m-01', strtotime('previous month')), 'dateEnd' => date('Y-m-t', strtotime('previous month'))),
                            array('text' => date('M Y'), 'dateStart' => date('Y-m-01'), 'dateEnd' => date('Y-m-d')),
                        ),
                        'datepickerOptions' => array(
                            'changeMonth' => true,
                            'changeYear' => true,
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date('Y-m-d', strtotime("-30 years")),
                            'maxDate' => date('Y-m-d'),
                        ),
                    ))),
            ),

            'date_connect' => array('label' => 'Date Connect',
                'width' => 40,
                'align' => 'center',
                'editable' => false,
                'search_op' => 'date_range',
                'searchoptions' => array('dataInit' => $this->initDateRangePicker(array(
                        'earliestDate' => date('Y-m-d', strtotime("-6 month")),
                        'latestDate' => date('Y-m-d', strtotime("-6 month")),
                        'dateFormat' => 'yy-mm-dd',
                        'onChange' => new jqGrid_Data_Raw('dateRangePicker_onChange'),
                        'presetRanges' => array(
                            array('text' => date('M Y', strtotime("-2 month")), 'dateStart' => date('Y-m-01', strtotime("-2 month")), 'dateEnd' => date('Y-m-t', strtotime("-2 month"))),
                            array('text' => date('M Y', strtotime('previous month')), 'dateStart' => date('Y-m-01', strtotime('previous month')), 'dateEnd' => date('Y-m-t', strtotime('previous month'))),
                            array('text' => date('M Y'), 'dateStart' => date('Y-m-01'), 'dateEnd' => date('Y-m-d')),
                        ),
                        'datepickerOptions' => array(
                            'changeMonth' => true,
                            'changeYear' => true,
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date('Y-m-d', strtotime("-30 years")),
                            'maxDate' => date('Y-m-d'),
                        ),
                    ))),
            ),

            'date_end' => array('label' => 'Date End',
                'width' => 40,
                'align' => 'center',
                'editable' => false,
                'search_op' => 'date_range',
                'searchoptions' => array('dataInit' => $this->initDateRangePicker(array(
                        'earliestDate' => date('Y-m-d', strtotime("-6 month")),
                        'latestDate' => date('Y-m-d', strtotime("-6 month")),
                        'dateFormat' => 'yy-mm-dd',
                        'onChange' => new jqGrid_Data_Raw('dateRangePicker_onChange'),
                        'presetRanges' => array(
                            array('text' => date('M Y', strtotime("-2 month")), 'dateStart' => date('Y-m-01', strtotime("-2 month")), 'dateEnd' => date('Y-m-t', strtotime("-2 month"))),
                            array('text' => date('M Y', strtotime('previous month')), 'dateStart' => date('Y-m-01', strtotime('previous month')), 'dateEnd' => date('Y-m-t', strtotime('previous month'))),
                            array('text' => date('M Y'), 'dateStart' => date('Y-m-01'), 'dateEnd' => date('Y-m-d')),
                        ),
                        'datepickerOptions' => array(
                            'changeMonth' => true,
                            'changeYear' => true,
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date('Y-m-d', strtotime("-30 years")),
                            'maxDate' => date('Y-m-d'),
                        ),
                    ))),
            ),

            'call_direction' => array('label' => 'Call Direction',
                'width' => 25,
                'align' => 'center',
                'editable' => false,
            ),

            'comment' => array('label' => 'Comment',
                'width' => 60,
                'align' => 'center',
            ),

        );

        #Set nav
        $this->nav = array('add' => false, 'edit' => true, 'del' => false);

        #Add filter toolbar
        $this->render_filter_toolbar = true;
    }


    protected function searchOpDateRange($c, $val)
    {
        //--------------
        // Date range
        //--------------

        if(strpos($val, ' - ') !== false)
        {
            list($start, $end) = explode(' - ', $val, 2);

            $start = strtotime(trim($start));
            $end = strtotime(trim($end));

            if(!$start or !$end)
            {
                throw new jqGrid_Exception('Invalid date format');
            }

            #Stap dates if start is bigger than end
            if($start > $end)
            {
                list($start, $end) = array($end, $start);
            }

            $start = date('Y-m-d', $start);
            $end = date('Y-m-d', $end);

            return $c['db'] . " BETWEEN '$start' AND '$end'";
        }

        //------------
        // Single date
        //------------

        $val = strtotime(trim($val));

        if(!$val)
        {
            throw new jqGrid_Exception('Invalid date format');
        }

        $val = date('Y-m-d', $val);

        return "DATE({$c['db']}) = '$val'";
    }

    protected function initDatepicker($options = null)
    {
        $options = is_array($options) ? $options : array();

        return new jqGrid_Data_Raw('function(el){$(el).datepicker(' . jqGrid_Utils::jsonEncode($options) . ');}');
    }

    protected function initDateRangePicker($options = null)
    {
        $options = is_array($options) ? $options : array();

        return new jqGrid_Data_Raw('function(el){$(el).daterangepicker(' . jqGrid_Utils::jsonEncode($options) . ');}');
    }
}