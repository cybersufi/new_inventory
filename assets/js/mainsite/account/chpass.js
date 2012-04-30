Ext.define('App.Inventory.Account.ChangePasswordPanel', {
	requires: [
        'Ext.form.Panel',
    	],
    	
    	extend: 'Ext.form.Panel',
    	alias: 'widget.account-changepasswd',
	
	/*url: change_url,*/
   	frame:true,
   	title: 'Change User Password',
   	bodyStyle:'padding:5px 5px 0',
   	width: 400,
   	fieldDefaults: {
       	msgTarget: 'side',
       	labelWidth: 100
   	},
   	defaultType: 'textfield',
   	defaults: {
       	anchor: '100%'
   	},

   	items: [{
       	fieldLabel: 'Old Password',
       	name: 'oldpasswd',
       	inputType: 'password',
       	allowBlank:false
   	}, {
       	fieldLabel: 'New Password',
       	name: 'newpasswd',
       	inputType: 'password',
       	allowBlank:false
   	}, {
       	fieldLabel: 'Retype Password',
       	name: 'repasswd',
       	inputType: 'password',
       	allowBlank:false
   	}],

   	buttons: [{
   		id: 'button-save',
       	text: 'Save	',
       	formBind: true,
       	handler: function() {
       		this.up('form').onSaveButtonClick();
       	},
   	}, {
       	id: 'button-cancel',
       	text: 'Cancel',
       	handler: function() {
       		this.up('form').getForm().reset();
       	},
   	}],
    	
    	initComponent: function() {
    		this.callParent(arguments);
    		this.form = this.getForm();
    	},
    	
    	onSaveButtonClick: function() {
    		if (this.form.isValid()) {
	     	this.form.submit({
	     		url: change_url,
				waitMsg: 'Changing user password .. ',
				success: this.onSuccessSubmit,
				failure: this.onFailedSubmit,
				scope: this
			});
		}
	},
	
	onSuccessSubmit: function(form, action) {
		var result = action.result;
    		if (result.success == "true") {
    			Ext.MessageBox.show({
	        		title: 'Success - ' + sitename,
	       	 	msg: result.msg,
	        		icon: Ext.MessageBox.INFO,
	        		buttons: Ext.MessageBox.OK,
	        		animateTarget: 'button-save',
	        		fn: function() {
	        			if (self == top) {
						window.location=logout_url;
					} else {
						window.parent.location=logout_url;
					}
	        			
	        		}
	      	});
	    	} else {
	      	Ext.MessageBox.show({
	        		title: 'Error - ' + sitename,
	       	 	msg: result.msg,
	        		icon: Ext.MessageBox.ERROR,
	        		buttons: Ext.MessageBox.OK,
	        		animateTarget: 'button-save'
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
        			animateTarget: 'button-save'
			});
    		}
    		if (action.failureType === Ext.form.Action.SERVER_INVALID){
      		Ext.MessageBox.show({
        			title: 'Invalid - ' + sitename,
   				msg: 'Detail: '+action.result.errormsg,
	        		icon: Ext.MessageBox.ERROR,
	        		buttons: Ext.MessageBox.OK,
	        		animateTarget: 'button-save'
	      	});
	    	}
		this.resetForm();
	},
	
	resetForm: function() {
		//alert('blah');
		this.form.reset();	
	},
});