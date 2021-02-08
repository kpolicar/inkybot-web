<?php

namespace App\Listeners;

use App\Exceptions\ForumRequestException;
use Arr;
use Http;
use App\Events\MagePublishUploaded;
use App\Models\MagePublish;

class PostMagePublishToForum
{
    public function handle(MagePublishUploaded $event)
    {
        $existing = $event->magePublish->user->publishes()->postedOnForum()->first();

        if (!$existing)
            $this->postNewThread($event->magePublish);
        else
            $this->postNewComment($event->magePublish, $existing->ex_thread_id);
    }

    private function postNewThread(MagePublish $magePublish)
    {
        $data = $this->data($magePublish);

        try {
            $resultNewThread = $this->authorizedRequest()->post(
                config('services.xenforo.endpoint').'/threads/',
                ['node_id' => config('services.xenforo.node')] + $data
            );
            \Log::info("INTERESTING PART1:");
            \Log::info($resultNewThread);
            throw_unless(
                data_get($resultNewThread, 'success', false),
                ForumRequestException::class);

            $magePublish->ex_thread_id = data_get($resultNewThread, 'thread.thread_id');
            $magePublish->save();
        } catch (\Exception $e) {
            \Log::info("INTERESTING PART:");
            \Log::info($e);
        }
    }

    private function postNewComment(MagePublish $magePublish, $threadId)
    {
        $data = $this->data($magePublish);

        try {
            $resultNewComment = $this->authorizedRequest()->post(
                config('services.xenforo.endpoint') . '/posts/',
                ['thread_id' => $threadId] + Arr::only($data, 'message')
            );
            \Log::info("INTERESTING PART1:");
            \Log::info($resultNewComment);
            throw_unless(
                data_get($resultNewComment, 'success', false),
                ForumRequestException::class);

            $resultUpdatedPost = $this->authorizedRequest()->post(
                config('services.xenforo.endpoint') . "/threads/$threadId/",
                Arr::only($data, 'title')
            );
            \Log::info($resultUpdatedPost);
            throw_unless(
                data_get($resultUpdatedPost, 'success', false),
                ForumRequestException::class);

            $magePublish->ex_thread_id = $threadId;
            $magePublish->save();
        } catch (\Exception $e) {
            \Log::info("INTERESTING PART:");
            \Log::info($e);
        }
    }

    private function authorizedRequest() {
        return Http::asForm()->withHeaders([
            'XF-Api-Key' => config('services.xenforo.key')
        ]);
    }

    private function data(MagePublish $magePublish) {
        $url = asset($magePublish->image_path);
        $publishes = $magePublish->user
            ->publishes()
            ->postedOnForum()
            ->get();
        if (!$publishes->contains($magePublish))
            $publishes->push($magePublish);

        $count = $publishes->count();

        return [
            'title' => "[$count] {$magePublish->user->name}",
            'message' => "[IMG]{$url}[/IMG]",
        ];
    }
}
