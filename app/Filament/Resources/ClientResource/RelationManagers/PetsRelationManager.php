<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PetsRelationManager extends RelationManager
{
    protected static string $relationship = 'pets';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->searchable(['name', 'email'])
                    ->relationship(name: 'client', titleAttribute: 'name'),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Select::make('breed')
                    ->required()
                    ->options([
                        'Labrador Retriever' => 'Labrador Retriever',
                        'German Shepherd' => 'German Shepherd',
                        'Golden Retriever' => 'Golden Retriever',
                        'Bulldog' => 'Bulldog',
                        'Poodle' => 'Poodle',
                        'Beagle' => 'Beagle',
                        'Rottweiler' => 'Rottweiler',
                        'Siberian Husky' => 'Siberian Husky',
                        'Dachshund' => 'Dachshund',
                        'Boxer' => 'Boxer',
                        'Shih Tzu' => 'Shih Tzu',
                        'Yorkshire Terrier' => 'Yorkshire Terrier',
                        'Pomeranian' => 'Pomeranian',
                        'Chihuahua' => 'Chihuahua',
                        'Doberman Pinscher' => 'Doberman Pinscher',
                        'Pug' => 'Pug',
                        'Great Dane' => 'Great Dane',
                        'Border Collie' => 'Border Collie',
                        'Australian Shepherd' => 'Australian Shepherd',
                        'Shetland Sheepdog' => 'Shetland Sheepdog',
                    ]),
                Forms\Components\TextInput::make('age')
                    ->required(),
                Forms\Components\TextArea::make('comments')
                    ->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('breed')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('age')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('comments')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
