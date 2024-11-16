<?php

namespace App\Filament\Resources;

use App\FeatureTypeEnum;
use App\Filament\Resources\LayerResource\Pages;
use App\LayerTypeEnum;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('g_label')
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
                    Forms\Components\Textarea::make('g_layer_url')
                        ->required(255)
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('g_meta')
                        ->schema([
                            Forms\Components\Select::make('id')
                                ->options([
                                    'mapbox_styles' => 'mapbox_styles',
                                    'mapbox_min_zoom' => 'mapbox_min_zoom',
                                    'mapbox_max_zoom' => 'mapbox_max_zoom',
                                ])
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->label('Attribute')->required()->columnSpan(1),
                            \InvadersXX\FilamentJsoneditor\Forms\JSONEditor::make('value')
                                ->modes(['code', 'form', 'text', 'tree', 'view', 'preview'])
                                ->required()
                                ->columnSpan(3)
                        ])
                        ->itemLabel("Add Attribute")
                        ->addActionLabel("Add Attribute")
                        ->minItems(1)->columns(4)->columnSpanFull(),
                    Forms\Components\Toggle::make('g_feature_label_visibility')
                        ->live()
                        ->default(0),
                    Forms\Components\Textarea::make('g_feature_label_value')
                        ->live()
                        ->requiredIf('g_feature_label_visibility', 1),
                    Forms\Components\Toggle::make('g_feature_hover_enabled')
                        ->live()
                        ->default(0),
                    Forms\Components\Textarea::make('g_feature_hover_value')
                        ->live()
                        ->requiredIf('g_feature_hover_enabled', 1),
                    Forms\Components\Toggle::make('g_feature_click_enabled')
                        ->live()
                        ->default(0),
                    Forms\Components\Textarea::make('g_feature_click_value')
                        ->live()
                        ->requiredIf('g_feature_click_enabled', 1),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_layer_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_layer_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_feature_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('g_feature_label_visibility')
                    ->boolean(),
                Tables\Columns\IconColumn::make('g_feature_hover_enabled')
                    ->boolean(),
                Tables\Columns\IconColumn::make('g_feature_click_enabled')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable(),
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
