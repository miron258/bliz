@foreach($items as $item)
    <!--Добавляем класс active для активного пункта меню-->
    @php
        $classItem = (!empty($classMenu))? "item-".$classMenu: 'item';
        $isActive = ($item->isActive)? ' active ':'';
        $active = ($item->active)? ' active ':'';
    @endphp


    <li class="{{$classItem}}{{ $isActive }}{{ $active }} @if($item->hasChildren()) dropdown @endif">
        <!-- метод url() получает ссылку на пункт меню (указана вторым параметром
        при создании объекта LavMenu)-->

    @php $classLink = (!empty($classMenu))? "link-item-".$classMenu: 'link-item';  @endphp
    @php $classLink2 = (!empty($item->class))? "link-class-".$item->class():''; @endphp

    <!---Если есть потомки показываем span если нет просто ссылку  --->
        @if($item->hasChildren())
            <span class="{{$classLink}} dropdown-toggle" data-toggle="dropdown">{{ $item->title }}</span>
        @else
            <a class="{{$classLink}}" href="{{ $item->url() }}">{{ $item->title }}</a>
        @endif


    <!--Формируем дочерние пункты меню
        метод haschildren() проверяет наличие дочерних пунктов меню-->


        @if($item->hasChildren())



        <!--метод children() возвращает дочерние пункты меню для текущего пункта-->

            @if ($megaMenu)
                <ul class="sub-menu dropdown-menu mega-menu">
                    <li class="mega-menu-column">
                        <ul class="list-items-column-menu">
                            @include('custom-menu.custom-menu-items', ['items'=>$item->children()])
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="sub-menu">
                    @include('custom-menu.custom-menu-items', ['items'=>$item->children()])
                </ul>
            @endif

        @endif
    </li>
@endforeach
