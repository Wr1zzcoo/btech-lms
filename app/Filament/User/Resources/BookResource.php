<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\BookResource\Pages;
use App\Filament\User\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('publisher_id')
                            ->relationship('publisher', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                        TextInput::make('quantity')
                            ->required()
                            ->default(1)
                            ->numeric(),
                        Select::make('authors')
                            ->relationship('authors', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->native(false),
                        Toggle::make('is_available')
                            ->default(true)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('publisher.name')
                    ->searchable(),
                TextColumn::make('quantity'),
                TextColumn::make('available_quantity'),
                IconColumn::make('is_available')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListBooks::route('/'),
            'view' => Pages\ViewBook::route('/{record}'),
        ];
    }

    // Query

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_available', true);
    }
}
