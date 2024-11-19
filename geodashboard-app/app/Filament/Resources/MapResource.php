<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MapResource\Pages;
use App\Filament\Resources\MapResource\RelationManagers;
use App\Models\Layer;
use App\Models\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;

class MapResource extends Resource
{
    protected static ?string $model = Map::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('g_uuid')
                        ->disabled(),
                    Forms\Components\TextInput::make('g_slug')
                        ->disabled()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('g_label')
                        ->required()
                        ->unique('maps', 'g_label', ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('g_template')
                        ->default('template_mapbox01')
                        ->maxLength(255),
                    Forms\Components\Repeater::make('g_layers')
                        ->schema([
                            Forms\Components\Grid::make([
                                'default' => 1,
                                'md' => 4
                            ])->schema([
                                Forms\Components\TextInput::make('group_name'),
                                Forms\Components\TextInput::make('group_slug'),
                                Forms\Components\Toggle::make('status')->inline(false)->default(false),
                                Forms\Components\Toggle::make('checked')->inline(false)->default(false),
                            ]),

                            Forms\Components\Repeater::make('layers')
                                ->schema([
                                    Forms\Components\Select::make('id')
                                        ->options(fn() => Layer::pluck('g_label as name', 'id'))
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                        ->required(),
                                    Forms\Components\Toggle::make('checked')->inline(false)->default(false),
                                    Forms\Components\Toggle::make('status')->inline(false)->default(false),
                                ])->addActionLabel("Add Layers")->columns(3)->columnSpan(4)
                        ])->columns(4)
                        ->reorderable()
                        ->cloneable()
                        ->collapsible()
                        ->minItems(1)
                        ->itemLabel("Add Layer Group")
                        ->addActionLabel("Add Group")
                        ->columnSpan('full'),

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
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('g_template')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\Action::make('edit')
                    ->label('Dashboard')
                    ->icon('heroicon-o-computer-desktop')
                    ->color('info')
                    ->url(function (Map $record) {
                        return route('app.dashboard.view', $record->g_uuid);
                    }),
                Tables\Actions\ReplicateAction::make()
                    ->beforeReplicaSaved(function (Map $replica): void {
                        $qid = uniqid();
                        $replica->g_label = "New Map ". $qid;
                        $replica->g_slug = "new-map-". $qid;
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
            'index' => Pages\ListMaps::route('/'),
            'create' => Pages\CreateMap::route('/create'),
            'edit' => Pages\EditMap::route('/{record}/edit'),
        ];
    }
}
