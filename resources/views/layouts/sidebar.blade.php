<?php  
    $active_menu = null;
    $active_submenu = null;

?>
<div class="leftside-menu">
    <a href="{{ route('dashboard') }}" class="logo logo-light text-center">
        <span class="logo-lg">
            <img src="{{ asset('images/rs_logo.png') }}" style="width: 250px;" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('images/rs_logo.png') }}" style="width: 70px;" alt="small logo">
        </span>
    </a>
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <ul class="side-nav">            
            <li class="side-nav-title side-nav-item">Navigation</li>
            @foreach ($menus as $menu)
                <?php $id = str_replace('.','_',$menu->web); ?>
                <li class="side-nav-item {{ $active_menu == $id ? 'menuitem-active' : '' }}">
                    @if (count($menu->childs) > 0)
                        <a data-bs-toggle="collapse" href="#{{ $id }}" aria-expanded="false" 
                            aria-controls="{{ $id }}" 
                            class="side-nav-link {{ $active_menu == $id ? 'active' : '' }}"
                        >
                            <i class="{{ $menu->web_icon }}"></i>
                            <span> {{ ConvertToLang($menu) }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                    @else
                        <a href="{{ route($menu->web) }}" 
                            class="side-nav-link {{ $active_menu == $id ? 'active' : '' }}"
                        >
                            <i class="{{ $menu->web_icon }}"></i>
                            <span> {{ ConvertToLang($menu) }} </span>
                        </a>
                    @endif
                    
                    @if (count($menu->childs) > 0)
                        <div class="collapse" id="{{ $id }}">
                            <ul class="side-nav-second-level">
                                @foreach ($menu->childs as $child)
                                    <?php $sid = str_replace('.','_',$child->web); ?>
                                    <li class="{{ $sid == $active_submenu ? 'menuitem-active' : '' }}" style="padding-left: 30px">
                                        <a href="{{ route($child->web) }}">{{ ConvertToLang($child) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach  
        </ul>
        <div class="clearfix"></div>
    </div>
</div>