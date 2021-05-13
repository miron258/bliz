<tr>
    <td>
        {{ PHP_EOL . $prefix . ' ' . $item->name }}
    </td>
    <td>  <a target="_blank" href="{{ route('category_site.index', $item->url) }}">Перейти на страницу категории</a></td>
    <td> 
        @if($item->index)
        <i class="fas fa-search"></i>
        @else
        <i style='opacity: 0.5' class="fas fa-search-minus"></i>
        @endif 
    </td>
    <td>
        @if($item->hidden)
        <i class="far fa-eye"></i> 
        @else
        <i class="far fa-eye-slash"></i>
        @endif    
    </td>
    <td>{{ $item->created_at }}</td>
    <td>
        <a class="btn btn-primary btn-sm" href="{{route('category.edit', $item->id)}}"> <i class="far fa-edit mr-2"></i>Редактировать</a>
    </td>
    <td>
        <form action='{{route('category.destroy', $item->id)}}' method='POST'>
            @csrf
            @method('DELETE')
            <button type='submit' class="btn btn-danger btn-sm"><i class="fas fa-trash mr-2"></i>Удалить</button>
        </form>
    </td>
</tr>