<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowTransactionResource\Pages;
use App\Filament\Resources\BorrowTransactionResource\RelationManagers;
use App\Models\BorrowTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

use App\Enums\BorrowTransactionStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class BorrowTransactionResource extends Resource
{
    protected static ?string $model = BorrowTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Borrower Details')
                    ->schema([
                        Select::make('user_id')
                            ->required()
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('book_id')
                            ->required()
                            ->relationship('book', 'name')
                            ->searchable()
                            ->preload(),

                        DateTimePicker::make('borrowed_at')
                            ->default(now())
                            ->required(),

                        DateTimePicker::make('return_by')
                            ->default(now()->addDays(15))
                            ->required(),

                    ]),
                Section::make('Admin Details')
                    ->schema([
                        Select::make('status')
                            ->options(BorrowTransactionStatus::class)
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("user.name")
                    ->searchable()
                    ->label('User'),
                TextColumn::make("book.name")
                    ->searchable()
                    ->label('Book'),
                TextColumn::make("borrowed_at")
                    ->searchable()
                    ->label('Borrowed Date'),
                TextColumn::make("return_by")
                    ->searchable()
                    ->label('Return By'),
                TextColumn::make("returned_at")
                    ->searchable()
                    ->label('Returned Date'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBorrowTransactions::route('/'),
            'create' => Pages\CreateBorrowTransaction::route('/create'),
            'view' => Pages\ViewBorrowTransaction::route('/{record}'),
            'edit' => Pages\EditBorrowTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('created_at', 'desc');
    }
}
