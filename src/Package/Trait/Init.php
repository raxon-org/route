<?php
namespace Package\Raxon\Route\Trait;

use Raxon\App;

use Raxon\Module\Core;
use Raxon\Module\File;

use Raxon\Node\Model\Node;

use Exception;
trait Init {

    /**
     * @throws Exception
     */
    public function register(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $node = new Node($object);
        $record_options = [
            'where' => [
                [
                    'value' => $object->request('package'),
                    'attribute' => 'name',
                    'operator' => '===',
                ]
            ]
        ];
        $class = 'System.Installation';
        $response = $node->record($class, $node->role_system(), $record_options);
        if(
            $response &&
            array_key_exists('node', $response)
        ){
            if(property_exists($options, 'force')){
                $record = $response['node'];
                $record->mtime = time();
                $response = $node->put($class, $node->role_system(), $record);
                echo 'Register update ' . $object->request('package') . ' installation...' . PHP_EOL;
            } else {
                echo 'Skipping ' . $object->request('package') . ' installation...' . PHP_EOL;
            }
        } else {
            $time = time();
            $record = (object) [
                'name' => $object->request('package'),
                'ctime' => $time,
                'mtime' => $time,
            ];
            $response = $node->create($class, $node->role_system(), $record);
            echo 'Registering ' . $object->request('package') . ' installation...' . PHP_EOL;
        }
    }
}