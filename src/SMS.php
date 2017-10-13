<?php

namespace Billow\Utilities;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Log;

class SMS
{
    /**
     * Clickatell Platform base URL
     * @var string
     */
    protected $apiBase = 'https://platform.clickatell.com/';

    /**
     * Http send method endpoint
     * @var string
     */
    protected $apiEndpoint = 'messages/http/send?apiKey=';

    /**
     * SMS content
     * @var mixed
     */
    protected $content;

    /**
     * Recipients
     * @var array
     */
    protected $recipients = [];

    /**
     * Set the content for this SMS
     * @param  $content
     * @return mixed
     */
    public function content($content)
    {
        $this->content = urlencode($content);

        return $this;
    }

    /**
     * Push a new recipient to the collection
     * @param  $mobile
     * @return mixed
     */
    public function recipient($mobile)
    {
        $this->recipients = collect();
        $this->recipients->push(urlencode($mobile));

        return $this;
    }

    /**
     * Send the SMS and check the API response
     * @return bool
     */
    public function send()
    {
        if (!$apiKey = env('CLICKATELL_API_KEY')) {
            abort(401, 'The Clickatell Platform API key has not been set.');
        }

        $requestUrl = $this->apiEndpoint . $apiKey . '&to=' . $this->to() . '&content=' . $this->content;
        $response = (new Client(['base_uri' => $this->apiBase]))->request('GET', $requestUrl);

        return $this->checkResponse($response);
    }

    /**
     * If Clickatell returned a 200, it means an error occurred.
     * Log the error and return false, or return true if it was successful.
     * Note: Clickatell returns status code 202 on success.
     * @param  Response        $response
     * @throws HttpException
     * @return bool            true
     */
    protected function checkResponse(Response $response)
    {
        if ($response->getStatusCode() === 200) {
            Log::error(json_decode($response->getBody()->getContents())->error);

            return false;
        }

        return true;
    }

    /**
     * Implode the recipient collection for the API URL
     * @return string
     */
    protected function to()
    {
        return $this->recipients->implode(',');
    }
}
