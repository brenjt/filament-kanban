<?php

namespace Mokhosh\FilamentKanban\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Concerns\HasEditRecordModal;
use Mokhosh\FilamentKanban\Concerns\HasStatusChange;

class KanbanBoard extends Page implements HasForms
{
    use HasStatusChange;
    use HasEditRecordModal;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-kanban::kanban-board';

    protected static string $recordTitleAttribute = 'title';

    protected static mixed $recordStatusAttribute = 'status';

    protected function statuses(): Collection
    {
        return collect();
    }

    protected function records(): Collection
    {
        return collect();
    }

    protected function getViewData(): array
    {
        $records = $this->records()
            ->map($this->transformRecords(...));
        $statuses = $this->statuses()
            ->map(function ($status) use ($records) {
                $status['records'] = $records->where('status', $status['id'])->all();

                return $status;
            });

        return [
            'statuses' => $statuses,
        ];
    }

    protected function transformRecords($record): Collection
    {
        return collect([
            'id' => $record->id,
            'title' => $record->{static::$recordTitleAttribute},
            'status' => $record->{static::$recordStatusAttribute},
        ]);
    }
}
