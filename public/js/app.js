$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();

        var query = $('input[name="query"]').val();
        
        $.ajax({
            url: '/ajax-search',
            type: 'GET',
            data: { query: query },
            success: function(data) {
                var resultsDiv = $('#search-results');
                resultsDiv.empty(); // Clear previous results

                if (data.length === 0) {
                    resultsDiv.html('<div class="row my-5"><p>No posts with term <strong>"' + query + '"</strong> found.</p></div>');
                } else {
                    var rowDiv = $('<div class="row my-5"><h2>Search results</h2></div>');
                    data.forEach(function(post) {
                        var colDiv = $('<div class="col-md-4 col-sm-6 mb-4"></div>');
                        var cardDiv = $('<div class="card h-100"></div>');
                        var cardBodyDiv = $('<div class="card-body d-flex flex-column"></div>');
                        
                        cardBodyDiv.append('<h5 class="card-title">' + post.title + '</h5>');
                        cardBodyDiv.append('<p class="card-text flex-grow-1">' + post.body.substring(0, 100) + '</p>');
                        
                        var buttonDiv = $('<div class="mt-auto"></div>');
                        buttonDiv.append('<a href="/posts/' + post.id + '" class="btn btn-info btn-sm">View</a>');
                        
                        cardBodyDiv.append(buttonDiv);
                        cardDiv.append(cardBodyDiv);
                        colDiv.append(cardDiv);
                        rowDiv.append(colDiv);
                    });

                    resultsDiv.append(rowDiv);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
});
