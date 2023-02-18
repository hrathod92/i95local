<?php

namespace App\Helpers;

class Message {

  public static function postNew( $user, $company, $title, $message ) {
    $record['message_type_id'] = 2;
    $record['user_id'] = $user;
    $record['company_id'] = $company;
    $record['title'] = $title;
    $record['body'] = $message;  
    $message = \App\Message::create($record);
    $message->save();
    $data = 'done';
          
    return $data;
  }
  
}
