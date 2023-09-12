<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = '7588a71b7219986bbaeb9138d2d79cca';
    private $api_key_secret = '55dce37943d2d99aa16d785b6ddd388f';

    public function send($to_email, $to_name, $subject, $content){

        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "sylvain.conesa@hotmail.fr",
                        'Name' => "Nordic"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 4916125,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];
$response = $mj->post(Resources::$Email, ['body' => $body]);
$response->success();
    }
}