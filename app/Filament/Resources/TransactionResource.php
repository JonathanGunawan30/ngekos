<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Select::make('boarding_house_id')
                    ->relationship('boardingHouse', 'name')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Select::make('room_id')
                    ->relationship('room', 'name')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->columnSpan(2),
                Forms\Components\TextInput::make('phone')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        "down_payment" => "Down Payment",
                        "full_payment" => "Full Payment",
                    ])
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Select::make('payment_status')
                    ->options([
                        "pending" => "pending",
                        "paid" => "paid",
                    ])
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->columnSpan(2)
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->numeric()
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\DatePicker::make('transaction_date')
                    ->columnSpan(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('boardingHouse.name'),
                Tables\Columns\TextColumn::make('room.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('payment_status'),
                Tables\Columns\TextColumn::make('total_amount'),
                Tables\Columns\TextColumn::make('transaction_date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
