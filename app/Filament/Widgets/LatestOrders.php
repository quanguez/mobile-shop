<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label(__('Orders ID'))
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label(__('Customer'))
                    ->searchable(),
                TextColumn::make('grand_total')
                    ->label(__('Grand Total'))
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge(),
                TextColumn::make('payment_method')
                    ->label(__('Payment Method'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('payment_status')
                    ->label(__('Payment Status'))
                    ->sortable()
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('Order Date'))
                    ->dateTime(),
            ])->actions([Action::make('Edit Order')
                ->label(__('filament-actions::edit.single.label'))
                ->url(fn (Order $record): string => route('filament.admin.resources.orders.edit', ['record' => $record]))
                ->color('success')
                ->icon('heroicon-m-pencil-square'), ]);
    }
}
