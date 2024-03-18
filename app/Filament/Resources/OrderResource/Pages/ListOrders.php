<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'new' => Tab::make('New')->query(fn ($query) => $query->where('status', OrderStatus::New)),
            'processing' => Tab::make('Processing')->query(fn ($query) => $query->where('status', OrderStatus::Processing)),
            'shipped' => Tab::make('Shipped')->query(fn ($query) => $query->where('status', OrderStatus::Shipped)),
            'delivered' => Tab::make('Delivered')->query(fn ($query) => $query->where('status', OrderStatus::Delivered)),
            'cancelled' => Tab::make('Cancelled')->query(fn ($query) => $query->where('status', OrderStatus::Cancelled)),
        ];
    }
}
