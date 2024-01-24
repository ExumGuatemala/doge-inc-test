<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_id')
                    ->getStateUsing(function (Model $record) {
                        return $record->client->name;
                    })
                    ->sortable()
                    ->toggleable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'view' => Pages\ViewPet::route('/{record}'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
