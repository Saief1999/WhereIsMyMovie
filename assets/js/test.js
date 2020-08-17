import "styles/test.css" ;
import $ from "jquery"  ;
import Isotope from "isotope-layout" ;
import jQueryBridget from "jquery-bridget"
jQueryBridget( 'isotope', Isotope, $ );
import "bootstrap" ;


// init Isotope
let $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    getSortData: {
        name: '.name',
        symbol: '.symbol',
        number: '.number parseInt',
        category: '[data-category]',
        weight: function( itemElem ) {
            let weight = $( itemElem ).find('.weight').text();
            return parseFloat( weight.replace( /[\(\)]/g, '') );
        }
    }
});

// filter functions
let filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function() {
        let number = $(this).find('.number').text();
        return parseInt( number, 10 ) > 50;
    },
    // show if name ends with -ium
    ium: function() {
        let name = $(this).find('.name').text();
        return name.match( /ium$/ );
    }
};

// bind filter button click
$('#filters').on( 'click', 'button', function() {
    let filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[ filterValue ] || filterValue;
    $grid.isotope({ filter: filterValue });
});

// bind sort button click
$('#sorts').on( 'click', 'button', function() {
    let sortByValue = $(this).attr('data-sort-by');
    $grid.isotope({ sortBy: sortByValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
    let $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
    });
});

