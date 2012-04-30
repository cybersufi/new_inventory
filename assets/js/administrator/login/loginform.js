Ext.define('App.SiteAdmin.LoginForm',  {
	extend: 'Ext.Window',
	requires: 'Ext.form.*',
	
	alias: 'widget.siteadmin-login-window',
	title: 'Administrator Login Dialog',
	width: 370,
	height: 135,
	iconCls: 'key-icon',
	resizable: false,
	closable: false,
	bodyStyle: 'padding 5px',
	border: false,
	plain: true,
	layout: 'border',
	id: 'app-login-dialog',
	
	initComponent: function() {
		this.items = [{
			id:'btns',
			region:'south',
			baseCls:'x-plain',
			split: false,
			height: 40,
			layout: {
				type: 'hbox',
				padding: '10',
				align:'top',
			},
			items:[{
				xtype:'button',
				text: 'Site Home Page',
				tabIndex: 5,
				handler: this.onSiteButtonClick,
				scope: this,
			}, {
				xtype:'tbspacer',
				flex:0.1
			}, {
				xtype:'tbspacer',
				flex:1
			}, {
				xtype:'button',
				id:'login-button',
				text: 'Login',
				tabIndex: 3,
				handler: this.onLoginButtonClick,
				scope: this,
			}]
		}, {
			xtype: 'form',
			region: 'center',
			labelWidth: 60,
			waitTitle: 'Loging in.. Please wait...',
			baseCls: 'x-plain',
			border: false,
			padding: 10,
			id: 'login-form',
			items: [{
				xtype: 'textfield',
				fieldLabel: 'Username',
				anchor: '100%',
				name: 'username',
				allowBlank: false,
				selectOnFocus: true,
				tabIndex: 1,
			}, {
				xtype: 'textfield',
				fieldLabel: 'Password',
				anchor: '100%',
				name: 'password',
				inputType: 'password',
				allowBlank: false,
				selectOnFocus: true,
				tabIndex: 2,
			}]
		}];
    		
		this.callParent(arguments);
		this.form = this.getComponent('login-form').getForm();
	},
	
	onLoginButtonClick: function() {
		if (this.form.isValid()) {
	     	this.form.submit({
	     		url: site_url+'/login/dologin',
				waitMsg: 'Logging in .. ',
				success: this.onSuccessSubmit,
				failure: this.onFailedSubmit,
				scope: this
			});
		}
	},
	
	onSiteButtonClick: function() {
		if (self == top) {
			window.location = home_url;
		} else {
			parent.location = home_url;
		}	
	},
	
	onSuccessSubmit: function(form, action) {
		var result = action.result;
    		if (result.success == "true") {
        		window.location=site_url;
	    	} else {
	      	Ext.MessageBox.show({
	        		title: 'Error - ' + sitename,
	       	 	msg: result.msg,
	        		icon: Ext.MessageBox.ERROR,
	        		buttons: Ext.MessageBox.OK,
	        		animateTarget: 'login-button'
	      	});
    	}
		this.resetForm();
	},
	
	onFailedSubmit: function(form, action) {
		if (action.failureType === Ext.form.Action.CONNECT_FAILURE) {
			Ext.MessageBox.show({
				title: 'Error - ' + sitename,
				msg: 'Status:'+action.response.status+': '+ action.response.statusText,
   				icon: Ext.MessageBox.ERROR,
        			buttons: Ext.MessageBox.OK,
        			animateTarget: 'login-button'
			});
		}
		if (action.failureType === Ext.form.Action.SERVER_INVALID){
      		Ext.MessageBox.show({
        			title: 'Invalid - ' + sitename,
   				msg: 'Detail: '+action.result.errormsg,
	        		icon: Ext.MessageBox.ERROR,
	        		buttons: Ext.MessageBox.OK,
	        		animateTarget: 'login-button'
	      	});
		}
		this.resetForm();
	},
	
	resetForm: function() {
		this.form.reset();	
	},
	
});