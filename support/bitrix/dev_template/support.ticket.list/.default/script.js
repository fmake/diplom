$(function(){
    $('.bx-interface-grid').after('<div class="custom-table-footer"><div class="table-pagination"></div> <div class="total"></div></div>');
    var globalFooter = $('.bx-grid-footer');
    var footer = globalFooter.find('.bx-grid-footer');
    var total = footer.find('td').first();
    var pagination = footer.find('.modern-page-navigation');
    var newTotal = $('.custom-table-footer .total');
    var newPagination = $('.custom-table-footer .table-pagination');
    var mobile = window.matchMedia("(max-width: 40em)");
    newTotal.append(total.html());
    newPagination.append(pagination.html());
    pagination.remove();
    total.remove();
    globalFooter.remove();

    var search = $('.bx-interface-filter');
    search.find('.bx-filter-sep').remove();
    search.find('.bx-filter-hide').remove();
    search.find('.bx-filter-show').remove();
    search.find('.bx-filter-off').remove();
    search.find('.bx-filter-menu').after(search.find('.bx-filter-text'));
    search.find('.bx-filter-minus').remove();
    search.find('.bx-filter-min').remove();
    search.appendTo('.b-filter-button-block-right__search');
    search.wrap('<form name="filter_ticket_grid" action="" method="GET"></form>');
    var i=0;
    $('.bx-filter-buttons').find('input').each(function(){
        if(i == 0){
            $(this).addClass('button');
            $(this).addClass('right');
            $(this).css({
                marginBottom: "5px",
                marginRight: "5px"
            });
        } else if(i == 1) {
            $(this).remove();
        }
        i++
    });
    search.show();
    var rightSearch = $('.b-filter-button-block-right__search');
    var height = rightSearch.height();
    rightSearch.height('0');
    $('.b-filter-button-block-right__toggle').click(function(){
        rightSearch.stop(true);
        if ($(this).hasClass('opened')){
            height = rightSearch.height();
            rightSearch.animate({height: 0},500);
            $(this).removeClass('opened');
        } else {
            rightSearch.animate({height: height}, 500,function(){
                $(this).height('auto');
            });
            $(this).addClass('opened');
        }
    });

    $('.bx-interface-grid > tbody > tr').each(function(){
        var i = 1;
        $(this).find('> td').each(function(){
            if (i == 1) $(this).remove();
            if (i == 4) $(this).addClass('link-table').attr('onclick',$(this).parent().attr('ondblclick'));
            if (mobile.matches){
                if(i == 3 || i > 4) $(this).hide();
            }
            i++;
        });
    });
});

