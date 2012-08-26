<?php
require_once 'Slim/Slim.php';

class Sumile_Application extends Slim
{
    public function getFinalizedResponse()
    {
        set_error_handler(array('Slim', 'handleErrors'));

        //Apply final outer middleware layers
        $this->add(new Slim_Middleware_PrettyExceptions());

        //Invoke middleware and application stack
        $this->middleware[0]->call();

        //Fetch status, header, and body
        $result = $this->response->finalize();

        restore_error_handler();

        return $result;
    }

    public function run()
    {
        //Fetch status, header, and body
        list($status, $header, $body) = $this->getFinalizedResponse();

        //Send headers
        if ( headers_sent() === false ) {
            //Send status
            if ( strpos(PHP_SAPI, 'cgi') === 0 ) {
                header(sprintf('Status: %s', Slim_Http_Response::getMessageForCode($status)));
            } else {
                header(sprintf('HTTP/%s %s', $this->config('http.version'), Slim_Http_Response::getMessageForCode($status)));
            }

            //Send headers
            foreach ( $header as $name => $value ) {
                $hValues = explode("\n", $value);
                foreach ( $hValues as $hVal ) {
                    header("$name: $hVal", false);
                }
            }
        }

        //Send body
        echo $body;
    }
}
