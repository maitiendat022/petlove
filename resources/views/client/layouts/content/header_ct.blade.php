<div class="col-lg-12">
    <!-- breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            @if(!$pet_id)
                <li aria-current="page" class="breadcrumb-item active">Sản phẩm</li>
            @else
            @foreach ($pet as $pet)
                @if($pet->id == $pet_id)
                    <li aria-current="page" class="breadcrumb-item active">{{ $pet->name }}</li>
                @endif
                    @foreach ($pet->categories->whereNull('parent_id')->where('status','active') as $parent)
                        @if($parent_id && $parent->id == $parent_id)
                            <li aria-current="page" class="breadcrumb-item active">{{ $parent->name }}</li>
                        @endif
                            @foreach ($parent->children->where('status','active') as $category)
                                @if($category_id && $category->id == $category_id)
                                <li aria-current="page" class="breadcrumb-item active">{{ $category->name }}</li>
                                @endif
                            @endforeach
                    @endforeach
            @endforeach
            @endif

        </ol>
    </nav>
</div>
