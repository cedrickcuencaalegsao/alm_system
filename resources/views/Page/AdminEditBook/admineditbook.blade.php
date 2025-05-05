@extends('shared.layout.admin')

@section('title', 'Manage Books')

@section('page-title', 'Book Management')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('view.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('view.manage.books') }}">Manage Books</a></li>
    <li class="breadcrumb-item active">Edit Book</li>
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white p-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-pencil-square fs-4 me-2"></i>
                            <h2 class="h5 mb-0 flex-grow-1">Edit Book Details</h2>
                            <span class="badge bg-light text-primary">ID: {{ $book->getBookID() }}</span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('save.edit.book') }}" method="POST" id="bookEditForm"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="bookID" value="{{ $book->getBookID() }}">
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="isbn" id="isbn"
                                            class="form-control @error('isbn') is-invalid @enderror"
                                            value="{{ old('isbn', $book->getBookID()) }}" placeholder="Enter Book ID"
                                            disabled>
                                        <label for="isbn"><i class="bi bi-upc-scan me-1"></i>Book ID</label>
                                        @error('isbn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Unique identifier for this book</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="bookname" id="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $book->getBookName()) }}" placeholder="Enter book title"
                                            autofocus>
                                        <label for="title"><i class="bi bi-book me-1"></i>Title</label>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="author" id="author"
                                            class="form-control @error('author') is-invalid @enderror"
                                            value="{{ old('author', $book->getAuthor()) }}" placeholder="Enter author name">
                                        <label for="author"><i class="bi bi-person me-1"></i>Author</label>
                                        @error('author')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="bookprice" id="price"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $book->getPrice()) }}" placeholder="Enter price">
                                        <label for="price"><i class="bi bi-tag me-1"></i>Price</label>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="datepublish" id="datepublish"
                                            class="form-control @error('datepublish') is-invalid @enderror"
                                            value="{{ old('datepublish', $book->getDatePublish()) }}" placeholder="Enter datepublish">
                                        <label for="datepublish"><i class="bi bi-calendar me-1"></i>datepublish</label>
                                        @error('datepublish')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mb-2"><i class="bi bi-boxes me-1"></i>Stocks</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-primary" onclick="adjustQuantity(-1)"
                                            aria-label="Decrease quantity">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                        <input type="number" name="stocks" id="quantityInput"
                                            class="form-control text-center @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity', $book->getStock()) }}" min="0"
                                            aria-label="Book quantity">
                                        <button type="button" class="btn btn-outline-primary" onclick="adjustQuantity(1)"
                                            aria-label="Increase quantity">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                    @error('quantity')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Current inventory count</div>
                                </div>

                                <div class="mb-4">
                                    <label for="cover_image" class="form-label mb-2"><i class="bi bi-image me-1"></i>Book
                                        Cover</label>

                                    @if ($book->getImage())
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $book->getImage()) }}" alt="Current Cover"
                                                class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                        <input type="hidden" name="image" value="{{$book->getImage()}}">
                                    @endif


                                    <input class="form-control @error('cover_image') is-invalid @enderror" type="file"
                                        id="cover_image" name="image" accept="image/*">
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Upload a new image to replace the current cover (JPG, PNG, max
                                        2MB)</div>
                                </div>

                            </div>

                            <div class="mb-4">
                                <label class="form-label mb-2"><i class="bi bi-card-text me-1"></i>Description</label>
                                <textarea name="bookdetails" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="5" placeholder="Enter book description">{{ old('description', $book->getBookDetails()) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label mb-2"><i class="bi bi-tag me-1"></i>Category</label>

                                <div class="category-tags p-3 border rounded bg-light">
                                    <!-- Common book categories -->
                                    @php
                                        // Hardcoded categories - replace or extend as needed for your library
                                        $allCategories = [
                                            'Fiction' => 'Fiction',
                                            'Non-Fiction' => 'Non-Fiction',
                                            'Mystery' => 'Mystery',
                                            'Thriller' => 'Thriller',
                                            'Romance' => 'Romance',
                                            'Science Fiction' => 'Science Fiction',
                                            'Fantasy' => 'Fantasy',
                                            'Horror' => 'Horror',
                                            'Biography' => 'Biography',
                                            'History' => 'History',
                                            'Self-Help' => 'Self-Help',
                                            'Business' => 'Business',
                                            'Science' => 'Science',
                                            'Technology' => 'Technology',
                                            'Travel' => 'Travel',
                                            'Cooking' => 'Cooking',
                                            'Art' => 'Art',
                                            'Poetry' => 'Poetry',
                                            'Children' => 'Children',
                                            'Young Adult' => 'Young Adult',
                                            'Comics & Graphic Novels' => 'Comics & Graphic Novels',
                                            'Reference' => 'Reference',
                                            'Textbook' => 'Textbook',
                                            'Academic' => 'Academic',
                                        ];

                                        // Make sure we get the book's category
$bookCategory = $book->getCategory();

// Get currently selected category from old input or the book's category
                                        // Make sure we have a value, even if both are null
                                        $selectedCategory = old('category') ?? ($bookCategory ?? '');
                                    @endphp

                                    <div class="row g-2">
                                        @foreach ($allCategories as $value => $name)
                                            <div class="col-auto">
                                                <div class="form-check form-check-inline category-tag">
                                                    <input type="radio" class="form-check-input category-radio"
                                                        id="category-{{ $value }}" name="category"
                                                        value="{{ $value }}"
                                                        {{ $selectedCategory == $value ? 'checked' : '' }}>
                                                    <label
                                                        class="form-check-label category-label px-2 py-1 rounded-pill {{ $selectedCategory == $value ? 'bg-primary text-white' : '' }}"
                                                        for="category-{{ $value }}">
                                                        {{ $name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-text mt-2">Select the primary category for this book</div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteBookModal">
                                    <i class="bi bi-trash me-1"></i>Delete Book
                                </button>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('view.manage.books') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-save2 me-1"></i>Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteBookModalLabel"><i
                            class="bi bi-exclamation-triangle me-2"></i>Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete "<strong>{{ $book->getBookName() }}</strong>"?</p>
                    <p class="text-danger mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('delete.book')}}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="bookID" value="{{$book->getBookID()}}">
                        <button type="submit" class="btn btn-danger">Delete Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Optional: Add filtering capability for many categories
        document.addEventListener('DOMContentLoaded', function() {
            const categoryContainer = document.querySelector('.category-tags');

            // Add a search box before the categories if there are many
            if (Object.keys({!! json_encode($allCategories) !!}).length > 10) {
                const searchBox = document.createElement('div');
                searchBox.className = 'mb-2';
                searchBox.innerHTML = `
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control" id="categorySearch" placeholder="Filter categories...">
            </div>
        `;
                categoryContainer.prepend(searchBox);

                // Add filter functionality
                document.getElementById('categorySearch').addEventListener('input', function(e) {
                    const filter = e.target.value.toLowerCase();
                    document.querySelectorAll('.category-tag').forEach(tag => {
                        const text = tag.textContent.toLowerCase();
                        tag.closest('.col-auto').style.display = text.includes(filter) ? '' :
                            'none';
                    });
                });
            }

            // Add JavaScript to ensure the saved category is selected (as a backup)
            const bookCategory = "{{ $bookCategory ?? '' }}";
            if (bookCategory) {
                const categoryRadio = document.getElementById('category-' + bookCategory);
                if (categoryRadio) {
                    categoryRadio.checked = true;
                    // Also highlight the label
                    categoryRadio.closest('.category-tag').querySelector('.category-label').classList.add(
                        'bg-primary', 'text-white');
                }
            }
        });
    </script>
@endsection
