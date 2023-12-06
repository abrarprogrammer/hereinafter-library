$(document).ready(function() {

    var currentPage = 1;
    var page;

    const nextPageButton = $('#next-page');
    const previousPageButton = $('#previous-page');

    nextPageButton.click(function() {
        page = currentPage + 1;
        getBooks(page);
    });

    previousPageButton.click(function() {
        page = currentPage - 1;
        getBooks(page);
    });

    function getBooks(page) {
        $.ajax({
            url: "/get-books?page=" + page,
            method: 'GET',
            success: function(data) {
                currentPage = page;
                populateBooks(data.books);
                updateURL();
                updateButtons(data.last);
            }
        });
    }

    function populateBooks(books) {
        let booksSection = $('#books-section');
        booksSection.html('');
        Object.keys(books).forEach(function(key) {
            const book = books[key];
            booksSection.append(createBookCard(book));
        });
    }

    function updateURL() {
        var currentURL = window.location.href;
        var urlObject = new URL(currentURL);
        urlObject.searchParams.set('page', currentPage);
        window.history.replaceState({}, document.title, urlObject.href);
    }

    function updateButtons(last) {
        if (currentPage == 1) previousPageButton.attr('disabled', 'disabled');
        else previousPageButton.removeAttr('disabled');

        if (last) nextPageButton.attr('disabled', 'disabled');
        else nextPageButton.removeAttr('disabled');
    }

    function createBookCard(book){
        return `
        
        <div class="col mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="fw-bolder">${ book.name }</h5>
                        <p>
                            <span class="fw-bolder">Authors: </span>
                            ${book.authors.map(author => author.name).join(', ')}
                        </p>
                        <p>
                            <span class="fw-bolder">Publisher: </span>
                            ${ book.publisher_name }
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        `;
    }

    // Load books on first page load
    getBooks(1);
    updateButtons();
});