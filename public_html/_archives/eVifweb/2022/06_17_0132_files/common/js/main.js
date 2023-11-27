/* 
// J5
// Code is Poetry */

//
// INITIALIZE
document.observe("dom:loaded", function() {

	//
	// TRANSACTION STATUS MESSAGE CONTROLLER
	if($('user_transaction_status_msg').innerHTML!=''){
		usr_transTimer = setTimeout(toggleTransactionWrapperOpen, 1200);
	}
});

function toggleTransactionWrapperOpen(){
	new Effect.Appear('user_transaction_wrapper', { duration: 0.1, from: 0.0, to: 1.0 });
	new Effect.toggle('user_transaction_wrapper', 'slide');
	usr_transTimer = setTimeout(toggleTransactionWrapperClose, 15000);
}

function toggleTransactionWrapperClose(){
	new Effect.Appear('user_transaction_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
																 new Effect.toggle('user_transaction_wrapper', 'blind');
															   }  });
}
