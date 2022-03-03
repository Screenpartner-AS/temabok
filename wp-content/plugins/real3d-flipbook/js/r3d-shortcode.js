(function($) {
    $(document).ready(function() {

      var $bookList = $("#r3d-books")
    	var $pagination = $("#r3d-pagination")
      var itemsPerPage = 24
      var numPages = 1
      var numItems = 0
      var items = null
      var currPage = 1

      var searchParams = new URLSearchParams(document.location.search.substring(1));
      var cat = searchParams.get('cat') || ''
      var search = searchParams.get('search') || ''

      var $prev = $('<li class="page-item"><span class="page-link">Previous</span></li>')
      var $next = $('<li class="page-item"><span class="page-link">Next</span></li>')
      var $pagination = $('.pagination')

      $('.r3d_shortcode').show()

      $('#r3d-cat').change(function(){
        
      	cat = this.value
        getBooks()

      })

      var $searchBtn = $('.header-search-block').find('button')
      var $searchInput = $('.header-search-block').find('input')

      $searchBtn.click(function(){
            search = $searchInput.val()
            getBooks()
      })

      $searchInput.on('keyup', function (e) {
          if (e.key === 'Enter' || e.keyCode === 13) {
              search = $searchInput.val()
                  getBooks()
          }
      });


      $('.category-nav').find('a').click(function(e){
            e.preventDefault()
            if(!$(this).hasClass('category-trigger')){
                  cat = this.innerHTML;
                  getBooks()
                  $('.category-nav').toggleClass('show');
            }
      })

      function getBooks(onComplete){

        // if(cat || search){
          var searchParams = new URLSearchParams()
          if(cat)
            searchParams.set('cat', cat)
          if(search)
            searchParams.set('search', search)
          // window.location.search = searchParams.toString()
          // history.pushState({ 'cat': cat, 'search': search }, '', window.location.href)
        // }

        if (history.pushState) {
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
            if(newurl != window.location.href)
              window.history.pushState({path:newurl},'',newurl);
        }

        $pagination.empty()

        $bookList.empty().append($('<p style="width:100%; height: 200px; line-height: 200px; text-align: center;">Chargement...</p>'))

      	$.ajax({
    		    type: 'POST',
    		    url: r3d.ajaxurl,
    		    dataType: "json", // add data type
    		    data: { 
    		    	action : 'r3d_get_posts' ,
    		    	cat : cat,
    		    	s : search,
                    paged: currPage,
                    posts_per_page: 24
    		    },
    		    success: function( response ) {
                numPages = response.numPages
                showBooks(response.books)
    		    }
    		});

      }

      getBooks()

      function showBooks(books){
        items = books
        showPage()
      }

      function showPage(){

        $bookList.empty()
        $('.current-page').val(currPage)
        $('.displaying-num').text(numItems + ' items')
        $('.total-pages').text(numPages)

        buildNavigation()

        for (var i = 0; i < items.length; i++) {
          var item = items[i]
            var $item = $(
            '<a href="'+item.link+'" class="r3d-book">'+
              '<div class="r3d-thumb-wrapper">'+item.thumb+'</div>'+
              '<div class="r3d-title">'+item.title+'</div>'+
            '</a>'
          ).appendTo($bookList)

          if (item.author)
            $item.append('<div class="r3d-author">Par '+item.author+'</div>')

        }
      }

      function buildNavigation(){

        if(currPage == 1) $prev.addClass('disabled'); else $prev.removeClass('disabled');
        if(currPage == numPages) $next.addClass('disabled'); else $next.removeClass('disabled');

       $pagination.append($prev)

       for(var i = 1; i <= numPages; i++){
        $item = $('<li class="page-item" data-page="'+i+'"><a class="page-link" href="#">'+i+'</a></li>').appendTo($pagination)
        if(i == currPage) $item.addClass('active')

          $item.click(function(e){
            e.preventDefault()
              currPage = Number(this.dataset.page)
              getBooks()
          })
       }

       $pagination.append($next)

       $next.click(function(e){
        e.preventDefault()
        if(currPage < numPages) {
          currPage++;
          getBooks()
        }
      })

      $prev.click(function(e){
        e.preventDefault()
        if(currPage > 1) {
          currPage--;
          getBooks()
        }
      })



        //        '<li class="page-item"><a class="page-link" href="#">1</a></li>'+
        // '<li class="page-item active" aria-current="page"><span class="page-link">2<span class="sr-only">(current)</span></span></li>'+
        // '<li class="page-item"><a class="page-link" href="#">3</a></li>'+

      }



      // $btnFirst.click(function(){
      //   if(currPage != 1) {
      //     currPage = 1
      //     getBooks()
      //   }
      // })

      // $btnLast.click(function(){
      //   if(currPage != numPages) {
      //     currPage = numPages
      //     getBooks()
      //   }
      // })

      // $('.current-page').change(function(){
      //   if(!isNaN(this.value) && this.value >= 1 && this.value <= numPages){ 
      //     currPage = this.value
      //     getBooks()
      //   }
      // })



      /*------------------------
          --> Search PopUp
        ------------------------*/
        $(".search-trigger").on('click', function() {
            $(".search-wrapper").addClass('open');
        })
        $(".search-dismiss,body").on('click', function(e) {
            $(".search-wrapper").removeClass('open')
        })
        // $("body").on('click', function () { 
        //  $(".search-wrapper").removeClass('open')
        // })
        $(".search-box,.search-trigger").on('click', function(e) {
            e.stopPropagation();
        })

        $('.category-trigger').on('click', function(e) {
            $('.category-nav').toggleClass('show');
            e.stopPropagation();
        })




    });
}(jQuery));