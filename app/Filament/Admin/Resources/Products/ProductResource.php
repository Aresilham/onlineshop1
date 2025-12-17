<?php

namespace App\Filament\Admin\Resources\Products;

use App\Filament\Admin\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use BackedEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $recordTitleAttribute = 'name';

    // Form method sesuai Filament 3.x
    public static function form(Schema $schema): Schema
    {


        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('description')
                    ->maxLength(1000)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->numeric()
                    ->required(),
                TextInput::make('stock')
                    ->numeric()
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->required(),
              FileUpload::make('image')
    ->image()
    ->directory('products')
    ->disk('public')
    ->imagePreviewHeight('150')
    ->maxSize(1024)
    ->required(),

            ]);
    }

    // Table method harus menggunakan Filament\Tables\Table
    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
    public static function infolist(Schema $schema): Schema
    {
        return Schemas\ProductInfolist::configure($schema);
    }
}
