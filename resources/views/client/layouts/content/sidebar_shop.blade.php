<div class="col-lg-3">

    <div class="card sidebar-menu mb-4">
        <div class="card-header">
            <h3 class="h4 card-title">Danh mục</h3>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills flex-column category-menu">
                @foreach ($pet as $pet)
                <li><a
                        href="{{ route('home.product', ['pet_id' => $pet->id]) }}"
                        class="nav-link {{ ($pet->id==$pet_id) ? 'active' : '' }}"
                    >
                        {{ $pet->name }}
                        <span class="badge badge-secondary">0</span>
                    </a>
                    <ul class="list-unstyled">
                        @foreach ($pet->categories->whereNull('parent_id')->where('status','active') as $parent)
                        <li class="parent-menu">
                            <a
                                href="{{ route('home.product', ['pet_id' => $pet->id,'parent_id' => $parent->id]) }}"
                                class="nav-link dropdown-toggle"
                                style="{{ ($parent->id==$parent_id) ? 'color:#4fbfa8;' : '' }}"
                            >
                                {{ $parent->name }}
                            </a>
                            <ul class="category_children">
                                @foreach ($parent->children->where('status','active') as $category)
                                    <li>
                                        <a
                                            href="{{ route('home.product', ['pet_id' => $pet->id, 'parent_id' => $parent->id, 'category_id' => $category->id]) }}"
                                            class="nav-link">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>

