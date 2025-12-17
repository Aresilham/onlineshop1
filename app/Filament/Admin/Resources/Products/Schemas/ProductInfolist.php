<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               ImageEntry::make('image')
    ->label('Gambar Produk')
    ->url(fn ($record) => Storage::url($record->image))
    ->size(200),
                TextEntry::make('name')
                    ->label('Nama Produk'),
                TextEntry::make('description')
                    ->label('Deskripsi Produk'),
                TextEntry::make('price')
                    ->label('Harga Produk')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextEntry::make('stock')
                    ->label('Stok Produk'),
                TextEntry::make('weight')
                    ->label('Berat Produk (gram)'),
                TextEntry::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->dateTime(),
            ]);
    }
}
