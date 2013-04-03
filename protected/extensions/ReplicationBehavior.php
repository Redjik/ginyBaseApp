<?php

class ReplicationBehavior extends CActiveRecordBehavior
{
    public $maserConnectionName = 'master';

    public $slaveConnectionName = 'slave';

    protected $is_explicit=false;

    public function setToMaster()
    {
        $this->setConnection($this->maserConnectionName,true);
        return $this->owner;
    }

    public function setToSlave()
    {
        $this->setConnection($this->slaveConnectionName,true);
        return $this->owner;
    }

    protected function setConnection($name,$setExplicit=false)
    {
        $this->owner->getDbConnection()->setConnection($name);

        if ($setExplicit)
            $this->is_explicit = true;
    }

    public function beforeSave()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->maserConnectionName);
    }

    public function afterSave()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName);
        else
            $this->is_explicit = false;
    }

    public function beforeDelete()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->maserConnectionName);
    }

    public function afterDelete()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName);
        else
            $this->is_explicit = false;
    }

    public function beforeFind()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName);
        else
            $this->is_explicit = false;
    }

}
