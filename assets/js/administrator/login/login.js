Ext.onReady(function() {
	Ext.QuickTips.init();
	
	var loginform = Ext.create('App.SiteAdmin.LoginForm');
	loginform.show();
	
	setTimeout(function() {
		Ext.get('loading').remove();
		Ext.get('loading-mask').fadeOut({remove:true});
	}, 250);
});