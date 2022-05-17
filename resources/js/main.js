window.$ = require('jquery');

$(document).ready(function(){
    $("#loadMore").click(function(e){
        e.preventDefault();
        console.log('working');
    });
});
