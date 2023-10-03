<?php
/**
 *
 *
 *
 *
 */

App::uses('HttpSocket', 'Network/Http');

class JsonHttpSocket extends HttpSocket {

    public function get($uri = null, $query = array(), $request = array()) {
        if (!empty($query)) {
            //$query = json_encode($query); // update
            $uri = $this->_parseUri($uri, $this->config['request']['uri']);
            if (isset($uri['query'])) {
                $uri['query'] = array_merge($uri['query'], $query);
            } else {
                $uri['query'] = $query;
            }
            $uri = $this->_buildUri($uri);
        }

        // set auth token
        /*
        if ( isset($_SESSION['AuthToken']) ) {
            $request = array_merge($request, array('AuthToken'=>$_SESSION['AuthToken']));
        }
        */

        // do api call
        $apicall = Hash::merge(array('method' => 'GET', 'uri' => $uri), $request);
        $response = $this->request($apicall);

        // update auth token
        /*
        $response_headers = (array) $this->response->headers;
        if( isset($response_headers['_token']) ) {
            $_SESSION['AuthToken'] = $response_headers['_token'];
        }
        */

        return $response;
    }

    public function post($uri = null, $data = array(), $request = array()) {
        $data = json_encode($data); // update

        // set auth token
        /*
        if ( isset($_SESSION['AuthToken']) ) {
            $request = array_merge($request, array('AuthToken'=>$_SESSION['AuthToken']));
        }
        */

        // do api call
        $apicall = Hash::merge(array('method' => 'POST', 'uri' => $uri, 'body' => $data), $request);
        $response = $this->request($apicall);

        // update auth token
        /*
        $response_headers = (array) $this->response->headers;
        if( isset($response_headers['_token']) ) {
            $_SESSION['AuthToken'] = $response_headers['_token'];
        }
        */

        return $response;
    }

    public function put($uri = null, $data = array(), $request = array()) {
        $data = json_encode($data); // update
        $request = Hash::merge(array('method' => 'PUT', 'uri' => $uri, 'body' => $data), $request);
        return $this->request($request);
    }

    public function delete($uri = null, $data = array(), $request = array()) {
        $data = json_encode($data); // update
        $request = Hash::merge(array('method' => 'DELETE', 'uri' => $uri, 'body' => $data), $request);
        return $this->request($request);
    }

}