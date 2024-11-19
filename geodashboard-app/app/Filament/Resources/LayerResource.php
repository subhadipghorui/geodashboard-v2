<?php

namespace App\Filament\Resources;

use App\FeatureTypeEnum;
use App\Filament\Resources\LayerResource\Pages;
use App\LayerTypeEnum;
use App\MapTypeEnum;
use App\Models\Layer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;

class LayerResource extends Resource
{
    protected static ?string $model = Layer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Dashboard';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('g_label')
                        ->unique('layers', 'g_label', ignoreRecord: true)
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('g_slug')
                        ->disabled()
                        ->maxLength(255),
                    Forms\Components\Select::make('g_layer_type')
                        ->options(LayerTypeEnum::class)
                        ->required(),
                    Forms\Components\Select::make('g_feature_type')
                        ->options(FeatureTypeEnum::class)
                        ->required(),
                    Forms\Components\Select::make('g_map_type')
                        ->options(MapTypeEnum::class)
                        ->default(MapTypeEnum::Mapbox)
                        ->required(),
                    \InvadersXX\FilamentJsoneditor\Forms\JSONEditor::make('g_layer_config')
                        ->height(600)
                        ->default(json_decode(config('global.G_Layer_Config')))
                        ->required()
                        ->columnSpanFull(),
                    \InvadersXX\FilamentJsoneditor\Forms\JSONEditor::make('g_meta')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('status')
                        ->required()
                        ->default(1),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('g_uuid')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_layer_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_feature_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_map_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_by')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\ReplicateAction::make()
                ->beforeReplicaSaved(function (Layer $replica): void {
                    $qid = uniqid();
                    $replica->g_label = "New Layer ". $qid;
                    $replica->g_slug = "new-slug-". $qid;
                }),
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
            'index' => Pages\ListLayers::route('/'),
            'create' => Pages\CreateLayer::route('/create'),
            'edit' => Pages\EditLayer::route('/{record}/edit'),
        ];
    }
}
