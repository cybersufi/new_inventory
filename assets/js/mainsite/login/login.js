Ext.onReady(function() {
	Ext.QuickTips.init();
	
	//var loginform = new App.LoginForm();
	var loginform = Ext.create('App.LoginForm');
	loginform.show();
	
	setTimeout(function() {
		Ext.get('loading').remove();
		Ext.get('loading-mask').fadeOut({remove:true});
	}, 250);
});