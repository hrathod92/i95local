<?php

namespace App\Helpers;

use App\Article;
use Mail;

class Email {

public static function newArticle($id)
    {			
      	$item = \App\Article::find($id);
	  	$setting = \App\Setting::where('slug', 'notification_emails')->first();
		$emails = explode(', ', $setting->body);

	  	foreach($emails as $key => $value){
			$error = Mail::send('emails.article', $item->toArray(), function ($message) use ($item, $value)
			{
				$message->from( \App\Setting::where('slug', 'contact-email-from')->first()->body, 'I95 Business');
				$message->subject('New Article Submission');
				$message->to(trim($value));
			});
		}
		return $error;
	}
	
public static function newAd($id)
    {			
		$error  = null;
		$item = \App\Company::find($id);

		if(!empty($item->email)){
			$error = Mail::send('emails.advert', $item->toArray(), function ($message) use ($item)
				{
						$message->from( \App\Setting::where('slug', 'contact-email-from')->first()->body, 'I95 Business');
						$message->subject(\App\Setting::where('slug', 'email_ad_subject')->first()->body);
						$message->to($item->email);
				});
		}
		return $error;
	}
	
public static function articleSubmitted($id)
    {			
      	$item = \App\Article::find($id);
	  	$setting = \App\Setting::where('slug', 'notification_emails')->first();
		$emails = explode(', ', $setting->body);
	  	foreach($emails as $key => $value){
			$error = Mail::send('emails.article', $item->toArray(), function ($message) use ($item, $value)
				{
					$message->from( \App\Setting::where('slug', 'contact-email-from')->first()->body, 'I95 Business');
					$message->subject('New Article Submission');
					$message->to(trim($value));
				});
		}
		return $error;
	  }
}
