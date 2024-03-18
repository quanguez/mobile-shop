<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->maxLength(20),
                TextInput::make('email')
                    ->label('Email Address')
                    ->maxLength(255),
                Select::make('city')
                    ->options([
                        'hanoi' => 'Hà Nội',
                        'hochiminh' => 'TP. Hồ Chí Minh',
                    ]),
                Select::make('state')
                    ->options([
                        'hanoi' => 'Hà Nội',
                        'hochiminh' => 'TP. Hồ Chí Minh',
                    ]),
                Textarea::make('street_address')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('zip_code')
                    ->numeric()
                    ->required()
                    ->maxLength(10),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                    ->label('Full Name'),
                TextColumn::make('phone'),
                TextColumn::make('street_address'),
                TextColumn::make('city'),
                TextColumn::make('state'),
                TextColumn::make('zip_code'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
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
