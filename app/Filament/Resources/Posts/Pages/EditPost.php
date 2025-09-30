<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Awcodes\Recently\Concerns\HasRecentHistoryRecorder;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPost extends EditRecord
{
    use HasRecentHistoryRecorder;

    protected static string $resource = PostResource::class;

    public static function getNavigationLabel(): string
    {
        return __('Edit post');
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Post */
        $record = $this->getRecord();

        return $record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
