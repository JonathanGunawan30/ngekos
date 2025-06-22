<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;
use App\Models\BoardingHouse;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationGroup = 'Boarding House Management';

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Informasi Umum')
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('boarding_houses')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->debounce(500)
                                    ->reactive()
                                    ->columnSpan(2)
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\Select::make('city_id')
                                    ->relationship('city', 'name')
                                    ->columnSpan(2)
                                    ->required(),
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->columnSpan(2)
                                    ->required(),
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->columnSpan(2),
                                Forms\Components\Textarea::make('address')
                                    ->columnSpan(2)
                                    ->required()
                            ]),
                        Tabs\Tab::make('Bonus Ngekos')
                            ->schema([
                                Repeater::make('bonuses')
                                    ->relationship('bonuses')
                                    ->schema([
                                        Forms\Components\FileUpload::make('images')
                                            ->image()
                                            ->directory('bonus')
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\Textarea::make('description')
                                            ->required()
                                            ->columnSpan(2),
                                    ])
                            ]),
                        Tabs\Tab::make('Kamar')
                            ->schema([
                                Repeater::make('rooms')
                                    ->relationship('rooms')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('room_type')
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('square_feet')
                                            ->numeric()
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('capacity')
                                            ->required()
                                            ->numeric()
                                            ->columnSpan(2),
                                        Forms\Components\TextInput::make('price_per_month')
                                            ->required()
                                            ->prefix('IDR')
                                            ->numeric()
                                            ->columnSpan(2),
                                        Forms\Components\Toggle::make('is_available')
                                            ->columnSpan(2)
                                            ->required(),
                                        Repeater::make('images')
                                            ->relationship('images')
                                            ->columnSpan(2)
                                            ->schema([
                                                Forms\Components\FileUpload::make('images')
                                                    ->image()
                                                    ->directory('rooms')
                                                    ->required()
                                                    ->columnSpan(2),
                                            ])
                                    ])
                            ]),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('price'),
            ])
            ->filters([
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
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
