(function($){
    wp.customize('header_background', function (value) { 
        value.bind(function (newVal) {
            console.log(`En-tete a change: `, newVal);
            $('.bg-header').attr('style', 'background-color:'+newVal+'!important');
        })
    })
})(jQuery)