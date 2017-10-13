<?php

namespace Billow\Utilities;

use GuzzleHttp\Client;

class SMS
{
    /**
     * Clickatell Platform base endpoint
     * @var string
     */
    protected $apiUrl = 'https://platform.clickatell.com/messages/http/send?apiKey=';

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
     * Send the SMS
     */
    public function send()
    {
        (new Client())->request(
            'GET',
            $this->apiUrl . env('CLICKATELL_API_KEY') . '&to=' . $this->to() . '&content=' . $this->content
        );
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
