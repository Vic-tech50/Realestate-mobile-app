<?php

namespace App\NativeComponents\Layouts;

use Native\Mobile\Edge\Layouts\Builders\NavBar;
use Native\Mobile\Edge\Layouts\Builders\Tab;
use Native\Mobile\Edge\Layouts\Builders\TabBar;
use Native\Mobile\Edge\Layouts\NativeLayout;
use Native\Mobile\Edge\NativeComponent;

class AppLayout extends NativeLayout
{
    public function usesNativeChrome(): bool
    {
        return true;
    }

    public function navBar(NativeComponent $screen): ?NavBar
    {
        $title = match (true) {
            str_contains($screen::class, 'agentdashboard') => 'Agent Dashboard',
            str_contains($screen::class, 'addproperty') => 'Add Property',
            str_contains($screen::class, 'agentprofile') => 'Agent Profile',
            str_contains($screen::class, 'editprofile') => 'Edit Profile',
            default => 'Agent',
        };

        return NavBar::make()
            ->title($title)
            ->back(false)
            ->displayMode('inline')
            ->elevation(4);
    }

    public function tabBar(NativeComponent $screen): ?TabBar
    {

        $active = match (true) {
            str_contains($screen::class, 'agentdashboard') => '/agentdashboard',
            str_contains($screen::class, 'addproperty') => '/addproperty',
            str_contains($screen::class, 'agentprofile') => '/agentprofile',
            str_contains($screen::class, 'editprofile') => '/editprofile',
            default => 'Agent',
        };
        // $active = str_contains($screen::class, 'addproperty')
        //     ? '/addproperty'
        //     : '/agentdashboard';

        return TabBar::make()
            ->dark(true)
            ->labelVisibility('labeled')
            ->activeColor('#111827')
            ->add(Tab::link('Home', '/agentdashboard', icon: 'dashboard'))
            ->add(Tab::link('Property', '/addproperty', icon: 'add'))
            ->add(Tab::link('Profile', '/profile', icon: 'user'))
            ->highlight($active);
    }
}
