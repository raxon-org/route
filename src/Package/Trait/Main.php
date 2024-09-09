<?php
namespace Package\Raxon\Org\Route\Trait;

use Raxon\Org\Module\Core;

use Raxon\Org\Exception\ObjectException;

trait Main {

    /**
     * @throws ObjectException
     */
    public function list($options=[]): void
    {
        Core::interactive();
        $options = Core::object($options, Core::OBJECT_OBJECT);
        $object = $this->object();

        $route = $object->route();
        if(!$route){
            return;
        }
        $list = $route->data();
        if(empty($list)){
            return;
        }
        foreach($list as $key => $record){
            if(property_exists($record, 'priority')){
                echo $key . ' ('. $record->priority .')' . PHP_EOL;
                if(property_exists($record, 'controller')){
                    echo '  Controller: ' . $record->controller . PHP_EOL;
                }
                if(property_exists($record, 'path')){
                    echo '  Path: ' . $record->path . PHP_EOL;
                }
                if(property_exists($record, 'redirect')){
                    echo '  Redirect: ' . $record->redirect . PHP_EOL;
                }
                if(property_exists($record, 'url')){
                    echo '  Url: ' . $record->url . PHP_EOL;
                }
                if(property_exists($record, 'method')){
                    echo '  Method: ' .  implode(', ', $record->method) . PHP_EOL;
                }
            }
        }
    }
}