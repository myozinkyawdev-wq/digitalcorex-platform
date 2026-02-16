<?php

use Filament\Tables;
use Filament\Actions;
use Filament\Support\Enums\Width;

/**
 * Get Default Header View Action
 *
 * @return Actions\ViewAction
 */
if (! function_exists('getDefaultHeaderViewAction')) {
    function getDefaultHeaderViewAction(): Actions\ViewAction
    {
        return Actions\ViewAction::make()
            ->label('View')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Table View Action
 *
 * @return Tables\Actions\ViewAction
 */
if (! function_exists('getDefaultTableViewAction')) {
    function getDefaultTableViewAction(): Actions\ViewAction
    {
        return Actions\ViewAction::make()
            ->tooltip('View')
            ->label('')
            ->size('md');
    }
}

/**
 * Get Default Header Create Action
 *
 * @return Actions\CreateAction
 */
if (! function_exists('getDefaultHeaderCreateAction')) {
    function getDefaultHeaderCreateAction(): Actions\CreateAction
    {
        return Actions\CreateAction::make()
            ->label('Create')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Table Header Create Action
 *
 * @return Tables\Actions\CreateAction
 */
if (! function_exists('getDefaultTableHeaderCreateAction')) {
    function getDefaultTableHeaderCreateAction(): Actions\CreateAction
    {
        return Actions\CreateAction::make()
            ->label('Create')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Header Edit Action
 *
 * @return Actions\EditAction
 */
if (! function_exists('getDefaultHeaderEditAction')) {
    function getDefaultHeaderEditAction(): Actions\EditAction
    {
        return Actions\EditAction::make()
            ->label('Edit')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Table Edit Action
 *
 * @return Tables\Actions\EditAction
 */
if (! function_exists('getDefaultTableEditAction')) {
    function getDefaultTableEditAction(): Actions\EditAction
    {
        return Actions\EditAction::make()
            ->modalWidth(Width::MaxContent)
            ->tooltip('Edit')
            ->label('')
            ->size('md');
    }
}

/**
 * Get Default Header Delete Action
 *
 * @return Actions\DeleteAction
 */
if (! function_exists('getDefaultHeaderDeleteAction')) {
    function getDefaultHeaderDeleteAction(): Actions\DeleteAction
    {
        return Actions\DeleteAction::make()
            ->label('Delete')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Table Delete Action
 *
 * @return Tables\Actions\DeleteAction
 */
if (! function_exists('getDefaultTableDeleteAction')) {
    function getDefaultTableDeleteAction(): Actions\DeleteAction
    {
        return Actions\DeleteAction::make()
            ->modalWidth(Width::Medium)
            ->tooltip('Delete')
            ->label('')
            ->size('md');
    }
}

/**
 * Get Default Header Force Delete Action
 *
 * @return Actions\ForceDeleteAction
 */
if (! function_exists('getDefaultHeaderForceDeleteAction')) {
    function getDefaultHeaderForceDeleteAction(): Actions\ForceDeleteAction
    {
        return Actions\ForceDeleteAction::make()
            ->label('Fore Delete')
            ->modalWidth(Width::Medium);
    }
}

/**
 * Get Default Header Restore Action
 *
 * @return Actions\RestoreAction
 */
if (! function_exists('getDefaultHeaderRestoreAction')) {
    function getDefaultHeaderRestoreAction(): Actions\RestoreAction
    {
        return Actions\RestoreAction::make()
            ->label('Resotre')
            ->modalWidth(Width::Medium);
    }
}
