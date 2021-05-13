<div class='block-breadcrumbs d-xl-block d-lg-block d-md-block d-sm-none d-none'>
    <div class='container'>

        @if(isset($object))
        {{ Breadcrumbs::render($name, $object) }}
        @else
        {{ Breadcrumbs::render($name) }}
        @endif

    </div>
</div>