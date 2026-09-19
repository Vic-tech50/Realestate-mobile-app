<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\Layouts\Builders\NavAction;
use Native\Mobile\Edge\Layouts\Builders\NavBarOptions;
use Native\Mobile\Edge\NativeComponent;

class service extends NativeComponent
{
    public function navigationOptions(): ?NavBarOptions
    {
        return NavBarOptions::make()
            ->action(
                NavAction::make('share')
                    ->icon('share')
                    ->a11yLabel('Share')
                    ->press('share')
            )
            ->action(
                NavAction::make('more')
                    ->icon('ellipsis')
                    ->a11yLabel('More options')
                    ->items([
                        NavAction::make('mute')
                            ->label('Mute')
                            ->icon(ios: 'bell.slash', android: 'notifications_off')
                            ->press('mute'),
                        NavAction::make('pin')->label('Pin')->icon('pin')->press('pin'),
                        NavAction::divider(),
                        NavAction::make('delete')
                            ->label('Delete')
                            ->icon('trash')
                            ->press('delete')
                            ->destructive(),
                    ])
            );
    }

    public function render(): View
    {
        return view('native.service');
    }
}
