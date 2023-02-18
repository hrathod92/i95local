<?php
$publishStatuses = \App\PublishStatus::all();

$publishStatusOptions = $publishStatuses
    ->filter(function ($status) use ($item) {
        Gate::allows('setPublishStatusTo', [$item, $status->name]);
        return Gate::allows('setPublishStatusTo', [$item, $status->name]);
    })
    ->keyBy('id')
    ->map(function ($status) {
        return $status->display_name . " ({$status->description})";
    });

?>

{!! Form::select('publish_status_id', $publishStatusOptions) !!}
