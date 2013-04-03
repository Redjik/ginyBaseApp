<?php

class ReplicationBehavior extends CActiveRecordBehavior
{
    public $maserConnectionName = 'master';

    public $slaveConnectionName = 'slave';

    protected $is_explicit=false;

    /**
     * @return CActiveRecord
     */
    public function setToMaster()
    {
        $this->setConnection($this->maserConnectionName);
        return $this->owner;
    }

    /**
     * @return CActiveRecord
     */
    public function setToSlave()
    {
        $this->setConnection($this->slaveConnectionName);
        return $this->owner;
    }

    public function setConnection($name,$setExplicit=true)
    {
        $this->owner->getDbConnection()->setCurrentComponent($name);

        if ($setExplicit)
            $this->is_explicit = true;

        return $this->owner;
    }

    public function beforeSave()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->maserConnectionName,false);
    }

    public function afterSave()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName,false);
        else
            $this->is_explicit = false;
    }

    public function beforeDelete()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->maserConnectionName,false);
    }

    public function afterDelete()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName,false);
        else
            $this->is_explicit = false;
    }

    public function beforeFind()
    {
        if (!$this->is_explicit)
            $this->setConnection($this->slaveConnectionName,false);
        else
            $this->is_explicit = false;
    }

}
