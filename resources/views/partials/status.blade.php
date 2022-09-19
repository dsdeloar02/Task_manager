@php
    $bgClass = 'bg-secondery';
    switch ($task->status) {
        case 'active':
            $bgClass = 'bg-primary';
            break;
        case 'pending':
            $bgClass = 'bg-info';
            break;
        case 'done':
            $bgClass = 'bg-success';
            break;
        default:
            # code...
            break;
    }
@endphp

<span class="absolute {{ $bgClass }} py-1 rounded-pill  px-3 text-white text-capitalize " style="font-size: 10px !important" >
    {{ $task->status }}
</span>
