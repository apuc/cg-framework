<?php


namespace core;


class Authorization
{
    /**
     * @return string
     */
    public function getBasicAuthData() : string
    {
        $opts = ['http' => ['header'  => 'Authorization: ' . apache_request_headers()['Authorization']]];

        $context  = stream_context_create($opts);

        return file_get_contents("http://rep.loc/authentication", false, $context);
    }

    /**
     * @param $auth
     * @return array
     */
    public function parseBasicAuthData($auth) : array
    {
        $data = base64_decode(str_replace('Basic ', '', $auth));
        $username = strstr($data, ':', true);
        $password = str_replace($username . ':', '', $data);

        return ['username' => $username, 'password' => $password];
    }
}