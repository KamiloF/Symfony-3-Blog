<?php

namespace Invest\TrainingBundle\Helper\Journal;

class Entry {
    private $company_name;
    private $start_date;
    private $purchase_price;
    private $quantity;
    private $end_date;
    private $selling_price;
    
    private $result;
    
    function __construct(array $row) {
        foreach($row as $key=>$val){
            $this->$key = $val;
        }
    }

    public function getCompanyName() {
        return $this->company_name;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function getPurchasePrice() {
        return $this->purchase_price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getEndDate() {
        return $this->end_date;
    }

    public function getSellingPrice() {
        return $this->selling_price;
    }
    
    public function isFinished(){
        return (NULL !== $this->end_date);
    }
    
    public function getResult(){
        if(!$this->isFinished()){
            return NULL;
        }
        
        if(!isset($this->result)){
            $this->result = ($this->selling_price*$this->quantity) - ($this->purchase_price*$this->quantity);
        }
        
        return $this->result;
    }
    
    public function isClosedPositive(){
        if(!$this->isFinished()){
            return FALSE;
        }
        
        return ($this->getResult() > 0);
    }
    
    public function isClosedNegative(){
        if(!$this->isFinished()){
            return FALSE;
        }
        
        return ($this->getResult() <= 0);
    }
}
