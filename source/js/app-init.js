$(document).ready(function() {
    $('.navigation .menu .fa-drop-down').click(function(){
        var status= $('.navigation .menu .course-drop-down').css('display');
        if (status == 'block') {
            $('.navigation .menu .course-drop-down').css('display', 'none');
        } else {
            $('.navigation .menu .course-drop-down').css('display', 'block');
        }
    });
/*    $('.navigation .menu .course-drop-down').click(function(){
        $('.menu .drop-down').css('display', 'none');
    });
*/
    $('.navigation-right .link-profile').click(function() {
        var status= $('.navigation-right .drop-down-list').css('display');
        if (status == 'block') {
            $('.navigation-right .drop-down-list').css('display', 'none');
        } else {
            $('.navigation-right .drop-down-list').css('display', 'block');
        }
    });
    
	$('a.btn').click(function(){
		return false;
	});
});