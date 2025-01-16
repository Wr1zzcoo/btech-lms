<?php

namespace App\Filament\User\Resources\BookResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar as RatingColumn;
use IbrahimBougaoua\FilamentRatingStar\Forms\Components\RatingStar as RatingField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        RatingField::make('stars')
                            ->required(),
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),
                        TextInput::make('title'),
                        Textarea::make('description'),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('stars')
            ->columns([
                RatingColumn::make('stars'),
                TextColumn::make('user.name'),
                TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                // Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->action(
                        Tables\Actions\CreateAction::class
                    ),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DissociateAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DissociateBulkAction::make(),
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
