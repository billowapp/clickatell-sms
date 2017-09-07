<?php
namespace Billow\Utilities;

use GuzzleHttp\Client;

class SMS
{
  protected $recipients = [];
  protected $content;
  protected $apiUrl = 'https://platform.clickatell.com/messages/http/send?apiKey=';

  public function content($content)
  {
      $this->content = urlencode($content);
      return $this;
  }

  public function recipient($mobile)
  {
      $this->recipients = collect();
      $this->recipients->push(urlencode($mobile));
      return $this;
  }

  public function send()
  {
      (new Client)->request(
        'GET',
        $this->apiUrl . env('CLICKATELL_API_KEY') . '&to='. $this->to() . '&content=' . $this->content
      );
  }

  protected function to()
  {
      return $this->recipients->implode(',');
  }
}
