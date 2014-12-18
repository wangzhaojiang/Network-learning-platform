//表单字段验证
var FormUtil = {
    checkCommon: function(str) {
       var pattern = /^[^\s.]+$/;
        return pattern.test(str);        
    },
    checkUserName: function(str) {
       var pattern = /^[^\s.]+$/;
        return pattern.test(str);        
    },
    checkEmail: function(str) {
        var pattern = /^.*@.*\..*$/;
        return pattern.test(str);
    }, 
    checkPhone: function(str) {
    	var pattern = /^\d{11}$/;
    	return pattern.test(str); 
    },
    checkPwd: function(str) {
        var pattern = /^[^\s.]+$/;
        return pattern.test(str);
    }
};

$(document).ready(function() {
        // 设置page-wrapper高度
	function resizePageWrapper() {
    	var pageHeight = $(window).height() - $('footer').height() - $('header').height() - 10;
    	$('.page-wrapper').css('min-height', pageHeight);
	}

    $('.navigation .menu-course').mouseenter(function(){
        var status= $('.navigation .course-drop-down-modal').css('display');
        $('.navigation .course-drop-down-modal').css('display', 'block');
    });
    $('.navigation .course-drop-down-modal').mouseleave(function() {
        $('.navigation .course-drop-down-modal').css('display', 'none');    	
    });
    
    $('.navigation-right .link-profile').click(function() {
        var status= $('.navigation-right .drop-down-list').css('display');
        if (status == 'block') {
            $('.navigation-right .drop-down-list').css('display', 'none');
        } else {
            $('.navigation-right .drop-down-list').css('display', 'block');
        }
    });
    
//	$('a.btn').click(function(){
//		return false;
//	});
	
	resizePageWrapper();
	$(window).on('resize', function(){
		resizePageWrapper();	
	});
});