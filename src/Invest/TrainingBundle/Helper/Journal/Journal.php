<?php

namespace Invest\TrainingBundle\Helper\Journal;

class Journal {
    
    static function getHistoryAsArray(){
        return array(
            array(
                'company_name' => 'atrem',
                'start_date' => new \DateTime('2012-03-03 00:00:00'),
                'purchase_price' => 7.53,
                'quantity' => 1000,
                'end_date' => new \DateTime('2012-05-05 00:00:00'),
                'selling_price' => 9.12
            ),
            array(
                'company_name' => 'debica',
                'start_date' => new \DateTime('2013-01-13 00:00:00'),
                'purchase_price' => 96.22,
                'quantity' => 100,
                'end_date' => NULL,
                'selling_price' => NULL
            ),
            array(
                'company_name' => 'alchemia',
                'start_date' => new \DateTime('2012-03-13 00:00:00'),
                'purchase_price' => 4.21,
                'quantity' => 1550,
                'end_date' => new \DateTime('2012-10-05 00:00:00'),
                'selling_price' => 7.12
            ),
            array(
                'company_name' => 'votum',
                'start_date' => new \DateTime('2013-06-03 00:00:00'),
                'purchase_price' => 7.53,
                'quantity' => 1110,
                'end_date' => NULL,
                'selling_price' => NULL
            ),
            array(
                'company_name' => 'krec',
                'start_date' => new \DateTime('2013-09-13 00:00:00'),
                'purchase_price' => 7.53,
                'quantity' => 1000,
                'end_date' => new \DateTime('2013-12-12 00:00:00'),
                'selling_price' => 6.32
            ),
            array(
                'company_name' => 'alma',
                'start_date' => new \DateTime('2012-12-12 00:00:00'),
                'purchase_price' => 7.53,
                'quantity' => 1000,
                'end_date' => NULL,
                'selling_price' => NULL
            )
        );
    }
    
    static function getHistoryAsObjects(){
        $objArr = array();
        foreach(static::getHistoryAsArray() as $row){
            $objArr[] = new Entry($row);
        }
        
        return $objArr;
    }
    
}
