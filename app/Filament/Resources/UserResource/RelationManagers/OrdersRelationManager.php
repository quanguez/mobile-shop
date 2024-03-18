<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\Order;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label(__('Orders ID'))
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
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('Edit Order')
                        ->label(__('filament-actions::edit.single.label'))
                        ->url(fn (Order $record): string => route('filament.admin.resources.orders.edit', ['record' => $record]))
                        ->color('success')
                        ->icon('heroicon-m-pencil-square'),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
