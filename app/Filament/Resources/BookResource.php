<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Filament\Resources\BookResource\RelationManagers\AuthorsRelationManager;
use App\Filament\Resources\BookResource\RelationManagers\BorrowTransactionsRelationManager;
use App\Filament\Resources\BookResource\RelationManagers\ReviewsRelationManager;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;


class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

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
                    ->sortable()
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            BorrowTransactionsRelationManager::class,
            AuthorsRelationManager::class,
            ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
