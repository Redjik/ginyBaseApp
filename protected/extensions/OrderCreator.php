<?php

class OrderCreator extends GDICComponent
{
    public function registerCoreComponents()
    {
        $components = array(
            'RPCUserProfile'=>array(
                'class'=>'RPCUserProfile'
            )
        );

        $this->setComponents($components);
    }
}
