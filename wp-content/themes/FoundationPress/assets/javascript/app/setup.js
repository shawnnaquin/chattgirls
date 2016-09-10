(function ($, window, document, undefined) {

	// $.cssEase.bounce = 'cubic-bezier(0,1,0.5,1.3)';

	/* blockui
	// ------------------------------------------------------------------------------------------------------------------*/
	// $.extend($.blockUI.defaults, {
	// 	message: 'Loading...',
	// 	css: {},
	// 	themedCSS: {},
	// 	growlCSS: {},
	// 	baseZ:2000,

	// });

	// /* validator
	// ------------------------------------------------------------------------------------------------------------------*/
	// $.validator.setDefaults({
	// 	errorElement: 'small',
	// 	errorClass: 'nope',
	// 	submitHandler: function(form){
	// 		$(form).ajaxSubmit({
	// 			dataType: 'json',
	// 			beforeSubmit:function(){
	// 				$.blockUI({
	// 					message: 'Sending message...',
	// 					blockMsgClass: 'loading'
	// 				});
	// 				return true;
	// 			},
	// 			success:function(response){
	// 				$.blockUI({
	// 					message: response.message,
	// 					timeout: 3000,
	// 					blockMsgClass: response.type,
	// 					onUnblock: function(){
	// 						if(response.type === 'success'){
	// 							window.location.reload();
	// 						}
	// 					}
	// 				});
	// 			}
	// 		});
	// 	}
	// });

}(jQuery, this, this.document));