<?php
namespace ExternalCronJobs\V1\Services;

use ExternalCronJobs\V1\AbstractServicesBase;

class Folders extends AbstractServicesBase {
    /**
     * @return string
     */
    protected function endpoint() {
        return '/api/v1/folders';
    }
    
    /**
     * @param $name
     * @param $description (OPTIONAL)
     *
     * @return array
     * @throws \Exception
     */
    public function create($name, $description='') {
        return $this->post([
            'name' => $name,
            'description' => $description
        ]);
    }
    
    /**
     * @param      $id
     * @param null $name
     * @param null $description
     *
     * @return array
     * @throws \Exception
     */
    public function update($id, $name = null, $description = null) {
        $parameters = [];
        if (!is_null($name)) {
            $parameters['name'] = $name;
        }
    
        if (!is_null($description)) {
            $parameters['description'] = $description;
        }
        
        return $this->put($id, $parameters);
    }
}

