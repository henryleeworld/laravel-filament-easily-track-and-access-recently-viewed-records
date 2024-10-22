<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Awcodes\Recently\Concerns\HasRecentHistoryRecorder;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewPost extends ViewRecord
{
    use HasRecentHistoryRecorder;

    protected static string $resource = PostResource::class;

    public static function getNavigationLabel(): string
    {
        return __('View post');
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Post */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getActions(): array
    {
        return [];
    }
}
