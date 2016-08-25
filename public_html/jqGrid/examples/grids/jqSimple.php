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
                'width' => 25,
                'align' => 'center',
                'editable' => false,
            ),

            'date_connect' => array('label' => 'Date Connect',
                'width' => 25,
                'align' => 'center',
                'editable' => false,
            ),

            'date_end' => array('label' => 'Date End',
                'width' => 25,
                'align' => 'center',
                'editable' => false,
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
        $this->nav = array('add' => true, 'edit' => true, 'del' => true);

        #Add filter toolbar
        $this->render_filter_toolbar = true;
    }
}