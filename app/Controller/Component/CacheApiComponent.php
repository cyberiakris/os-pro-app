<?php
// app/Controller/Component/CacheApiComponent.php

class CacheApiComponent extends Component {

    public $controller;

    public function initialize(Controller $controller) {
        $this->controller = $controller;
    }

    public function cachedApiData($url) {
        // Define an absolute path to the cache directory in the root of your project
        $cacheDirectory = ROOT . DS . 'cache';

        // Ensure the cache directory exists or create it if it doesn't
        if (!is_dir($cacheDirectory)) {
            mkdir($cacheDirectory, 0755, true);
        }

        $cacheFile = $cacheDirectory . DS . md5($url);

        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < 86400)) {
            // If cache file exists and is less than 1 day old, return cached data
            $cacheData = file_get_contents($cacheFile);
            return json_decode($cacheData, true);

        } else {
            // If cache doesn't exist or is expired, fetch data from the API
            $httpClient = $this->controller->HTTPClient; // Access the $this->HTTPClient instance from the controller
            $requestHeaders = $this->controller->request_headers;
            $data = $httpClient->get($url, array(), $requestHeaders);
            //debug($data); exit;

            // Save the data to the cache file
            file_put_contents($cacheFile, $data);

            return json_decode($data, true);
        }
    }

    // You would also need to define the `curlGetRequest` method here or import it from another class.
}
