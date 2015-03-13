jQuery(document).ready(function($){
	
	ls.comments.setbest = function(idComment,  targetId) {
		var params = {
            targetId: targetId,
            commentId: idComment
        };
        ls.ajax(aRouter.ajax + 'setbestcomment/', params, function (result) {
            if (!result) {
                ls.msg.error('Error', 'Please try again later');
                return;
            }
            if (result.bStateError) {
                ls.msg.error(null, result.sMsg);
            } else {
				ls.msg.notice(null, result.sMsg);
            }
        }.bind(this));
    };

});