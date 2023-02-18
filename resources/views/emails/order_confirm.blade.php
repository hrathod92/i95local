<p>Hello {{$user->full_name}},</p>

<p>A new monthly recurring order of goodies has been created for {{$accountName}}.  We’ll need you to login at <a href="{{\URL::to('/')}}">{{\URL::to('/')}}</a> to confirm this order in case someone other than you created it by mistake.  If you don’t login to confirm, we’ll assume you it’s a good order and schedule your recurring delivery of goodies.</p>
<p>The Robot of Floorco Express</p>
