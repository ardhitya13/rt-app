<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengajuanSuratResource extends Resource
{
    protected static ?string $model = PengajuanSurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Pengajuan Surat';
    protected static ?string $pluralModelLabel = 'Pengajuan Surat';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nik')->required()->label('NIK'),
            Forms\Components\TextInput::make('nama')->required()->label('Nama Lengkap'),
            Forms\Components\Select::make('jenis_surat_id')
                ->label('Jenis Surat')
                ->relationship('jenisSurat', 'nama')
                ->required(),
            Forms\Components\Textarea::make('keperluan')->label('Keperluan')->rows(3),
            Forms\Components\Select::make('status')
                ->options([
                    'Diproses' => 'Diproses',
                    'Selesai' => 'Selesai',
                    'Ditolak' => 'Ditolak',
                ])
                ->default('Diproses')
                ->required()
                ->label('Status'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama Warga')->searchable(),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('jenisSurat.nama')->label('Jenis Surat'),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime('d M Y, H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanSurats::route('/'),
            'create' => Pages\CreatePengajuanSurat::route('/create'),
            'edit' => Pages\EditPengajuanSurat::route('/{record}/edit'),
        ];
    }
}
